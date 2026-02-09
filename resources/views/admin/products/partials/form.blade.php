@php
    /** @var \App\Models\Product|null $product */

    $oldFeatures = old('key_features');
    $features = is_array($oldFeatures)
        ? $oldFeatures
        : (($product?->key_features) ?: ['']);

    if (count($features) === 0) {
        $features = [''];
    }

    $oldSpecKeys = old('spec_keys');
    $oldSpecValues = old('spec_values');
    if (is_array($oldSpecKeys) || is_array($oldSpecValues)) {
        $specKeys = is_array($oldSpecKeys) ? $oldSpecKeys : [];
        $specValues = is_array($oldSpecValues) ? $oldSpecValues : [];
    } else {
        $specKeys = [];
        $specValues = [];
        foreach (($product?->technical_specs ?: []) as $row) {
            $specKeys[] = $row['label'] ?? '';
            $specValues[] = $row['value'] ?? '';
        }
    }

    if (max(count($specKeys), count($specValues)) === 0) {
        $specKeys = [''];
        $specValues = [''];
    }

    $oldColors = old('colors');
    $colors = is_array($oldColors)
        ? $oldColors
        : (($product?->colors) ?: ['']);

    $oldSizes = old('sizes');
    $sizes = is_array($oldSizes)
        ? $oldSizes
        : (($product?->sizes) ?: ['']);

    if (count($colors) === 0) {
        $colors = [''];
    }
    if (count($sizes) === 0) {
        $sizes = [''];
    }
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <div class="fw-bold mb-1">Corrija os campos abaixo:</div>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">Título</label>
                        <input class="form-control" name="title" value="{{ old('title', $product?->title) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Código do Produto</label>
                        <input class="form-control" name="code" value="{{ old('code', $product?->code) }}" placeholder="Ex: BS-2024-PREM">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Preço (opcional)</label>
                        <input class="form-control" name="price" value="{{ old('price', $product?->price) }}" placeholder="Ex: 199.90">
                        <div class="form-text">Use ponto. Ex: <code>199.90</code></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Categoria</label>
                        <select class="form-select" name="category_id">
                            <option value="">— Sem categoria —</option>
                            @php
                                $allCategories = \App\Models\Category::with('parent')
                                    ->where('is_active', true)
                                    ->orderBy('sort_order')
                                    ->get();
                                $groupedCategories = $allCategories->groupBy('parent_id');
                                
                                // Organizar categorias hierarquicamente usando recursão
                                $organizedCategories = [];
                                $processCategories = function($parentId = null, $level = 0) use ($groupedCategories, &$processCategories, &$organizedCategories) {
                                    $categories = $groupedCategories->get($parentId, []);
                                    foreach ($categories as $category) {
                                        $category->level = $level;
                                        $organizedCategories[] = $category;
                                        $processCategories($category->id, $level + 1);
                                    }
                                };
                                $processCategories();
                            @endphp
                            @foreach ($organizedCategories as $category)
                                @php
                                    $indent = str_repeat('&nbsp;&nbsp;', $category->level ?? 0);
                                    $prefix = ($category->level ?? 0) > 0 ? '— ' : '';
                                @endphp
                                <option value="{{ $category->id }}" @selected(old('category_id', $product?->category_id) == $category->id)>
                                    {!! $indent . $prefix . e($category->name) !!}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Categoria/Label (linha pequena - opcional)</label>
                        <input class="form-control" name="category_label" value="{{ old('category_label', $product?->category_label) }}" placeholder="Ex: Equipamento de Segurança">
                        <div class="form-text">Texto adicional que aparece na página do produto</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Slug (URL)</label>
                        <input class="form-control" name="slug" value="{{ old('slug', $product?->slug) }}" placeholder="Deixe vazio para gerar automático">
                        <div class="form-text">Ex: <code>bota-de-seguranca-premium</code></div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between">
                            <label class="form-label mb-0">Cores disponíveis</label>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addColorRow()">
                                <i class="fa fa-plus me-1"></i> Adicionar
                            </button>
                        </div>
                        <div id="colors-list" class="mt-2">
                            @foreach ($colors as $idx => $color)
                                <div class="input-group mb-2 color-row">
                                    <input class="form-control" name="colors[]" value="{{ $color }}" placeholder="Ex: Preto, Vermelho, Azul">
                                    <button type="button" class="btn btn-outline-danger" onclick="removeRow(this)" title="Remover">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-text">Uma cor por linha. Ex: Preto, Vermelho, Branco</div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between">
                            <label class="form-label mb-0">Tamanhos disponíveis</label>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSizeRow()">
                                <i class="fa fa-plus me-1"></i> Adicionar
                            </button>
                        </div>
                        <div id="sizes-list" class="mt-2">
                            @foreach ($sizes as $idx => $size)
                                <div class="input-group mb-2 size-row">
                                    <input class="form-control" name="sizes[]" value="{{ $size }}" placeholder="Ex: P, M, G, GG ou 38, 39, 40">
                                    <button type="button" class="btn btn-outline-danger" onclick="removeRow(this)" title="Remover">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-text">Um tamanho por linha. Ex: P, M, G ou 38, 39, 40</div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Descrição do Produto</label>
                        <textarea class="form-control" name="description" rows="6" placeholder="Texto do produto...">{{ old('description', $product?->description) }}</textarea>
                        <div class="form-text">Dica: você pode escrever em parágrafos (quebra de linha).</div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between">
                            <label class="form-label mb-0">Características Principais</label>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addFeatureRow()">
                                <i class="fa fa-plus me-1"></i> Adicionar
                            </button>
                        </div>
                        <div id="features-list" class="mt-2">
                            @foreach ($features as $idx => $feature)
                                <div class="input-group mb-2 feature-row">
                                    <input class="form-control" name="key_features[]" value="{{ $feature }}" placeholder="Ex: Solado antiderrapante">
                                    <button type="button" class="btn btn-outline-danger" onclick="removeRow(this)" title="Remover">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-between">
                            <label class="form-label mb-0">Especificações Técnicas (tabela)</label>
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="addSpecRow()">
                                <i class="fa fa-plus me-1"></i> Adicionar
                            </button>
                        </div>
                        <div id="specs-list" class="mt-2">
                            @for ($i = 0; $i < max(count($specKeys), count($specValues)); $i++)
                                <div class="row g-2 align-items-center spec-row mb-2">
                                    <div class="col-md-5">
                                        <input class="form-control" name="spec_keys[]" value="{{ $specKeys[$i] ?? '' }}" placeholder="Ex: Norma">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" name="spec_values[]" value="{{ $specValues[$i] ?? '' }}" placeholder="Ex: ABNT NBR ISO 20345">
                                    </div>
                                    <div class="col-md-1 d-grid">
                                        <button type="button" class="btn btn-outline-danger" onclick="removeRow(this)" title="Remover">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @if ($product)
            <div class="card shadow-sm mt-4">
                <div class="card-body">
                    <h5 class="mb-3">Imagens atuais</h5>
                    @if ($product->images->isEmpty())
                        <div class="text-muted">Nenhuma imagem cadastrada ainda.</div>
                    @else
                        <div class="row g-3">
                            @foreach ($product->images as $image)
                                <div class="col-md-4">
                                    <div class="border rounded p-2 bg-white">
                                        <img class="img-fluid rounded mb-2" src="{{ asset($image->path) }}" alt="{{ $image->alt ?? $product->title }}" style="height: 140px; width: 100%; object-fit: cover;">
                                        <div class="mb-2">
                                            <label class="form-label mb-1">Alt</label>
                                            <input class="form-control form-control-sm" name="existing_images[{{ $image->id }}][alt]" value="{{ old("existing_images.$image->id.alt", $image->alt) }}">
                                        </div>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label class="form-label mb-1">Ordem</label>
                                                <input type="number" class="form-control form-control-sm" name="existing_images[{{ $image->id }}][sort_order]" value="{{ old("existing_images.$image->id.sort_order", $image->sort_order) }}">
                                            </div>
                                            <div class="col-6 d-flex align-items-end">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="delete_image_ids[]" value="{{ $image->id }}" id="del-{{ $image->id }}">
                                                    <label class="form-check-label" for="del-{{ $image->id }}">Remover</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-text mt-2">A imagem com menor “Ordem” aparece primeiro (e vira a principal).</div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Publicação</h5>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                        @checked(old('is_active', $product?->is_active ?? true))>
                    <label class="form-check-label" for="is_active">Ativo</label>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                        @checked(old('is_featured', $product?->is_featured ?? false))>
                    <label class="form-check-label" for="is_featured">Em destaque (home)</label>
                </div>

                <div class="mb-3">
                    <label class="form-label">Enviar novas imagens</label>
                    <input class="form-control" type="file" name="images[]" multiple accept="image/*">
                    <div class="form-text">Você pode enviar várias imagens; elas entram no final da galeria.</div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function removeRow(btn) {
    const row = btn.closest('.feature-row') || btn.closest('.spec-row') || btn.closest('.color-row') || btn.closest('.size-row');
    if (row) row.remove();
}

