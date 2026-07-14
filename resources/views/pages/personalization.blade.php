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
    .pers-proof-copy { padding: 1.15rem; border-right: 1px solid #ececec; }
    .pers-proof-copy h3 { font-size: 1.05rem; font-weight: 800; margin: 0 0 .7rem; }
    .pers-proof-copy p, .pers-proof-copy li { color: #555; font-size: .75rem; line-height: 1.55; }
    .pers-proof-copy ul { list-style: none; padding: 0; margin: .8rem 0; }
    .pers-proof-copy li { margin-bottom: .38rem; }
    .pers-proof-copy li i { color: var(--pers-orange); margin-right: .35rem; }
    .pers-note { display: flex; gap: .5rem; padding: .6rem; background: #fff8f5; color: #62514a; font-size: .68rem; line-height: 1.45; }
    .pers-note i { color: var(--pers-orange); margin-top: .15rem; }
    .pers-mockup { min-height: 320px; display: grid; place-items: center; padding: 1.2rem; background: radial-gradient(circle at center, #fff 0%, #fafafa 64%, #f1f1f1 100%); position: relative; overflow: hidden; }
    .pers-mockup::before { content: 'MAQUETE DO PRODUTO'; position: absolute; top: .7rem; left: .8rem; color: #aaa; font-size: .61rem; letter-spacing: .08em; font-weight: 700; }
    .pers-mockup-placeholder { width: 70%; aspect-ratio: 4 / 5; display: grid; place-items: center; text-align: center; color: #9aa0a6; border: 1px dashed #cbd0d5; background: rgba(255,255,255,.65); font-size: .78rem; line-height: 1.45; }
    .pers-mockup-placeholder i { font-size: 2.2rem; color: var(--pers-orange); display: block; margin-bottom: .5rem; }
    .pers-methods { display: grid; grid-template-columns: 1fr 1fr; gap: .9rem; }
    .pers-method { min-height: 150px; padding: 1.25rem; color: #fff; position: relative; overflow: hidden; background: #202020; }
    .pers-method::after { content: ''; position: absolute; inset: 0; background: linear-gradient(120deg, rgba(0,0,0,.12), rgba(0,0,0,.72)); }
    .pers-method > * { position: relative; z-index: 1; }
    .pers-method-icon { width: 30px; height: 30px; display: inline-grid; place-items: center; color: #fff; background: var(--pers-orange); border-radius: 50%; font-size: .8rem; }
    .pers-method h3 { font-size: 1rem; font-weight: 800; margin: .55rem 0 .3rem; }
    .pers-method p { font-size: .72rem; line-height: 1.4; margin: 0; max-width: 260px; }
    .pers-method--dtf { background: linear-gradient(115deg, #343434, #111); }
    .pers-method--emb { background: linear-gradient(115deg, #42362d, #111); }
    .pers-examples { display: grid; grid-template-columns: repeat(3, 1fr); gap: .8rem; }
    .pers-example { aspect-ratio: 1.2; background: #e7e7e7; position: relative; overflow: hidden; display: grid; place-items: center; color: #858585; text-align: center; font-size: .7rem; border: 1px solid #ddd; }
    .pers-example i { display: block; font-size: 1.6rem; color: #aaa; margin-bottom: .4rem; }
    .pers-example-badge { position: absolute; inset: auto 0 0; padding: .32rem; color: #fff; background: var(--pers-orange); font-size: .62rem; font-weight: 800; text-transform: uppercase; }
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
                            <div class="pers-mockup">
                                <div class="pers-mockup-placeholder"><div><i class="fa fa-image"></i>Área reservada para a maquete<br>do produto personalizado</div></div>
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
                            <div class="pers-example"><div><i class="fa fa-image"></i>Exemplo de personalização</div><span class="pers-example-badge">Antes / Depois</span></div>
                            <div class="pers-example"><div><i class="fa fa-image"></i>Exemplo de personalização</div><span class="pers-example-badge">Antes / Depois</span></div>
                            <div class="pers-example"><div><i class="fa fa-image"></i>Exemplo de personalização</div><span class="pers-example-badge">Antes / Depois</span></div>
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
                    <form action="{{ route('contact.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="client_type" value="company">
                        <input type="hidden" name="products[0][name]" value="{{ request('produto', 'Produto a personalizar') }}">
                        <input type="hidden" name="products[0][reference]" value="">
                        <input type="hidden" name="products[0][color]" value="">
                        <div class="pers-form-body">
                            <div class="pers-form-group"><label class="pers-form-label" for="company_name">1. Dados de contacto</label><input class="pers-form-control" id="company_name" name="company_name" placeholder="Nome da empresa *" required></div>
                            <div class="pers-form-row"><div class="pers-form-group"><input class="pers-form-control" name="contact_name" placeholder="Nome completo *" required></div><div class="pers-form-group"><input class="pers-form-control" type="email" name="email" placeholder="E-mail *" required></div></div>
                            <div class="pers-form-row"><div class="pers-form-group"><input class="pers-form-control" name="phone" placeholder="Telefone *" required></div><div class="pers-form-group"><input class="pers-form-control" name="tax_id" placeholder="NIF *" required></div></div>
                            <div class="pers-form-row"><div class="pers-form-group"><input class="pers-form-control" name="postal_code" placeholder="Código postal *" required></div><div class="pers-form-group"><input class="pers-form-control" name="city" placeholder="Localidade *" required></div></div>
                            <div class="pers-form-group"><input class="pers-form-control" name="address" placeholder="Morada *" required><input type="hidden" name="country" value="Portugal"></div>
                            <fieldset><legend>2. Produto</legend><div class="pers-form-row"><div class="pers-form-group"><input class="pers-form-control" name="products[0][quantity]" type="number" min="1" value="1" required></div><div class="pers-form-group"><input class="pers-form-control" placeholder="Cor pretendida"></div></div></fieldset>
                            <fieldset><legend>3. Método de personalização</legend><label class="pers-check"><input type="radio" name="metodo" value="DTF"> DTF</label><label class="pers-check"><input type="radio" name="metodo" value="Bordado"> Bordado</label><label class="pers-check"><input type="radio" name="metodo" value="Aconselhamento" checked> Preciso de aconselhamento</label></fieldset>
                            <fieldset><legend>4. Local da personalização</legend><label class="pers-check"><input type="checkbox" name="local[]" value="Peito esquerdo"> Peito esquerdo</label><label class="pers-check"><input type="checkbox" name="local[]" value="Costas"> Costas</label><label class="pers-check"><input type="checkbox" name="local[]" value="Manga"> Manga</label></fieldset>
                            <div class="pers-form-group"><label class="pers-form-label">5. Logótipo</label><label class="pers-upload"><i class="fa fa-cloud-upload-alt"></i> Anexar ficheiro (PDF, PNG, JPG)<input type="file" name="logos[0][file]" accept=".pdf,image/*"></label><input type="hidden" name="logos[0][location]" value=""><input type="hidden" name="logos[0][pieces]" value=""></div>
                            <div class="pers-form-group"><label class="pers-form-label" for="notes">6. Observações</label><textarea class="pers-form-control" id="notes" name="notes" placeholder="Indique-nos as suas preferências ou informações relevantes."></textarea></div>
                            <div class="pers-privacy"><i class="fa fa-shield-alt"></i><span>Ao enviar este pedido, a nossa equipa analisará as informações e preparará uma proposta personalizada.</span></div>
                            <button class="pers-submit" type="submit"><i class="fa fa-paper-plane"></i> Enviar pedido</button>
                        </div>
                    </form>
                </aside>
            </div>
        </div>
    </div>
</main>
@endsection
