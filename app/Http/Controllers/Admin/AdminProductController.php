<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->with('images')
            ->latest()
            ->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateProduct($request);

        $product = Product::create($data);

        $this->storeUploadedImages($request, $product);

        return redirect()
            ->route('admin.products.edit', $product)
            ->with('status', 'Produto criado com sucesso.');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateProduct($request, $product);
        $product->update($data);

        $this->updateExistingImages($request, $product);
        $this->deleteSelectedImages($request, $product);
        $this->storeUploadedImages($request, $product);

        return back()->with('status', 'Produto atualizado com sucesso.');
    }

    public function destroy(Product $product)
    {
        $product->load('images');
        foreach ($product->images as $image) {
            $this->deleteImageFile($image);
        }
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('status', 'Produto removido com sucesso.');
    }

    private function validateProduct(Request $request, ?Product $product = null): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($product?->id)],
            'code' => ['nullable', 'string', 'max:255', Rule::unique('products', 'code')->ignore($product?->id)],
            'price' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'category_label' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'key_features' => ['nullable', 'array'],
            'key_features.*' => ['nullable', 'string', 'max:255'],
            'spec_keys' => ['nullable', 'array'],
            'spec_keys.*' => ['nullable', 'string', 'max:255'],
            'spec_values' => ['nullable', 'array'],
            'spec_values.*' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'images' => ['nullable', 'array'],
            'images.*' => ['file', 'image', 'max:6144'],
        ]);

        $features = collect($validated['key_features'] ?? [])
            ->map(fn ($v) => is_string($v) ? trim($v) : '')
            ->filter()
            ->values()
            ->all();

        $specKeys = $validated['spec_keys'] ?? [];
        $specValues = $validated['spec_values'] ?? [];
        $specs = [];
        $count = max(count($specKeys), count($specValues));
        for ($i = 0; $i < $count; $i++) {
            $label = isset($specKeys[$i]) ? trim((string) $specKeys[$i]) : '';
            $value = isset($specValues[$i]) ? trim((string) $specValues[$i]) : '';
            if ($label === '' && $value === '') {
                continue;
            }
            $specs[] = ['label' => $label, 'value' => $value];
        }

        return [
            'title' => $validated['title'],
            'slug' => $validated['slug'] ?? null,
            'code' => $validated['code'] ?? null,
            'price' => $validated['price'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'category_label' => $validated['category_label'] ?? null,
            'description' => $validated['description'] ?? null,
            'key_features' => $features ?: null,
            'technical_specs' => $specs ?: null,
            'is_active' => (bool) ($validated['is_active'] ?? false),
            'is_featured' => (bool) ($validated['is_featured'] ?? false),
        ];
    }

    private function storeUploadedImages(Request $request, Product $product): void
    {
        /** @var array<int, \Illuminate\Http\UploadedFile> $files */
        $files = $request->file('images', []);
        if (count($files) === 0) {
            return;
        }

        $dir = public_path('uploads/products');
        File::ensureDirectoryExists($dir);

        $nextSort = (int) ($product->images()->max('sort_order') ?? -1) + 1;

        foreach ($files as $file) {
            $filename = $product->slug . '-' . uniqid('', true) . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $filename);

            ProductImage::create([
                'product_id' => $product->id,
                'path' => 'uploads/products/' . $filename,
                'alt' => $product->title,
                'sort_order' => $nextSort,
            ]);

            $nextSort++;
        }
    }

    private function updateExistingImages(Request $request, Product $product): void
    {
        $existing = $request->input('existing_images', []);
        if (!is_array($existing) || $existing === []) {
            return;
        }

        $images = $product->images()->get()->keyBy('id');
        foreach ($existing as $id => $data) {
            $id = (int) $id;
            if (!$images->has($id) || !is_array($data)) {
                continue;
            }
            $image = $images->get($id);
            $alt = isset($data['alt']) ? trim((string) $data['alt']) : null;
            $sort = isset($data['sort_order']) ? (int) $data['sort_order'] : $image->sort_order;

            $image->update([
                'alt' => $alt !== '' ? $alt : null,
                'sort_order' => $sort,
            ]);
        }
    }

    private function deleteSelectedImages(Request $request, Product $product): void
    {
        $ids = $request->input('delete_image_ids', []);
        if (!is_array($ids) || $ids === []) {
            return;
        }

        $ids = array_map('intval', $ids);
        $images = $product->images()->whereIn('id', $ids)->get();
        foreach ($images as $image) {
            $this->deleteImageFile($image);
            $image->delete();
        }
    }

    private function deleteImageFile(ProductImage $image): void
    {
        $fullPath = public_path($image->path);
        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }
}