function addFeatureRow() {
    const wrap = document.getElementById('features-list');
    const div = document.createElement('div');
    div.className = 'input-group mb-2 feature-row';
    div.innerHTML = `
        <input class="form-control" name="key_features[]" placeholder="Ex: Solado antiderrapante">
        <button type="button" class="btn btn-outline-danger" onclick="removeRow(this)" title="Remover">
            <i class="fa fa-trash"></i>
        </button>
    `;
    wrap.appendChild(div);
}

function addColorRow() {
    const wrap = document.getElementById('colors-list');
    const div = document.createElement('div');
    div.className = 'input-group mb-2 color-row';
    div.innerHTML = `
        <input class="form-control" name="colors[]" placeholder="Ex: Preto, Vermelho, Azul">
        <button type="button" class="btn btn-outline-danger" onclick="removeRow(this)" title="Remover">
            <i class="fa fa-trash"></i>
        </button>
    `;
    wrap.appendChild(div);
}

function addSizeRow() {
    const wrap = document.getElementById('sizes-list');
    const div = document.createElement('div');
    div.className = 'input-group mb-2 size-row';
    div.innerHTML = `
        <input class="form-control" name="sizes[]" placeholder="Ex: P, M, G, GG ou 38, 39, 40">
        <button type="button" class="btn btn-outline-danger" onclick="removeRow(this)" title="Remover">
            <i class="fa fa-trash"></i>
        </button>
    `;
    wrap.appendChild(div);
}

function addSpecRow() {
    const wrap = document.getElementById('specs-list');
    const div = document.createElement('div');
    div.className = 'row g-2 align-items-center spec-row mb-2';
    div.innerHTML = `
        <div class="col-md-5">
            <input class="form-control" name="spec_keys[]" placeholder="Ex: Norma">
        </div>
        <div class="col-md-6">
            <input class="form-control" name="spec_values[]" placeholder="Ex: ABNT NBR ISO 20345">
        </div>
        <div class="col-md-1 d-grid">
            <button type="button" class="btn btn-outline-danger" onclick="removeRow(this)" title="Remover">
                <i class="fa fa-trash"></i>
            </button>
        </div>
    `;
    wrap.appendChild(div);
}
</script>
@endpush

