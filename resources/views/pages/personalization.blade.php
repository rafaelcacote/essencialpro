@extends('layouts.app')

@section('title', 'Personalize a sua marca - Essencial Pro')

@push('styles')
<style>
    .pers-page { --pers-orange: var(--primary); --pers-ink: #151515; --pers-muted: #68707c; color: var(--pers-ink); }
    .pers-hero { min-height: 300px; position: relative; display: flex; align-items: center; overflow: hidden; background: #111 url('{{ asset('img/home_sections/personalizamos-sua-marca.png') }}') center/cover no-repeat; }
    .pers-hero::before { content: ''; position: absolute; inset: 0; background: linear-gradient(90deg, rgba(0,0,0,.88) 0%, rgba(0,0,0,.62) 43%, rgba(0,0,0,.18) 78%); }
    .pers-hero-content { position: relative; max-width: 510px; color: #fff; padding: 3.5rem 0; }
    .pers-eyebrow, .pers-kicker { color: var(--pers-orange); font-size: .72rem; font-weight: 800; letter-spacing: .08em; text-transform: uppercase; }
    .pers-hero h1 { font-size: clamp(2rem, 4vw, 3.25rem); color: #fff; line-height: .98; font-weight: 800; text-transform: uppercase; margin: .4rem 0 .85rem; }
    .pers-hero h1 span { color: var(--pers-orange); }
    .pers-hero p { color: #fff; font-size: .95rem; line-height: 1.65; max-width: 420px; margin: 0; }
    .pers-main { padding: 2.25rem 0 4rem; background: #fff; }
    .pers-layout { display: grid; grid-template-columns: minmax(0, 1fr) 365px; gap: 2rem; align-items: start; }
    .pers-section { margin-bottom: 2.3rem; }
    .pers-section-title { text-align: center; margin-bottom: 1.25rem; }
    .pers-section-title h2 { font-size: 1.35rem; font-weight: 800; margin: .2rem 0 0; color: #111; }
    .pers-steps { display: grid; grid-template-columns: repeat(4, 1fr); gap: .4rem; position: relative; }
    .pers-step { text-align: center; position: relative; padding: .3rem .4rem; }
    .pers-step:not(:last-child)::after { content: '→'; position: absolute; right: -.5rem; top: 1.25rem; color: var(--pers-orange); font-size: 1.3rem; font-weight: 700; }
    .pers-step-icon { width: 44px; height: 44px; margin: 0 auto .5rem; display: grid; place-items: center; color: var(--pers-orange); font-size: 1.55rem; border: 1px solid #f0d9ce; border-radius: 50%; }
    .pers-step strong { display: block; color: #222; font-size: .7rem; line-height: 1.25; }
    .pers-step p { color: var(--pers-muted); font-size: .64rem; line-height: 1.4; margin: .28rem auto 0; max-width: 130px; }
    .pers-card { border: 1px solid #e6e6e6; background: #fff; }
    .pers-card-head { border-bottom: 1px solid #e9e9e9; padding: .7rem 1rem; }
    .pers-card-head h2 { font-size: .88rem; font-weight: 800; margin: 0; text-transform: uppercase; }
    .pers-card-head span { color: var(--pers-orange); font-size: .65rem; font-weight: 800; text-transform: uppercase; }
    .pers-proof { display: grid; grid-template-columns: .9fr 1.25fr; }
    .pers-mockup-col { min-width: 0; display: flex; flex-direction: column; background: #fff; }
    .pers-mockup-col.is-focused .pers-mockup { box-shadow: inset 0 0 0 3px rgba(255,94,20,.45); }
    .pers-mockup-tools { display: none; padding: .85rem 1rem 1rem; border-top: 1px solid #ececec; background: #fafafa; }
    .pers-mockup-tools.is-visible { display: block; }
    .pers-mockup-tools-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: .45rem; }
    .pers-mockup-tools-head strong { font-size: .72rem; font-weight: 800; text-transform: uppercase; color: #222; }
    .pers-size-value { color: var(--pers-orange); font-size: .72rem; font-weight: 800; }
    .pers-size-control { display: flex; align-items: center; gap: .45rem; }
    .pers-size-btn { width: 34px; height: 34px; flex-shrink: 0; border: 1px solid #e0e0e0; background: #fff; color: var(--pers-orange); font-size: 1.15rem; font-weight: 700; line-height: 1; cursor: pointer; }
    .pers-size-btn:hover { border-color: var(--pers-orange); background: #fff8f5; }
    .pers-size-control input[type="range"] { flex: 1; accent-color: var(--pers-orange); }
    .pers-jump-mockup { display: none; width: 100%; margin-bottom: .75rem; border: 1px solid var(--pers-orange); background: #fff8f5; color: var(--pers-orange); padding: .55rem .7rem; font-size: .7rem; font-weight: 800; text-transform: uppercase; letter-spacing: .03em; cursor: pointer; }
    .pers-jump-mockup.is-visible { display: inline-flex; align-items: center; justify-content: center; gap: .4rem; }
    .pers-jump-mockup:hover { background: var(--pers-orange); color: #fff; }
    .pers-success-modal .modal-content { border: 0; border-radius: 0; text-align: center; padding: .4rem .2rem 1rem; }
    .pers-success-modal .modal-icon { width: 56px; height: 56px; margin: .6rem auto .85rem; display: grid; place-items: center; border-radius: 50%; background: #e9f7ef; color: #1e8a4c; font-size: 1.5rem; }
    .pers-success-modal h2 { font-size: 1.15rem; font-weight: 800; margin: 0 0 .45rem; color: #151515; }
    .pers-success-modal p { color: #5b6168; font-size: .86rem; line-height: 1.5; margin: 0 0 1.1rem; }
    .pers-success-modal .btn { background: var(--pers-orange); border: 0; border-radius: 0; font-weight: 800; text-transform: uppercase; font-size: .74rem; letter-spacing: .03em; padding: .65rem 1.4rem; }
    .pers-proof-copy { padding: 1.15rem; border-right: 1px solid #ececec; }
    .pers-proof-copy h3 { font-size: 1.05rem; font-weight: 800; margin: 0 0 .7rem; }
    .pers-proof-copy p, .pers-proof-copy li { color: #555; font-size: .75rem; line-height: 1.55; }
    .pers-proof-copy ul { list-style: none; padding: 0; margin: .8rem 0; }
    .pers-proof-copy li { margin-bottom: .38rem; }
    .pers-proof-copy li i { color: var(--pers-orange); margin-right: .35rem; }
    .pers-note { display: flex; gap: .5rem; padding: .6rem; background: #fff8f5; color: #62514a; font-size: .68rem; line-height: 1.45; }
    .pers-note i { color: var(--pers-orange); margin-top: .15rem; }
    .pers-mockup { min-height: 320px; display: grid; place-items: center; padding: 1.2rem 1.2rem 1.5rem; background: radial-gradient(circle at center, #fff 0%, #fafafa 64%, #f1f1f1 100%); position: relative; overflow: hidden; }
    .pers-mockup::before { content: 'MAQUETE DO PRODUTO'; position: absolute; top: .7rem; left: .8rem; color: #aaa; font-size: .61rem; letter-spacing: .08em; font-weight: 700; z-index: 1; }
    .pers-mockup.has-logo::before { content: 'PRÉ-VISUALIZAÇÃO DO LOGÓTIPO'; color: var(--pers-orange); }
    .pers-mockup-placeholder { width: 70%; aspect-ratio: 4 / 5; display: grid; place-items: center; text-align: center; color: #9aa0a6; border: 1px dashed #cbd0d5; background: rgba(255,255,255,.65); font-size: .78rem; line-height: 1.45; }
    .pers-mockup-placeholder i { font-size: 2.2rem; color: var(--pers-orange); display: block; margin-bottom: .5rem; }
    .pers-mockup-product { width: 100%; height: 100%; min-height: 320px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: .65rem; padding-top: 1rem; }
    .pers-mockup-garment { position: relative; display: inline-block; max-width: 88%; }
    .pers-mockup-garment .pers-product-img { max-width: 100%; max-height: 340px; width: auto; height: auto; object-fit: contain; display: block; user-select: none; -webkit-user-drag: none; }
    .pers-logo-on-product { position: absolute; display: none; left: 38%; top: 36%; width: 16%; transform: translate(-50%, -50%); z-index: 2; cursor: grab; user-select: none; touch-action: none; outline: 1px dashed rgba(255,94,20,.6); outline-offset: 3px; filter: drop-shadow(0 1px 2px rgba(0,0,0,.35)); }
    .pers-logo-on-product.is-visible { display: block; }
    .pers-logo-on-product.is-dragging { cursor: grabbing; z-index: 4; }
    .pers-logo-on-product img { width: 100%; height: auto; display: block; pointer-events: none; }
    .pers-logo-resize { position: absolute; right: -7px; bottom: -7px; width: 14px; height: 14px; background: var(--pers-orange); border: 2px solid #fff; border-radius: 2px; cursor: nwse-resize; box-shadow: 0 0 0 1px rgba(0,0,0,.2); touch-action: none; }
    .pers-hint { color: #777; font-size: .62rem; line-height: 1.4; margin: .15rem 0 0; }
    .pers-visually-hidden { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0; }
    .pers-mockup-product strong { color: #222; font-size: .78rem; font-weight: 800; text-align: center; line-height: 1.3; max-width: 90%; }
    .pers-mockup-caption { color: #888; font-size: .62rem; text-align: center; margin: 0; max-width: 90%; line-height: 1.4; }
    .pers-mockup-logo-only { width: 72%; min-height: 220px; display: none; flex-direction: column; align-items: center; justify-content: center; gap: .55rem; padding: .8rem; background: rgba(255,255,255,.8); border: 1px solid #ececec; }
    .pers-mockup-logo-only.is-visible { display: flex; }
    .pers-mockup-logo-only img { max-width: 85%; max-height: 210px; object-fit: contain; }
    .pers-mockup-logo-only span { color: #444; font-size: .7rem; font-weight: 700; text-align: center; word-break: break-word; }
    .pers-mockup-pdf { display: none; text-align: center; color: #444; padding: 1rem; }
    .pers-mockup-pdf.is-visible { display: block; }
    .pers-mockup-pdf i { font-size: 2.4rem; color: var(--pers-orange); display: block; margin-bottom: .45rem; }
    .pers-mockup-pdf strong { display: block; font-size: .78rem; word-break: break-word; }
    .pers-selected-product { display: flex; gap: .65rem; align-items: center; margin-bottom: .85rem; padding: .55rem; border: 1px solid #ececec; background: #fafafa; }
    .pers-selected-product img { width: 52px; height: 52px; object-fit: contain; background: #fff; border: 1px solid #eee; flex-shrink: 0; }
    .pers-selected-product span { display: block; color: var(--pers-orange); font-size: .58rem; font-weight: 800; letter-spacing: .06em; text-transform: uppercase; }
    .pers-selected-product strong { display: block; color: #222; font-size: .72rem; font-weight: 800; line-height: 1.3; margin-top: .1rem; }
    .pers-methods { display: grid; grid-template-columns: 1fr 1fr; gap: .9rem; }
    .pers-method { min-height: 260px; padding: 1.4rem; color: #fff; position: relative; overflow: hidden; background: #202020; display: flex; flex-direction: column; justify-content: flex-end; }
    .pers-method::after { content: ''; position: absolute; inset: 0; background: linear-gradient(180deg, rgba(0,0,0,.15) 0%, rgba(0,0,0,.55) 55%, rgba(0,0,0,.82) 100%); }
    .pers-method > * { position: relative; z-index: 1; }
    .pers-method-icon { width: 30px; height: 30px; display: inline-grid; place-items: center; color: #fff; background: var(--pers-orange); border-radius: 50%; font-size: .8rem; }
    .pers-method h3 { font-size: 1rem; font-weight: 800; margin: .55rem 0 .3rem; }
    .pers-method p { font-size: .72rem; line-height: 1.4; margin: 0; max-width: 280px; }
    .pers-method--dtf { background: #111 url('{{ asset('img/personalizacao/dft_transfer.jpeg') }}') center 35% / cover no-repeat; color: #fff; }
    .pers-method--dtf::after,
    .pers-method--emb::after { background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,.04) 50%, rgba(0,0,0,.28) 100%); }
    .pers-method--dtf h3,
    .pers-method--dtf p,
    .pers-method--emb h3,
    .pers-method--emb p { color: #fff; text-shadow: 0 1px 3px rgba(0,0,0,.55); }
    .pers-method--emb { background: #111 url('{{ asset('img/personalizacao/bordado.jpeg') }}') center 40% / cover no-repeat; color: #fff; }
    .pers-examples { display: grid; grid-template-columns: repeat(3, 1fr); gap: .8rem; }
    .pers-example { aspect-ratio: 3 / 2; background: #e7e7e7; position: relative; overflow: hidden; border: 1px solid #ddd; }
    .pers-example img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .pers-benefits { display: grid; grid-template-columns: repeat(4, 1fr); border: 1px solid #e8e8e8; }
    .pers-benefit { padding: 1.1rem .75rem; text-align: center; border-right: 1px solid #e8e8e8; }
    .pers-benefit:last-child { border-right: 0; }
    .pers-benefit i { color: var(--pers-orange); font-size: 1.35rem; }
    .pers-benefit h3 { margin: .5rem 0 .3rem; font-size: .68rem; font-weight: 800; text-transform: uppercase; }
    .pers-benefit p { margin: 0; color: var(--pers-muted); font-size: .64rem; line-height: 1.4; }
    .pers-faq { border-top: 1px solid #e5e5e5; }
    .pers-faq summary { cursor: pointer; padding: .75rem .2rem; border-bottom: 1px solid #e5e5e5; list-style: none; font-size: .76rem; font-weight: 700; }
    .pers-faq summary::after { content: '+'; float: right; color: var(--pers-orange); font-size: 1.1rem; }
    .pers-faq p { color: var(--pers-muted); font-size: .75rem; line-height: 1.5; margin: 0; padding: 0 .2rem .75rem; }
    .pers-form { position: sticky; top: 1.25rem; border: 1px solid #dedede; background: #fff; }
    .pers-form-head { padding: 1rem 1.1rem .75rem; border-bottom: 1px solid #e8e8e8; }
    .pers-form-head h2 { color: var(--pers-orange); font-size: .9rem; font-weight: 800; line-height: 1.25; margin: 0; text-transform: uppercase; }
    .pers-form-head p { color: #333; font-size: .73rem; font-weight: 700; margin: .15rem 0 0; }
    .pers-form-body { padding: .95rem 1.1rem 1.15rem; }
    .pers-form-group { margin-bottom: .7rem; }
    .pers-form-label, .pers-form legend { display: block; margin: 0 0 .28rem; color: #333; font-size: .65rem; font-weight: 800; text-transform: uppercase; }
    .pers-form-control { width: 100%; height: 32px; border: 1px solid #e0e0e0; border-radius: 0; padding: .35rem .5rem; color: #333; font-size: .74rem; }
    textarea.pers-form-control { height: 57px; resize: vertical; }
    .pers-form-control:focus { border-color: var(--pers-orange); outline: 0; box-shadow: 0 0 0 2px rgba(255,94,20,.1); }
    .pers-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: .6rem; }
    .pers-form fieldset { border: 0; padding: 0; margin: .9rem 0; }
    .pers-check { display: block; color: #454545; font-size: .7rem; line-height: 1.65; cursor: pointer; }
    .pers-check input { accent-color: var(--pers-orange); margin-right: .28rem; vertical-align: middle; }
    .pers-upload { display: block; border: 1px dashed #c9c9c9; padding: .55rem; color: #777; font-size: .68rem; text-align: center; cursor: pointer; }
    .pers-upload input { display: none; }
    .pers-upload.has-error { border-color: #d9534f; color: #a33; }
    .pers-logo-thumb { display: none; align-items: center; gap: .6rem; margin-top: .5rem; padding: .45rem; border: 1px solid #ececec; background: #fafafa; }
    .pers-logo-thumb.is-visible { display: flex; }
    .pers-logo-thumb img { width: 52px; height: 52px; object-fit: contain; background: #fff; border: 1px solid #eee; flex-shrink: 0; }
    .pers-logo-thumb-file { width: 52px; height: 52px; display: none; place-items: center; color: var(--pers-orange); background: #fff; border: 1px solid #eee; flex-shrink: 0; font-size: 1.25rem; }
    .pers-logo-thumb.is-file img { display: none; }
    .pers-logo-thumb.is-file .pers-logo-thumb-file { display: grid; }
    .pers-logo-thumb strong { display: block; color: #222; font-size: .68rem; font-weight: 800; line-height: 1.3; word-break: break-word; }
    .pers-logo-thumb button { border: 0; background: none; color: var(--pers-orange); font-size: .62rem; font-weight: 700; cursor: pointer; padding: 0; }
    .pers-alert { font-size: .72rem; padding: .55rem .7rem; margin-bottom: .75rem; line-height: 1.45; }
    .pers-alert--error { background: #fff5f5; color: #8a2b2b; border: 1px solid #f0c9c9; }
    .pers-alert--error ul { margin: .35rem 0 0; padding-left: 1.1rem; }
    .pers-submit { width: 100%; border: 0; padding: .7rem; color: #fff; background: var(--pers-orange); font-size: .76rem; font-weight: 800; letter-spacing: .03em; text-transform: uppercase; }
    .pers-submit:hover { background: #d94b0a; }
    .pers-privacy { display: flex; gap: .4rem; margin: .7rem 0; color: #777; font-size: .62rem; line-height: 1.4; }
    .pers-privacy i { color: #222; }
    @media (max-width: 991.98px) { .pers-layout { grid-template-columns: 1fr; } .pers-form { position: static; max-width: 560px; margin: auto; } }
    @media (max-width: 767.98px) { .pers-hero { min-height: 250px; } .pers-steps { grid-template-columns: 1fr 1fr; row-gap: 1rem; } .pers-step:nth-child(2)::after { display: none; } .pers-proof { grid-template-columns: 1fr; } .pers-proof-copy { border-right: 0; border-bottom: 1px solid #ececec; } .pers-benefits { grid-template-columns: 1fr 1fr; } .pers-benefit:nth-child(2) { border-right: 0; } .pers-benefit:nth-child(-n+2) { border-bottom: 1px solid #e8e8e8; } }
    @media (max-width: 575.98px) { .pers-main { padding-top: 1.5rem; } .pers-hero-content { padding: 2.5rem 0; } .pers-methods, .pers-examples { grid-template-columns: 1fr; } .pers-step:not(:last-child)::after { display: none; } }
</style>
@endpush

@section('content')
<main class="pers-page">
    <section class="pers-hero">
        <div class="container">
            <div class="pers-hero-content">
                <div class="pers-eyebrow">Personalização profissional</div>
                <h1>Personalize<br><span>a sua marca</span></h1>
                <p>Transforme o vestuário profissional da sua equipa numa extensão da sua marca, com acabamentos duradouros e de elevada qualidade.</p>
            </div>
        </div>
    </section>

    <div class="pers-main">
        <div class="container">
            <div class="pers-layout">
                <div>
                    <section class="pers-section">
                        <div class="pers-section-title">
                            <div class="pers-kicker">Como funciona</div>
                            <h2>Um processo simples e eficiente</h2>
                        </div>
                        <div class="pers-steps">
                            <div class="pers-step"><div class="pers-step-icon"><i class="fa fa-tshirt"></i></div><strong>1. Escolha os produtos</strong><p>Selecione os artigos que deseja personalizar.</p></div>
                            <div class="pers-step"><div class="pers-step-icon"><i class="fa fa-cloud-upload-alt"></i></div><strong>2. Envie o seu logótipo</strong><p>Faça o upload do ficheiro e indique as preferências.</p></div>
                            <div class="pers-step"><div class="pers-step-icon"><i class="fa fa-desktop"></i></div><strong>3. Receba uma maquete</strong><p>Validamos consigo a proposta antes de produzir.</p></div>
                            <div class="pers-step"><div class="pers-step-icon"><i class="fa fa-truck"></i></div><strong>4. Produção e entrega</strong><p>Produção cuidada e entrega no prazo combinado.</p></div>
                        </div>
                    </section>

                    <section class="pers-section pers-card">
                        <div class="pers-card-head"><span>Maquete digital para aprovação</span><h2>Veja o resultado antes da produção</h2></div>
                        <div class="pers-proof">
                            <div class="pers-proof-copy">
                                <h3>Personalização sem surpresas</h3>
                                <p>Antes de iniciar a produção, enviamos uma maquete digital para confirmar a posição e o aspeto final da personalização.</p>
                                <ul>
                                    <li><i class="fa fa-check"></i>Posicionamento da personalização</li>
                                    <li><i class="fa fa-check"></i>Dimensões e cores</li>
                                    <li><i class="fa fa-check"></i>Local de aplicação</li>
                                    <li><i class="fa fa-check"></i>Método de personalização</li>
                                </ul>
                                <div class="pers-note"><i class="fa fa-info-circle"></i><span>A produção só começa depois da sua aprovação.</span></div>
                            </div>
                            <div class="pers-mockup-col" id="persMockupSection">
                            <div class="pers-mockup {{ session('submitted_logo') ? 'has-logo' : '' }}"
                                 id="persMockup"
                                 @if (session('submitted_logo'))
                                     data-submitted-url="{{ session('submitted_logo.url') }}"
                                     data-submitted-image="{{ session('submitted_logo.is_image') ? '1' : '0' }}"
                                     data-submitted-name="{{ session('submitted_logo.name') }}"
                                     data-submitted-location="{{ session('submitted_logo.location') }}"
                                     data-submitted-x="{{ session('submitted_logo.x') }}"
                                     data-submitted-y="{{ session('submitted_logo.y') }}"
                                     data-submitted-scale="{{ session('submitted_logo.scale') }}"
                                 @endif>
                                @if($product && $product->cover_image_url)
                                    <div class="pers-mockup-product">
                                        <div class="pers-mockup-garment" id="persMockupGarment">
                                            <img class="pers-product-img" src="{{ $product->cover_image_url }}" alt="{{ $product->title }}">
                                            <div class="pers-logo-on-product" id="persLogoDraggable">
                                                <img id="persLogoDragImg" alt="Logótipo no produto">
                                                <span class="pers-logo-resize" id="persLogoResize" title="Redimensionar"></span>
                                            </div>
                                        </div>
                                        <strong>{{ $product->title }}</strong>
                                        <p class="pers-mockup-caption">Arraste o logótipo para o posicionar na peça.</p>
                                    </div>
                                @else
                                    <div class="pers-mockup-placeholder" id="persMockupPlaceholder"><div><i class="fa fa-image"></i>Área reservada para a maquete<br>do produto personalizado</div></div>
                                    <div class="pers-mockup-logo-only" id="persLogoStandalone">
                                        <img alt="Pré-visualização do logótipo">
                                        <span></span>
                                    </div>
                                @endif
                                <div class="pers-mockup-pdf" id="persPdfPreview">
                                    <i class="fa fa-file-pdf"></i>
                                    <strong></strong>
                                    <p class="pers-mockup-caption">Ficheiro PDF anexado para personalização.</p>
                                </div>
                            </div>
                            <div class="pers-mockup-tools" id="persLogoSizeWrap" hidden>
                                <div class="pers-mockup-tools-head">
                                    <strong>Tamanho na maquete</strong>
                                    <span class="pers-size-value" id="persSizeValue">16%</span>
                                </div>
                                <div class="pers-size-control">
                                    <button type="button" class="pers-size-btn" id="persSizeMinus" aria-label="Diminuir logótipo">−</button>
                                    <input type="range" id="persLogoSize" min="8" max="40" step="0.5" value="{{ old('logo_scale', 16) }}" aria-label="Tamanho do logótipo">
                                    <button type="button" class="pers-size-btn" id="persSizePlus" aria-label="Aumentar logótipo">+</button>
                                </div>
                                <p class="pers-hint">Altere o tamanho e veja o resultado imediatamente na maquete. Arraste o logótipo para o sítio pretendido.</p>
                            </div>
                            </div>
                        </div>
                    </section>

                    <section class="pers-section">
                        <div class="pers-section-title"><div class="pers-kicker">Métodos de personalização</div></div>
                        <div class="pers-methods">
                            <article class="pers-method pers-method--dtf"><span class="pers-method-icon"><i class="fa fa-tint"></i></span><h3>DTF TRANSFER</h3><p>Impressão de alta definição, com cores vibrantes e excelente durabilidade. Ideal para t-shirts, polos, sweatshirts e muito mais.</p></article>
                            <article class="pers-method pers-method--emb"><span class="pers-method-icon"><i class="fa fa-thread"></i></span><h3>BORDADO</h3><p>Acabamento profissional e elegante, com alta resistência. Ideal para polos, softshells, casacos, bonés e peças mais nobres.</p></article>
                        </div>
                    </section>

                    <section class="pers-section">
                        <div class="pers-section-title"><div class="pers-kicker">Exemplos de personalização</div><h2>A sua marca, em destaque</h2></div>
                        <div class="pers-examples">
                            <div class="pers-example"><img src="{{ asset('img/personalizacao/01.jpeg') }}" alt="Exemplo de personalização — antes e depois"></div>
                            <div class="pers-example"><img src="{{ asset('img/personalizacao/02.jpeg') }}" alt="Exemplo de personalização — antes e depois"></div>
                            <div class="pers-example"><img src="{{ asset('img/personalizacao/03.jpeg') }}" alt="Exemplo de personalização — antes e depois"></div>
                        </div>
                    </section>

                    <section class="pers-section">
                        <div class="pers-section-title"><div class="pers-kicker">Porquê escolher a Essencial Pro?</div></div>
                        <div class="pers-benefits">
                            <article class="pers-benefit"><i class="fa fa-medal"></i><h3>Acabamento profissional</h3><p>Tecnologia e materiais de qualidade para um resultado duradouro.</p></article>
                            <article class="pers-benefit"><i class="fa fa-drafting-compass"></i><h3>Maquete digital</h3><p>Validação da posição, cores e dimensões antes da produção.</p></article>
                            <article class="pers-benefit"><i class="fa fa-truck"></i><h3>Entrega para todo o país</h3><p>Produção organizada e envio seguro para Portugal Continental.</p></article>
                            <article class="pers-benefit"><i class="fa fa-headset"></i><h3>Atendimento personalizado</h3><p>Acompanhamento dedicado em cada fase do seu projeto.</p></article>
                        </div>
                    </section>

                    <section class="pers-section">
                        <div class="pers-section-title"><div class="pers-kicker">Perguntas frequentes</div></div>
                        <div class="pers-faq">
                            <details><summary>Existe quantidade mínima para personalizar?</summary><p>A quantidade mínima depende do artigo e da técnica de personalização. Envie-nos o seu pedido para receber orientação.</p></details>
                            <details><summary>Quanto tempo demora a produção e a entrega?</summary><p>O prazo é confirmado após a validação da maquete, técnica escolhida e disponibilidade dos produtos.</p></details>
                            <details><summary>Que formatos de ficheiro aceitam?</summary><p>Preferencialmente PDF, AI, EPS ou PNG em alta resolução.</p></details>
                            <details><summary>Posso solicitar alterações na maquete?</summary><p>Sim. Ajustamos a proposta até que esteja de acordo com a personalização pretendida.</p></details>
                        </div>
                    </section>
                </div>

                <aside class="pers-form" id="pedido-personalizacao">
                    <div class="pers-form-head"><h2>Pedido de personalização</h2><p>— ESCREVA O SEU PEDIDO</p></div>
                    <form id="persQuoteForm" action="{{ route('contact.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="client_type" value="company">
                        <input type="hidden" name="form_origin" value="personalization">
                        <input type="hidden" name="product_slug" value="{{ $product?->slug }}">
                        <input type="hidden" name="products[0][name]" value="{{ $product?->title ?? 'Produto a personalizar' }}">
                        <input type="hidden" name="products[0][reference]" value="{{ $product?->code ?? '' }}">
                        <input type="file" name="mockup_image" id="persMockupFile" accept="image/png" class="pers-visually-hidden" tabindex="-1">
                        <div class="pers-form-body">
                            <button type="button" class="pers-jump-mockup" id="persJumpMockup"><i class="fa fa-eye"></i> Ver e ajustar maquete</button>
                            @if ($errors->any())
                                <div class="pers-alert pers-alert--error">
                                    <strong>Não foi possível enviar o pedido.</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if($product)
                                <div class="pers-selected-product">
                                    @if($product->cover_image_url)
                                        <img src="{{ $product->cover_image_url }}" alt="{{ $product->title }}">
                                    @endif
                                    <div>
                                        <span>Produto selecionado</span>
                                        <strong>{{ $product->title }}</strong>
                                    </div>
                                </div>
                            @endif
                            <div class="pers-form-group"><label class="pers-form-label" for="company_name">1. Dados de contacto</label><input class="pers-form-control" id="company_name" name="company_name" placeholder="Nome da empresa *" value="{{ old('company_name') }}" required></div>
                            <div class="pers-form-row"><div class="pers-form-group"><input class="pers-form-control" name="contact_name" placeholder="Nome completo *" value="{{ old('contact_name') }}" required></div><div class="pers-form-group"><input class="pers-form-control" type="email" name="email" placeholder="E-mail *" value="{{ old('email') }}" required></div></div>
                            <div class="pers-form-row"><div class="pers-form-group"><input class="pers-form-control" name="phone" placeholder="Telefone *" value="{{ old('phone') }}" required></div><div class="pers-form-group"><input class="pers-form-control" name="tax_id" placeholder="NIF *" value="{{ old('tax_id') }}" required></div></div>
                            <div class="pers-form-row"><div class="pers-form-group"><input class="pers-form-control" name="postal_code" placeholder="Código postal *" value="{{ old('postal_code') }}" required></div><div class="pers-form-group"><input class="pers-form-control" name="city" placeholder="Localidade *" value="{{ old('city') }}" required></div></div>
                            <div class="pers-form-group"><input class="pers-form-control" name="address" placeholder="Morada *" value="{{ old('address') }}" required><input type="hidden" name="country" value="Portugal"></div>
                            <fieldset><legend>2. Produto</legend><div class="pers-form-row"><div class="pers-form-group"><input class="pers-form-control" name="products[0][quantity]" type="number" min="1" value="{{ old('products.0.quantity', 1) }}" required></div><div class="pers-form-group"><input class="pers-form-control" name="products[0][color]" placeholder="Cor pretendida" value="{{ old('products.0.color') }}"></div></div></fieldset>
                            @php $metodo = old('metodo', 'Aconselhamento'); $locais = old('local', []); @endphp
                            <fieldset><legend>3. Método de personalização</legend><label class="pers-check"><input type="radio" name="metodo" value="DTF" @checked($metodo === 'DTF')> DTF</label><label class="pers-check"><input type="radio" name="metodo" value="Bordado" @checked($metodo === 'Bordado')> Bordado</label><label class="pers-check"><input type="radio" name="metodo" value="Aconselhamento" @checked($metodo === 'Aconselhamento')> Preciso de aconselhamento</label></fieldset>
                            <fieldset>
                                <legend>4. Local da personalização</legend>
                                <label class="pers-check"><input type="checkbox" name="local[]" value="Peito esquerdo" @checked(in_array('Peito esquerdo', $locais, true))> Peito esquerdo</label>
                                <label class="pers-check"><input type="checkbox" name="local[]" value="Costas" @checked(in_array('Costas', $locais, true))> Costas</label>
                                <label class="pers-check"><input type="checkbox" name="local[]" value="Manga" @checked(in_array('Manga', $locais, true))> Manga</label>
                                <p class="pers-hint">Depois de anexar o logótipo, a maquete abre automaticamente para o posicionar.</p>
                            </fieldset>
                            <input type="hidden" name="logo_x" id="persLogoX" value="{{ old('logo_x') }}">
                            <input type="hidden" name="logo_y" id="persLogoY" value="{{ old('logo_y') }}">
                            <input type="hidden" name="logo_scale" id="persLogoScale" value="{{ old('logo_scale', 16) }}">
                            <div class="pers-form-group">
                                <label class="pers-form-label">5. Logótipo</label>
                                <label class="pers-upload {{ $errors->has('logos.0.file') ? 'has-error' : '' }}" id="persUploadLabel"><i class="fa fa-cloud-upload-alt"></i> Anexar ficheiro (PDF, PNG, JPG)<input type="file" id="persLogoFile" name="logos[0][file]" accept=".pdf,image/png,image/jpeg,image/webp" required></label>
                                <div class="pers-logo-thumb" id="persLogoThumb">
                                    <img alt="Logótipo selecionado">
                                    <div class="pers-logo-thumb-file"><i class="fa fa-file-pdf"></i></div>
                                    <div>
                                        <strong id="persLogoName"></strong>
                                        <button type="button" id="persLogoClear">Remover</button>
                                    </div>
                                </div>
                            </div>
                            <div class="pers-form-group"><label class="pers-form-label" for="notes">6. Observações</label><textarea class="pers-form-control" id="notes" name="notes" placeholder="Indique-nos as suas preferências ou informações relevantes.">{{ old('notes') }}</textarea></div>
                            <div class="pers-privacy"><i class="fa fa-shield-alt"></i><span>Ao enviar este pedido, a nossa equipa analisará as informações e preparará uma proposta personalizada.</span></div>
                            <button class="pers-submit" type="submit"><i class="fa fa-paper-plane"></i> Enviar pedido</button>
                        </div>
                    </form>
                </aside>
            </div>
        </div>
    </div>
</main>

<div class="modal fade pers-success-modal" id="persSuccessModal" tabindex="-1" aria-labelledby="persSuccessTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body px-4 py-4">
                <div class="modal-icon" aria-hidden="true"><i class="fa fa-check"></i></div>
                <h2 id="persSuccessTitle">Pedido enviado com sucesso</h2>
                <p>A maquete foi enviada para orçamento. A nossa equipa analisa o pedido e responde por email entre 24h a 48h.</p>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Continuar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    const PRESETS = {
        'Peito esquerdo': { x: 38, y: 36, scale: 16 },
        'Costas': { x: 50, y: 32, scale: 22 },
        'Manga': { x: 82, y: 42, scale: 12 }
    };

    const mockup = document.getElementById('persMockup');
    const garment = document.getElementById('persMockupGarment');
    const logoEl = document.getElementById('persLogoDraggable');
    const logoImg = document.getElementById('persLogoDragImg');
    const resizeHandle = document.getElementById('persLogoResize');
    const fileInput = document.getElementById('persLogoFile');
    const locationInputs = document.querySelectorAll('input[name="local[]"]');
    const placeholder = document.getElementById('persMockupPlaceholder');
    const standalone = document.getElementById('persLogoStandalone');
    const standaloneImg = standalone ? standalone.querySelector('img') : null;
    const standaloneName = standalone ? standalone.querySelector('span') : null;
    const pdfBox = document.getElementById('persPdfPreview');
    const pdfName = pdfBox ? pdfBox.querySelector('strong') : null;
    const thumb = document.getElementById('persLogoThumb');
    const thumbImg = thumb ? thumb.querySelector('img') : null;
    const thumbName = document.getElementById('persLogoName');
    const clearBtn = document.getElementById('persLogoClear');
    const productImg = document.querySelector('.pers-product-img');
    const sizeWrap = document.getElementById('persLogoSizeWrap');
    const sizeInput = document.getElementById('persLogoSize');
    const sizeValue = document.getElementById('persSizeValue');
    const sizeMinus = document.getElementById('persSizeMinus');
    const sizePlus = document.getElementById('persSizePlus');
    const jumpBtn = document.getElementById('persJumpMockup');
    const mockupSection = document.getElementById('persMockupSection');
    const hiddenX = document.getElementById('persLogoX');
    const hiddenY = document.getElementById('persLogoY');
    const hiddenScale = document.getElementById('persLogoScale');

    let objectUrl = null;
    let currentIsImage = false;
    let pos = {
        x: parseFloat(hiddenX && hiddenX.value) || PRESETS['Peito esquerdo'].x,
        y: parseFloat(hiddenY && hiddenY.value) || PRESETS['Peito esquerdo'].y,
        scale: parseFloat(hiddenScale && hiddenScale.value) || PRESETS['Peito esquerdo'].scale
    };
    let drag = null;

    function clamp(value, min, max) {
        return Math.min(max, Math.max(min, value));
    }

    function round(value) {
        return Math.round(value * 10) / 10;
    }

    function applyPos() {
        if (!logoEl) return;
        logoEl.style.left = pos.x + '%';
        logoEl.style.top = pos.y + '%';
        logoEl.style.width = pos.scale + '%';
        if (hiddenX) hiddenX.value = round(pos.x);
        if (hiddenY) hiddenY.value = round(pos.y);
        if (hiddenScale) hiddenScale.value = round(pos.scale);
        if (sizeInput && document.activeElement !== sizeInput) {
            sizeInput.value = round(pos.scale);
        }
        if (sizeValue) sizeValue.textContent = Math.round(pos.scale) + '%';
    }

    function setToolsVisible(visible) {
        if (sizeWrap) {
            sizeWrap.hidden = !visible;
            sizeWrap.classList.toggle('is-visible', visible);
        }
        if (jumpBtn) jumpBtn.classList.toggle('is-visible', visible);
    }

    function focusMockup() {
        if (!mockupSection) return;
        mockupSection.classList.add('is-focused');
        mockupSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
        window.clearTimeout(focusMockup._timer);
        focusMockup._timer = window.setTimeout(function () {
            mockupSection.classList.remove('is-focused');
        }, 1800);
    }

    function pointerPercent(clientX, clientY) {
        if (!garment) return { x: 0, y: 0 };
        const rect = garment.getBoundingClientRect();
        return {
            x: ((clientX - rect.left) / rect.width) * 100,
            y: ((clientY - rect.top) / rect.height) * 100
        };
    }

    function jumpToPreset(label) {
        const preset = PRESETS[label] || PRESETS['Peito esquerdo'];
        pos = { x: preset.x, y: preset.y, scale: preset.scale };
        applyPos();
    }

    function setMockupHasLogo(hasLogo) {
        if (mockup) mockup.classList.toggle('has-logo', hasLogo);
    }

    function hideImagePreview() {
        if (logoEl) logoEl.classList.remove('is-visible', 'is-dragging');
        if (logoImg) logoImg.removeAttribute('src');
        if (standalone) standalone.classList.remove('is-visible');
        if (placeholder) placeholder.hidden = false;
        if (productImg) productImg.closest('.pers-mockup-product').style.display = '';
        setToolsVisible(false);
    }

    function showImage(url, name, fromSubmit) {
        currentIsImage = true;
        setMockupHasLogo(true);
        if (pdfBox) pdfBox.classList.remove('is-visible');
        if (logoImg) logoImg.src = url;
        if (logoEl) logoEl.classList.add('is-visible');
        applyPos();
        if (standalone && standaloneImg) {
            standaloneImg.src = url;
            if (standaloneName) standaloneName.textContent = name;
            standalone.classList.add('is-visible');
        }
        if (placeholder) placeholder.hidden = true;
        if (thumb) {
            thumb.classList.toggle('is-visible', !fromSubmit);
            thumb.classList.remove('is-file');
        }
        if (thumbImg) thumbImg.src = fromSubmit ? '' : url;
        if (thumbName && !fromSubmit) thumbName.textContent = name;
        if (productImg) productImg.closest('.pers-mockup-product').style.display = '';
        setToolsVisible(!!logoEl);
        if (!fromSubmit) focusMockup();
    }

    function showPdf(name, fromSubmit) {
        currentIsImage = false;
        setMockupHasLogo(true);
        hideImagePreview();
        if (placeholder) placeholder.hidden = true;
        if (productImg) productImg.closest('.pers-mockup-product').style.display = 'none';
        if (pdfBox) pdfBox.classList.add('is-visible');
        if (pdfName) pdfName.textContent = name;
        if (thumb) {
            thumb.classList.toggle('is-visible', !fromSubmit);
            thumb.classList.toggle('is-file', !fromSubmit);
        }
        if (thumbName && !fromSubmit) thumbName.textContent = name;
        if (hiddenX) hiddenX.value = '';
        if (hiddenY) hiddenY.value = '';
        if (!fromSubmit) focusMockup();
    }

    function resetPreview() {
        if (objectUrl) {
            URL.revokeObjectURL(objectUrl);
            objectUrl = null;
        }
        currentIsImage = false;
        drag = null;
        setMockupHasLogo(false);
        hideImagePreview();
        if (pdfBox) pdfBox.classList.remove('is-visible');
        if (thumb) thumb.classList.remove('is-visible', 'is-file');
        if (thumbImg) thumbImg.removeAttribute('src');
        if (fileInput) fileInput.value = '';
        pos = { x: PRESETS['Peito esquerdo'].x, y: PRESETS['Peito esquerdo'].y, scale: PRESETS['Peito esquerdo'].scale };
        applyPos();
    }

    function startDrag(event, mode) {
        if (!currentIsImage || !logoEl || !garment) return;
        event.preventDefault();
        event.stopPropagation();
        const pointer = pointerPercent(event.clientX, event.clientY);
        drag = {
            mode: mode,
            pointerId: event.pointerId,
            offsetX: pointer.x - pos.x,
            offsetY: pointer.y - pos.y,
            startX: pointer.x,
            startY: pointer.y,
            startScale: pos.scale
        };
        logoEl.classList.add('is-dragging');
        event.currentTarget.setPointerCapture(event.pointerId);
    }

    function moveDrag(event) {
        if (!drag || event.pointerId !== drag.pointerId) return;
        const pointer = pointerPercent(event.clientX, event.clientY);
        if (drag.mode === 'resize') {
            const delta = ((pointer.x - drag.startX) + (pointer.y - drag.startY)) / 2;
            pos.scale = clamp(drag.startScale + delta, 8, 40);
        } else {
            pos.x = clamp(pointer.x - drag.offsetX, 8, 92);
            pos.y = clamp(pointer.y - drag.offsetY, 8, 92);
        }
        applyPos();
    }

    function endDrag(event) {
        if (!drag || event.pointerId !== drag.pointerId) return;
        drag = null;
        if (logoEl) logoEl.classList.remove('is-dragging');
    }

    if (fileInput) {
        fileInput.addEventListener('change', function () {
            const file = this.files && this.files[0];
            if (!file) {
                resetPreview();
                return;
            }
            if (objectUrl) {
                URL.revokeObjectURL(objectUrl);
                objectUrl = null;
            }
            if (file.type === 'application/pdf' || /\.pdf$/i.test(file.name)) {
                showPdf(file.name);
                return;
            }
            objectUrl = URL.createObjectURL(file);
            const checked = Array.from(locationInputs).filter(function (input) { return input.checked; }).pop();
            if (checked) jumpToPreset(checked.value);
            showImage(objectUrl, file.name);
        });
    }

    locationInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            if (input.checked && currentIsImage) {
                jumpToPreset(input.value);
                focusMockup();
            }
        });
    });

    if (clearBtn) {
        clearBtn.addEventListener('click', resetPreview);
    }

    if (sizeInput) {
        sizeInput.addEventListener('input', function () {
            pos.scale = clamp(parseFloat(this.value) || pos.scale, 8, 40);
            applyPos();
        });
    }

    if (sizeMinus) {
        sizeMinus.addEventListener('click', function () {
            pos.scale = clamp(pos.scale - 1.5, 8, 40);
            applyPos();
        });
    }

    if (sizePlus) {
        sizePlus.addEventListener('click', function () {
            pos.scale = clamp(pos.scale + 1.5, 8, 40);
            applyPos();
        });
    }

    if (jumpBtn) {
        jumpBtn.addEventListener('click', focusMockup);
    }

    if (logoEl) {
        logoEl.addEventListener('pointerdown', function (event) {
            if (event.target === resizeHandle) return;
            startDrag(event, 'move');
        });
        logoEl.addEventListener('dragstart', function (event) { event.preventDefault(); });
    }

    if (resizeHandle) {
        resizeHandle.addEventListener('pointerdown', function (event) {
            startDrag(event, 'resize');
        });
    }

    document.addEventListener('pointermove', moveDrag);
    document.addEventListener('pointerup', endDrag);
    document.addEventListener('pointercancel', endDrag);

    if (mockup && mockup.dataset.submittedUrl) {
        if (mockup.dataset.submittedX) pos.x = parseFloat(mockup.dataset.submittedX) || pos.x;
        if (mockup.dataset.submittedY) pos.y = parseFloat(mockup.dataset.submittedY) || pos.y;
        if (mockup.dataset.submittedScale) pos.scale = parseFloat(mockup.dataset.submittedScale) || pos.scale;
        if (mockup.dataset.submittedImage === '1') {
            showImage(mockup.dataset.submittedUrl, mockup.dataset.submittedName || 'Logótipo enviado', true);
        } else {
            showPdf(mockup.dataset.submittedName || 'Logótipo enviado', true);
        }
    } else {
        applyPos();
    }

    const form = document.getElementById('persQuoteForm');
    const mockupInput = document.getElementById('persMockupFile');

    function captureMockup() {
        return new Promise(function (resolve) {
            if (!currentIsImage || !productImg || !logoImg || !logoEl || !logoEl.classList.contains('is-visible')) {
                resolve(null);
                return;
            }

            try {
                const srcW = productImg.naturalWidth || productImg.width;
                const srcH = productImg.naturalHeight || productImg.height;
                if (!srcW || !srcH || !logoImg.naturalWidth) {
                    resolve(null);
                    return;
                }

                const maxW = 1200;
                const width = srcW > maxW ? maxW : srcW;
                const height = Math.round(srcH * (width / srcW));
                const canvas = document.createElement('canvas');
                canvas.width = width;
                canvas.height = height;
                const ctx = canvas.getContext('2d');
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, width, height);
                ctx.drawImage(productImg, 0, 0, width, height);

                const logoWidth = (pos.scale / 100) * width;
                const logoHeight = logoWidth * (logoImg.naturalHeight / logoImg.naturalWidth);
                const x = (pos.x / 100) * width - logoWidth / 2;
                const y = (pos.y / 100) * height - logoHeight / 2;
                ctx.drawImage(logoImg, x, y, logoWidth, logoHeight);

                canvas.toBlob(function (blob) {
                    resolve(blob);
                }, 'image/png');
            } catch (error) {
                resolve(null);
            }
        });
    }

    if (form) {
        form.addEventListener('submit', function (event) {
            if (form.dataset.mockupReady === '1') {
                return;
            }

            event.preventDefault();
            const submitBtn = form.querySelector('.pers-submit');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.dataset.originalHtml = submitBtn.innerHTML;
                submitBtn.innerHTML = 'A gerar maquete...';
            }

            captureMockup().then(function (blob) {
                if (blob && mockupInput) {
                    const file = new File([blob], 'maquete.png', { type: 'image/png' });
                    const transfer = new DataTransfer();
                    transfer.items.add(file);
                    mockupInput.files = transfer.files;
                }
            }).catch(function () {
                return null;
            }).finally(function () {
                form.dataset.mockupReady = '1';
                form.submit();
            });
        });
    }

    @if (session('personalization_success'))
    const successEl = document.getElementById('persSuccessModal');
    if (successEl && window.bootstrap) {
        new bootstrap.Modal(successEl).show();
    }
    @endif
})();
</script>
@endpush

