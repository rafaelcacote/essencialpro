@php
    $hasAlerts = session('status') || session('success') || session('error') || $errors->any();
@endphp

@if ($hasAlerts)
    <div class="admin-alerts">
        @if (session('status') || session('success'))
            <div class="admin-alert admin-alert--success" role="alert">
                <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                <div class="admin-alert__body">{{ session('status') ?? session('success') }}</div>
                <button type="button" class="admin-alert-close" onclick="this.closest('.admin-alert').remove()" aria-label="Fechar">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="admin-alert admin-alert--danger" role="alert">
                <i class="bi bi-exclamation-circle-fill" aria-hidden="true"></i>
                <div class="admin-alert__body">{{ session('error') }}</div>
                <button type="button" class="admin-alert-close" onclick="this.closest('.admin-alert').remove()" aria-label="Fechar">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="admin-alert admin-alert--danger" role="alert">
                <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                <div class="admin-alert__body">
                    <div class="admin-alert__title">Corrija os campos abaixo</div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="admin-alert-close" onclick="this.closest('.admin-alert').remove()" aria-label="Fechar">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        @endif
    </div>
@endif
