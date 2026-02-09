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

<div class="card shadow-sm">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Nome da Categoria</label>
                <input class="form-control" name="name" value="{{ old('name', $category?->name) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Slug (URL)</label>
                <input class="form-control" name="slug" value="{{ old('slug', $category?->slug) }}" placeholder="Deixe vazio para gerar automático">
                <div class="form-text">Ex: <code>botas-de-seguranca</code></div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Categoria Pai (opcional)</label>
                <select class="form-select" name="parent_id">
                    <option value="">— Nenhuma (categoria raiz) —</option>
                    @foreach ($parentCategories as $parent)
                        <option value="{{ $parent->id }}" @selected(old('parent_id', $category?->parent_id) == $parent->id)>
                            {{ str_repeat('— ', $parent->level ?? 0) }}{{ $parent->name }}
                        </option>
                    @endforeach
                </select>
                <div class="form-text">Selecione uma categoria pai para criar uma subcategoria. Você pode criar subcategorias de subcategorias.</div>
            </div>

            <div class="col-md-3">
                <label class="form-label">Ordem de Exibição</label>
                <input type="number" class="form-control" name="sort_order" value="{{ old('sort_order', $category?->sort_order ?? 0) }}" min="0">
                <div class="form-text">Menor número aparece primeiro</div>
            </div>

            <div class="col-md-3">
                <label class="form-label">Status</label>
                <div class="form-check form-switch mt-2">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active"
                        @checked(old('is_active', $category?->is_active ?? true))>
                    <label class="form-check-label" for="is_active">Ativo</label>
                </div>
            </div>

            <div class="col-12">
                <label class="form-label">Descrição (opcional)</label>
                <textarea class="form-control" name="description" rows="3" placeholder="Descrição da categoria...">{{ old('description', $category?->description) }}</textarea>
            </div>
        </div>
    </div>
</div>
