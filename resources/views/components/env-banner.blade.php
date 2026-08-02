@unless (app()->isProduction())
    <div class="env-banner" role="status">
        <strong>Ambiente de homologação</strong>
        <span>— este não é o site oficial. Dados e pagamentos são apenas de teste.</span>
    </div>
@endunless
