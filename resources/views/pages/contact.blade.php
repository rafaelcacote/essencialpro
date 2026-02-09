@extends('layouts.app')

@section('title', 'Orçamentos - Industro')

@section('content')
@include('components.page-header', ['title' => 'Orçamentos'])

<!-- Quote Start -->
<div class="container-xxl py-5">
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success mb-4">
                {{ session('status') }}
            </div>
        @endif

        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center wow fadeInUp" data-wow-delay="0.1s">
                <p class="fw-medium text-uppercase text-primary mb-2">Orçamentos</p>
                <h1 class="display-5 mb-4">Tem um projecto para realizar?</h1>
                <p class="mb-4">A nossa equipa comercial está disponível para ajudar com grandes volumes, bordados ou personalização avançada. Contacte-nos através do formulário ou em info@example.com.</p>
                <p class="mb-0"><strong>Peça o seu orçamento gratuito!</strong></p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10 wow fadeInUp" data-wow-delay="0.3s">
                <form id="quoteForm" method="POST" action="{{ route('contact.submit') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Tipo de Cliente -->
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label class="form-label fw-bold">Tipo de Cliente <span class="text-danger">*</span></label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="client_type" id="client_type_company" value="company" required>
                                    <label class="form-check-label" for="client_type_company">
                                        Empresa
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="client_type" id="client_type_individual" value="individual" required>
                                    <label class="form-check-label" for="client_type_individual">
                                        Particular
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Nome da Empresa (condicional - apenas para Empresa) -->
                    <div class="row g-3 mb-4 d-none" id="company_name_field">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Nome da Empresa">
                                <label for="company_name">Nome da Empresa <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <!-- Informação de Contacto -->
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <h5 class="mb-3">Informação de Contacto</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Nome" required>
                                <label for="contact_name">Nome <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                <label for="email">Email <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Telefone" required>
                                <label for="phone">Telefone <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="tax_id" name="tax_id" placeholder="NIF / Contribuinte" required>
                                <label for="tax_id">NIF / Contribuinte <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <!-- Morada -->
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <h5 class="mb-3">Morada</h5>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Morada" required>
                                <label for="address">Morada <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Código Postal" required>
                                <label for="postal_code">Código Postal <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="city" name="city" placeholder="Cidade" required>
                                <label for="city">Cidade <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" id="country" name="country" required>
                                    <option value="">Selecione o país</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="España">España</option>
                                    <option value="France">France</option>
                                    <option value="Deutschland">Deutschland</option>
                                    <option value="Italia">Italia</option>
                                    <option value="Nederland">Nederland</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Finland">Finland</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Outro">Outro</option>
                                </select>
                                <label for="country">País <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <!-- Produtos Pretendidos -->
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <h5 class="mb-3">Produtos Pretendidos</h5>
                            <p class="text-muted mb-3">Adicione os produtos para os quais pretende orçamento.</p>
                        </div>
                        <div class="col-12" id="productsContainer">
                            <div class="product-item border rounded p-3 mb-3">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control product-name" name="products[0][name]" placeholder="Produto" required>
                                            <label>Produto <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="products[0][reference]" placeholder="Referência">
                                            <label>Referência</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" name="products[0][quantity]" placeholder="Quantidade" min="1" required>
                                            <label>Quantidade <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="products[0][color]" placeholder="Cor">
                                            <label>Cor</label>
                                        </div>
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger remove-product" style="display: none;">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-outline-primary" id="addProductBtn">
                                <i class="fa fa-plus me-2"></i>Adicionar Produto
                            </button>
                        </div>
                    </div>

                    <!-- Logotipos (Opcional) -->
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <h5 class="mb-3">Logotipos (Opcional)</h5>
                            <p class="text-muted mb-3">Adicione logotipos com as respetivas localizações e peças a personalizar.</p>
                        </div>
                        <div class="col-12" id="logosContainer">
                            <!-- Logos serão adicionados dinamicamente -->
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-outline-primary" id="addLogoBtn">
                                <i class="fa fa-plus me-2"></i>Adicionar Logotipo
                            </button>
                        </div>
                    </div>

                    <!-- Notas Adicionais -->
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Notas Adicionais" id="notes" name="notes" style="height: 120px"></textarea>
                                <label for="notes">Notas Adicionais</label>
                            </div>
                        </div>
                    </div>

                    <!-- Campos obrigatórios info -->
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <p class="text-muted"><span class="text-danger">*</span> Campos obrigatórios</p>
                            <p class="text-muted">Os orçamentos são habitualmente respondidos entre 24h a 48h.</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row g-3">
                        <div class="col-12 text-center">
                            <button class="btn btn-primary py-3 px-5" type="submit" id="submitBtn">
                                <span id="submitText">Enviar Pedido de Orçamento</span>
                                <span id="submitLoading" style="display: none;">
                                    <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                    A enviar...
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Quote End -->

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let productCount = 1;
    let logoCount = 0;

    // Toggle company name field based on client type
    const clientTypeRadios = document.querySelectorAll('input[name="client_type"]');
    const companyNameField = document.getElementById('company_name_field');
    const companyNameInput = document.getElementById('company_name');

    if (!clientTypeRadios.length || !companyNameField || !companyNameInput) {
        console.error('Elementos do formulário não encontrados!');
        return;
    }

    // Função para toggle do campo
    function toggleCompanyField(show) {
        if (show) {
            // Mostra o campo Nome da Empresa quando Empresa está selecionado
            companyNameField.classList.remove('d-none');
            companyNameInput.setAttribute('required', 'required');
        } else {
            // Esconde o campo Nome da Empresa quando Particular está selecionado
            companyNameField.classList.add('d-none');
            companyNameInput.removeAttribute('required');
            companyNameInput.value = '';
        }
    }

    // Adicionar event listeners aos radios
    clientTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'company') {
                toggleCompanyField(true);
            } else if (this.value === 'individual') {
                toggleCompanyField(false);
            }
        });

        // Verificar se algum radio já está selecionado ao carregar
        if (radio.checked && radio.value === 'company') {
            toggleCompanyField(true);
        }
    });

    // Add Product
    document.getElementById('addProductBtn').addEventListener('click', function() {
        const container = document.getElementById('productsContainer');
        const productHtml = `
            <div class="product-item border rounded p-3 mb-3">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control product-name" name="products[${productCount}][name]" placeholder="Produto" required>
                            <label>Produto <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="products[${productCount}][reference]" placeholder="Referência">
                            <label>Referência</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-floating">
                            <input type="number" class="form-control" name="products[${productCount}][quantity]" placeholder="Quantidade" min="1" required>
                            <label>Quantidade <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="products[${productCount}][color]" placeholder="Cor">
                            <label>Cor</label>
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-product">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', productHtml);
        productCount++;
        updateRemoveButtons();
    });

    // Remove Product
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-product')) {
            e.target.closest('.product-item').remove();
            updateRemoveButtons();
        }
    });

    // Update remove buttons visibility
    function updateRemoveButtons() {
        const productItems = document.querySelectorAll('.product-item');
        productItems.forEach((item, index) => {
            const removeBtn = item.querySelector('.remove-product');
            if (productItems.length > 1) {
                removeBtn.style.display = 'block';
            } else {
                removeBtn.style.display = 'none';
            }
        });
    }

    // Add Logo
    document.getElementById('addLogoBtn').addEventListener('click', function() {
        const container = document.getElementById('logosContainer');
        const logoHtml = `
            <div class="logo-item border rounded p-3 mb-3">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="file" class="form-control" name="logos[${logoCount}][file]" accept="image/*" required>
                            <label>Ficheiro do Logotipo <span class="text-danger">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="logos[${logoCount}][location]" placeholder="Localização">
                            <label>Localização</label>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-logo">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="logos[${logoCount}][pieces]" placeholder="Peças a personalizar">
                            <label>Peças a personalizar</label>
                        </div>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', logoHtml);
        logoCount++;
    });

    // Remove Logo
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-logo')) {
            e.target.closest('.logo-item').remove();
        }
    });

    // Form Submission (envio real)
    document.getElementById('quoteForm').addEventListener('submit', function() {
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitLoading = document.getElementById('submitLoading');

        submitText.style.display = 'none';
        submitLoading.style.display = 'inline';
        submitBtn.disabled = true;
    });

    // Initialize remove buttons
    updateRemoveButtons();
});
</script>
@endpush
@endsection




