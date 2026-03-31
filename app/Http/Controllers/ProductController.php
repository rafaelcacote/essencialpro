<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()
            ->where('is_active', true)
            ->with('images', 'categories');

        // Filtro por categoria
        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->where('is_active', true)->first();
            if ($category) {
                $categoryIds = $this->getCategoryAndDescendantIds($category);
                $query->where(function ($q) use ($categoryIds) {
                    $q->whereIn('category_id', $categoryIds)
                        ->orWhereHas('categories', fn ($cq) => $cq->whereIn('categories.id', $categoryIds));
                });
            }
        }

        // Filtro por preço
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price)->whereNotNull('price');
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price)->whereNotNull('price');
        }

        // Ordenação
        $sort = $request->get('sort', 'popularity');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'popularity':
            default:
                $query->orderBy('is_featured', 'desc')->latest();
                break;
        }

        $products = $query->paginate(15)->withQueryString();

        // Buscar todas as categorias ativas para o filtro (com hierarquia completa)
        $categoryTree = $this->getCategoryTree();

        // Calcular preços mínimo e máximo para o filtro
        $minPrice = Product::where('is_active', true)->whereNotNull('price')->min('price') ?? 0;
        $maxPrice = Product::where('is_active', true)->whereNotNull('price')->max('price') ?? 1000;
        
        // Garantir valores mínimos e máximos válidos
        if ($minPrice == 0 && $maxPrice == 0) {
            $minPrice = 0;
            $maxPrice = 1000;
        }

        return view('pages.products.index', compact('products', 'categoryTree', 'minPrice', 'maxPrice'));
    }

    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }

        $product->load('images');

        $relatedProducts = Product::query()
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->with('images')
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('pages.product', compact('product', 'relatedProducts'));
    }

    public function category(Category $category, Request $request)
    {
        if (!$category->is_active) {
            abort(404);
        }

        $category->load('parent');

        // Buscar produtos da categoria e subcategorias (todas as profundidades)
        $categoryIds = $this->getCategoryAndDescendantIds($category);

        $query = Product::query()
            ->where('is_active', true)
            ->where(function ($q) use ($categoryIds) {
                $q->whereIn('category_id', $categoryIds)
                    ->orWhereHas('categories', fn ($cq) => $cq->whereIn('categories.id', $categoryIds));
            })
            ->with('images', 'categories');

        // Filtro por preço
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price)->whereNotNull('price');
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price)->whereNotNull('price');
        }

        // Ordenação
        $sort = $request->get('sort', 'popularity');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            case 'popularity':
            default:
                $query->orderBy('is_featured', 'desc')->latest();
                break;
        }

        $products = $query->paginate(15)->withQueryString();

        // Buscar todas as categorias ativas para o filtro (com hierarquia completa)
        $categoryTree = $this->getCategoryTree();

        // Calcular preços mínimo e máximo para o filtro
        $minPrice = Product::where('is_active', true)->whereNotNull('price')->min('price') ?? 0;
        $maxPrice = Product::where('is_active', true)->whereNotNull('price')->max('price') ?? 1000;
        
        // Garantir valores mínimos e máximos válidos
        if ($minPrice == 0 && $maxPrice == 0) {
            $minPrice = 0;
            $maxPrice = 1000;
        }

        return view('pages.products.category', compact('category', 'products', 'categoryTree', 'minPrice', 'maxPrice'));
    }

    private function getCategoryTree()
    {
        $categories = Category::where('is_active', true)
            ->withCount(['products' => function ($q) {
                $q->where('is_active', true);
            }])
            ->orderBy('sort_order')
            ->get();

        $byParent = $categories->groupBy('parent_id');

        $buildTree = function ($parentId = null) use (&$buildTree, $byParent) {
            return ($byParent[$parentId] ?? collect())->map(function ($cat) use (&$buildTree) {
                $cat->children_tree = $buildTree($cat->id);
                return $cat;
            });
        };

        return $buildTree(null);
    }

    private function getCategoryAndDescendantIds(Category $category): array
    {
        $allCategories = Category::where('is_active', true)->get(['id', 'parent_id']);
        $byParent = $allCategories->groupBy('parent_id');
        $ids = [];

        $walk = function ($parentId) use (&$walk, &$ids, $byParent) {
            $ids[] = $parentId;
            foreach ($byParent[$parentId] ?? [] as $child) {
                $walk($child->id);
            }
        };

        $walk($category->id);

        return $ids;
    }
}
