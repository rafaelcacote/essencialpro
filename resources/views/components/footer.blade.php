<style>
    .ep-footer {
        background: #0b1c3e;
        color: #c8d5e8;
        margin-top: 3rem;
        font-size: 0.9rem;
    }
    .ep-footer strong, .ep-footer b { color: #fff; }
    .ep-footer-main { padding: 2.5rem 0 1.4rem; }
    .ep-footer-grid {
        display: grid;
        grid-template-columns: 1.25fr 0.85fr 1fr 0.85fr 1fr;
        gap: 1.5rem;
    }

    /* Col 1 - brand */
    .ep-footer-brand-logo { max-width: 190px; margin-bottom: 0.75rem; display: block; }
    .ep-footer-brand p { line-height: 1.55; margin-bottom: 1rem; color: #b8c9e1; }
    .ep-footer-contact-item {
        display: flex; gap: 0.6rem; align-items: flex-start; margin-bottom: 0.6rem; color: #b8c9e1;
    }
    .ep-footer-contact-item i { color: #f97316; font-size: 1.15rem; margin-top: 0.05rem; flex-shrink: 0; }
    .ep-footer-contact-item span { line-height: 1.4; }
    .ep-footer-contact-item span strong { display: block; color: #fff; }
    .ep-social-row { display: flex; gap: 0.45rem; margin-top: 0.9rem; }
    .ep-social-btn {
        width: 34px; height: 34px; border-radius: 50%; background: #f97316; color: #fff;
        display: inline-flex; align-items: center; justify-content: center;
        text-decoration: none; font-size: 0.95rem; transition: background 0.2s;
    }
    .ep-social-btn:hover { background: #ea580c; color: #fff; }

    /* Col headings */
    .ep-footer-col-title {
        color: #fff; font-weight: 900; text-transform: uppercase; letter-spacing: 0.6px;
        font-size: 0.95rem; margin-bottom: 0.9rem;
    }

    /* Col 2 - links */
    .ep-quick-link {
        display: flex; align-items: center; gap: 0.45rem; color: #b8c9e1;
        text-decoration: none; margin-bottom: 0.45rem; transition: color 0.15s;
    }
    .ep-quick-link i { color: #f97316; font-size: 0.7rem; }
    .ep-quick-link:hover { color: #f97316; }

    /* Col 3 - atendimento */
    .ep-att-block { margin-bottom: 1rem; }
    .ep-att-block-header { display: flex; gap: 0.5rem; align-items: center; margin-bottom: 0.35rem; }
    .ep-att-block-header i { color: #f97316; font-size: 1.1rem; }
    .ep-att-block-header span { color: #fff; font-weight: 800; font-size: 0.9rem; }
    .ep-att-schedule { padding-left: 1.6rem; color: #b8c9e1; line-height: 1.7; }
    .ep-att-schedule strong { color: #fff; display: block; }
    .ep-att-divider { border-top: 1px solid rgba(255,255,255,0.1); margin: 0.7rem 0; }
    .ep-att-desc { padding-left: 1.6rem; color: #b8c9e1; line-height: 1.5; margin-bottom: 0.8rem; }
    .ep-whatsapp-btn {
        display: inline-flex; align-items: center; gap: 0.5rem;
        border: 1px solid rgba(255,255,255,0.35); border-radius: 8px;
        color: #fff; text-decoration: none; padding: 0.55rem 1rem;
        font-weight: 700; font-size: 0.87rem; text-transform: uppercase;
        transition: all 0.18s;
    }
    .ep-whatsapp-btn:hover { background: #22c55e; border-color: #22c55e; color: #fff; }
    .ep-whatsapp-btn i { color: #22c55e; }
    .ep-whatsapp-btn:hover i { color: #fff; }

    /* Col 4 - diferenciais */
    .ep-diferencial {
        display: flex; gap: 0.55rem; align-items: flex-start; margin-bottom: 0.85rem;
    }
    .ep-diferencial-icon {
        width: 38px; height: 38px; border-radius: 50%; border: 2px solid rgba(249,115,22,0.6);
        display: inline-flex; align-items: center; justify-content: center;
        color: #f97316; font-size: 1.05rem; flex-shrink: 0;
    }
    .ep-diferencial-text strong { color: #fff; font-size: 0.87rem; display: block; line-height: 1.2; }
    .ep-diferencial-text span { color: #8da5c5; font-size: 0.81rem; line-height: 1.35; }

    /* Col 5 - newsletter */
    .ep-newsletter-desc { color: #b8c9e1; line-height: 1.5; margin-bottom: 0.9rem; }
    .ep-newsletter-input {
        width: 100%; background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.18);
        border-radius: 8px; color: #fff; padding: 0.6rem 0.85rem; margin-bottom: 0.6rem;
        outline: none; font-size: 0.9rem;
    }
    .ep-newsletter-input::placeholder { color: #6e8dad; }
    .ep-newsletter-btn {
        width: 100%; border: none; border-radius: 8px; background: #f97316;
        color: #fff; font-weight: 900; text-transform: uppercase; letter-spacing: 0.5px;
        padding: 0.65rem; font-size: 0.88rem; cursor: pointer; transition: background 0.18s;
    }
    .ep-newsletter-btn:hover { background: #ea580c; }

    /* Bottom bar */
    .ep-footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.1);
        padding: 1rem 0 0.9rem;
    }
    .ep-footer-bottom-grid {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 2rem;
        align-items: center;
    }
    .ep-payments-label { color: #fff; font-weight: 800; text-transform: uppercase; font-size: 0.8rem; margin-bottom: 0.5rem; }
    .ep-payments-row { display: flex; gap: 0.45rem; flex-wrap: wrap; }
    .ep-payment-badge {
        background: #fff; color: #0f172a; border-radius: 5px; padding: 0.22rem 0.55rem;
        font-weight: 900; font-size: 0.78rem; letter-spacing: 0.3px;
    }
    .ep-trust-row { display: flex; gap: 1.2rem; flex-wrap: wrap; justify-content: flex-end; }
    .ep-trust-item { display: flex; gap: 0.5rem; align-items: center; }
    .ep-trust-item i { color: #fff; font-size: 1.2rem; }
    .ep-trust-item div strong { color: #fff; font-size: 0.82rem; display: block; line-height: 1.2; }
    .ep-trust-item div span { color: #8da5c5; font-size: 0.76rem; }

    /* Copyright */
    .ep-footer-copyright {
        border-top: 1px solid rgba(255,255,255,0.1);
        padding: 0.75rem 0 1rem;
        display: flex; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;
        font-size: 0.83rem; color: #8da5c5;
    }
    .ep-footer-copyright a { color: #f97316; text-decoration: none; }
    .ep-footer-copyright-links { display: flex; gap: 0.8rem; flex-wrap: wrap; }
    .ep-footer-copyright-links a { color: #b8c9e1; text-decoration: none; }
    .ep-footer-copyright-links a:hover { color: #f97316; }
    .ep-heart { color: #f97316; }

    @media (max-width: 1199.98px) {
        .ep-footer-grid { grid-template-columns: 1fr 1fr 1fr; }
    }
    @media (max-width: 767.98px) {
        .ep-footer-grid { grid-template-columns: 1fr; }
        .ep-footer-bottom-grid { grid-template-columns: 1fr; }
        .ep-trust-row { justify-content: flex-start; }
        .ep-footer-copyright { flex-direction: column; align-items: flex-start; }
    }
</style>

<footer class="ep-footer">
    <div class="container ep-footer-main">
        <div class="ep-footer-grid">

            {{-- Col 1: Marca --}}
            <div class="ep-footer-brand">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/logo_essencial_branco.svg') }}" alt="Essencial Pro" class="ep-footer-brand-logo">
                </a>
                <p>Fornecemos equipamentos de proteção individual e vestuário profissional para empresas que valorizam segurança, qualidade e desempenho no dia a dia.</p>
                <div class="ep-footer-contact-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span><strong>Portugal | Europa</strong>Entregas para todo o país e Europa</span>
                </div>
                <div class="ep-footer-contact-item">
                    <i class="bi bi-telephone-fill"></i>
                    <span><strong>+351 910 000 000</strong>Atendimento via WhatsApp</span>
                </div>
                <div class="ep-footer-contact-item">
                    <i class="bi bi-envelope-fill"></i>
                    <span><strong>contato@essencialpro.com</strong>Respondemos rapidamente</span>
                </div>
                <div class="ep-social-row">
                    <a href="#" class="ep-social-btn" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="ep-social-btn" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="ep-social-btn" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    <a href="#" class="ep-social-btn" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

            {{-- Col 2: Links rápidos --}}
            <div>
                <h5 class="ep-footer-col-title">Links rápidos</h5>
                <a class="ep-quick-link" href="{{ route('about') }}"><i class="bi bi-chevron-right"></i> Sobre nós</a>
                <a class="ep-quick-link" href="{{ route('product') }}"><i class="bi bi-chevron-right"></i> Nossos produtos</a>
                <a class="ep-quick-link" href="{{ route('contact') }}"><i class="bi bi-chevron-right"></i> Personalização</a>
                <a class="ep-quick-link" href="{{ route('contact') }}"><i class="bi bi-chevron-right"></i> Contato</a>
                <a class="ep-quick-link" href="#"><i class="bi bi-chevron-right"></i> Termos e condições</a>
                <a class="ep-quick-link" href="#"><i class="bi bi-chevron-right"></i> Política de privacidade</a>
                <a class="ep-quick-link" href="#"><i class="bi bi-chevron-right"></i> Trocas e devoluções</a>
                <a class="ep-quick-link" href="{{ route('contact') }}"><i class="bi bi-chevron-right"></i> Suporte</a>
            </div>

            {{-- Col 3: Atendimento --}}
            <div>
                <h5 class="ep-footer-col-title">Atendimento</h5>
                <div class="ep-att-block">
                    <div class="ep-att-block-header">
                        <i class="bi bi-clock"></i>
                        <span>Horário de Funcionamento</span>
                    </div>
                    <div class="ep-att-schedule">
                        Segunda – Sexta<strong>08:00 – 18:00</strong>
                        Sábado<strong>08:00 – 12:00</strong>
                        Domingo<strong>Fechado</strong>
                    </div>
                </div>
                <div class="ep-att-divider"></div>
                <div class="ep-att-block">
                    <div class="ep-att-block-header">
                        <i class="bi bi-headset"></i>
                        <span>Atendimento Rápido</span>
                    </div>
                    <div class="ep-att-desc">Fale conosco pelo WhatsApp e receba um atendimento ágil e personalizado.</div>
                    <a href="{{ route('contact') }}" class="ep-whatsapp-btn">
                        <i class="bi bi-whatsapp"></i> Falar no WhatsApp
                    </a>
                </div>
            </div>

            {{-- Col 4: Diferenciais --}}
            <div>
                <h5 class="ep-footer-col-title">&nbsp;</h5>
                <div class="ep-diferencial">
                    <span class="ep-diferencial-icon"><i class="bi bi-shield-check"></i></span>
                    <div class="ep-diferencial-text">
                        <strong>Compra Segura</strong>
                        <span>Ambiente 100% seguro para suas compras</span>
                    </div>
                </div>
                <div class="ep-diferencial">
                    <span class="ep-diferencial-icon"><i class="bi bi-truck"></i></span>
                    <div class="ep-diferencial-text">
                        <strong>Entrega Rápida</strong>
                        <span>Enviamos para todo Portugal e Europa</span>
                    </div>
                </div>
                <div class="ep-diferencial">
                    <span class="ep-diferencial-icon"><i class="bi bi-arrow-repeat"></i></span>
                    <div class="ep-diferencial-text">
                        <strong>Troca Garantida</strong>
                        <span>Satisfação garantida ou seu dinheiro de volta</span>
                    </div>
                </div>
                <div class="ep-diferencial">
                    <span class="ep-diferencial-icon"><i class="bi bi-award"></i></span>
                    <div class="ep-diferencial-text">
                        <strong>Produtos de Qualidade</strong>
                        <span>Trabalhamos com as melhores marcas</span>
                    </div>
                </div>
            </div>

            {{-- Col 5: Newsletter --}}
            <div>
                <h5 class="ep-footer-col-title">Newsletter</h5>
                <p class="ep-newsletter-desc">Receba nossas ofertas, novidades e conteúdos exclusivos.</p>
                <input type="email" class="ep-newsletter-input" placeholder="Seu melhor e-mail">
                <button type="button" class="ep-newsletter-btn">Inscrever-se</button>
            </div>
        </div>
    </div>

    {{-- Bottom: Pagamentos + Selos --}}
    <div class="ep-footer-bottom">
        <div class="container">
            <div class="ep-footer-bottom-grid">
                <div>
                    <p class="ep-payments-label">Formas de pagamento</p>
                    <img src="{{ asset('img/formas-pagamento.png') }}" alt="Formas de pagamento: VISA, Mastercard, MB WAY, PayPal, Apple Pay" style="max-height: 44px; width: auto; display: block;">
                </div>
                <div class="ep-trust-row">
                    <div class="ep-trust-item">
                        <i class="bi bi-shield-check"></i>
                        <div><strong>Ambiente seguro</strong><span>Seus dados protegidos</span></div>
                    </div>
                    <div class="ep-trust-item">
                        <i class="bi bi-lock"></i>
                        <div><strong>Privacidade garantida</strong><span>Seus dados estão seguros</span></div>
                    </div>
                    <div class="ep-trust-item">
                        <i class="bi bi-people"></i>
                        <div><strong>Foco no cliente</strong><span>Soluções personalizadas</span></div>
                    </div>
                    <div class="ep-trust-item">
                        <i class="bi bi-check2-circle"></i>
                        <div><strong>Experiência segura</strong><span>Mais confiança em todas as compras</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="container ep-footer-copyright">
        <span>© {{ date('Y') }} <a href="{{ route('home') }}">Essencial Pro</a>. Todos os direitos reservados.</span>
        <div class="ep-footer-copyright-links">
            <a href="#">Política de Privacidade</a>
            <span>|</span>
            <a href="#">Termos e Condições</a>
            <span>|</span>
            <a href="#">Trocas e Devoluções</a>
        </div>
        <span>Desenvolvido com <i class="bi bi-heart-fill ep-heart"></i> para sua segurança.</span>
    </div>
</footer>
