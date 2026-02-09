<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->with('parent')
            ->withCount('products')
            ->orderBy('parent_id')
            ->orderBy('sort_order')
            ->get();

        // Organizar em hierarquia
        $rootCategories = $categories->whereNull('parent_id')->sortBy('sort_order');
        
        return view('admin.categories.index', compact('categories', 'rootCategories'));
    }

    public function create()
    {
        $parentCategories = $this->getAvailableParentCategories();
        
        return view('admin.categories.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateCategory($request);

        Category::create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('status', 'Categoria criada com sucesso.');
    }

    public function edit(Category $category)
    {
        $parentCategories = $this->getAvailableParentCategories($category);
        
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $this->validateCategory($request, $category);
        
        // Prevenir que uma categoria seja pai de si mesma ou de seus descendentes
        if ($data['parent_id'] == $category->id) {
            return back()->withErrors(['parent_id' => 'Uma categoria não pode ser pai de si mesma.']);
        }

        // Verificar se está tentando tornar um descendente como pai (criaria loop)
        $descendantIds = $this->getDescendantIds($category);
        if (in_array($data['parent_id'], $descendantIds)) {
            return back()->withErrors(['parent_id' => 'Uma categoria não pode ser pai de uma de suas subcategorias.']);
        }

        $category->update($data);

        return back()->with('status', 'Categoria atualizada com sucesso.');
    }

    public function destroy(Category $category)
    {
        // Verificar se tem produtos
        if ($category->products()->count() > 0) {
            return back()->withErrors(['error' => 'Não é possível excluir uma categoria que possui produtos.']);
        }

        // Verificar se tem subcategorias
        if ($category->children()->count() > 0) {
            return back()->withErrors(['error' => 'Não é possível excluir uma categoria que possui subcategorias.']);
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('status', 'Categoria removida com sucesso.');
    }

    private function validateCategory(Request $request, ?Category $category = null): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('categories', 'slug')->ignore($category?->id)],
            'description' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        return [
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?? null,
            'description' => $validated['description'] ?? null,
            'parent_id' => $validated['parent_id'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => (bool) ($validated['is_active'] ?? true),
        ];
    }

    /**
     * Retorna todas as categorias disponíveis para serem usadas como pai,
     * excluindo a categoria atual e seus descendentes (para evitar loops).
     * Retorna organizadas hierarquicamente.
     */
    private function getAvailableParentCategories(?Category $excludeCategory = null)
    {
        $allCategories = Category::query()
            ->with('parent')
            ->orderBy('sort_order')
            ->get();

        // Se estamos editando uma categoria, excluir ela e seus descendentes
        if ($excludeCategory) {
            $excludeIds = $this->getDescendantIds($excludeCategory);
            $excludeIds[] = $excludeCategory->id;
            $allCategories = $allCategories->whereNotIn('id', $excludeIds);
        }

        // Organizar hierarquicamente
        return $this->organizeCategoriesHierarchically($allCategories);
    }

    /**
     * Organiza categorias em uma estrutura hierárquica plana para exibição.
     */
    private function organizeCategoriesHierarchically($categories)
    {
        $organized = collect();
        $rootCategories = $categories->whereNull('parent_id')->sortBy('sort_order');

        foreach ($rootCategories as $root) {
            $root->level = 0;
            $organized->push($root);
            $this->addChildrenRecursively($organized, $root, $categories, 1);
        }

        return $organized;
    }

    /**
     * Adiciona filhos recursivamente à coleção organizada.
     */
    private function addChildrenRecursively($organized, $parent, $allCategories, $level)
    {
        $children = $allCategories->where('parent_id', $parent->id)->sortBy('sort_order');
        
        foreach ($children as $child) {
            $child->level = $level;
            $organized->push($child);
            $this->addChildrenRecursively($organized, $child, $allCategories, $level + 1);
        }
    }

    /**
     * Retorna todos os IDs dos descendentes de uma categoria (recursivo).
     */
    private function getDescendantIds(Category $category): array
    {
        $ids = [];
        
        // Garantir que os filhos estão carregados
        $children = $category->children;
        
        foreach ($children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $this->getDescendantIds($child));
        }
        
        return $ids;
    }
}
