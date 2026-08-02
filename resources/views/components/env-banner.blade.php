@unless (app()->isProduction())
    <div class="env-banner" role="status">
        <strong>Ambiente de homologação</strong>
        <span>— não é o site oficial. Dados e pagamentos de teste.</span>
    </div>
@endunless
