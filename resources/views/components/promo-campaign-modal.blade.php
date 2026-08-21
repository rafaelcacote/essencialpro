@php
    /** @var \App\Models\PromoCampaign|null $promoCampaign */
@endphp

@if ($promoCampaign)
<style>
    .promo-modal-dialog {
        max-width: min(760px, 90vw);
        width: auto;
        margin: 1rem auto;
    }
    .promo-modal-content {
        position: relative;
        width: fit-content;
        max-width: 100%;
        margin: 0 auto;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
    }
    .promo-modal-image {
        display: block;
        width: auto;
        height: auto;
        max-width: 100%;
        max-height: min(72vh, 620px);
        object-fit: contain;
        background: #fff;
    }
    .promo-modal-actions {
        display: flex;
        justify-content: center;
        padding: .85rem 1rem 1rem;
        background: #fff;
    }
    .promo-modal-cta {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        max-width: 100%;
        padding: .7rem 1.75rem;
        border-radius: 6px;
        background: #ff4500;
        color: #fff !important;
        font-size: 1rem;
        font-weight: 700;
        letter-spacing: .04em;
        text-transform: uppercase;
        text-decoration: none;
        line-height: 1.25;
        white-space: nowrap;
    }
    .promo-modal-cta:hover,
    .promo-modal-cta:focus {
        background: #e03d00;
        color: #fff;
        outline: none;
    }
    .promo-modal-close {
        position: absolute;
        top: .65rem;
        right: .65rem;
        z-index: 20;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.15rem;
        height: 2.15rem;
        padding: 0;
        border: 2px solid #fff;
        border-radius: 999px;
        background: #1d2b41;
        color: #fff;
        box-shadow: 0 3px 12px rgba(0, 0, 0, .35);
        cursor: pointer;
        line-height: 1;
    }
    .promo-modal-close:hover,
    .promo-modal-close:focus {
        background: #ff4500;
        color: #fff;
        outline: none;
    }
    .promo-modal-close svg {
        width: .9rem;
        height: .9rem;
        display: block;
        pointer-events: none;
    }
    @media (max-width: 767.98px) {
        .promo-modal-dialog {
            max-width: 94vw;
        }
        .promo-modal-image {
            max-height: min(58vh, 440px);
        }
        .promo-modal-cta {
            white-space: normal;
            text-align: center;
            font-size: .9rem;
            padding: .65rem 1.35rem;
        }
        .promo-modal-close {
            top: .5rem;
            right: .5rem;
        }
    }
</style>

<div
    class="modal fade"
    id="promoCampaignModal"
    tabindex="-1"
    aria-labelledby="promoCampaignModalLabel"
    aria-hidden="true"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
>
    <div class="modal-dialog modal-dialog-centered modal-lg promo-modal-dialog">
        <div class="modal-content border-0 promo-modal-content">
            <button
                type="button"
                class="promo-modal-close"
                data-bs-dismiss="modal"
                aria-label="Fechar"
            >
                <svg viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                    <path fill="currentColor" d="M3.2 3.2a.75.75 0 0 1 1.06 0L8 6.94l3.74-3.74a.75.75 0 1 1 1.06 1.06L9.06 8l3.74 3.74a.75.75 0 1 1-1.06 1.06L8 9.06l-3.74 3.74a.75.75 0 1 1-1.06-1.06L6.94 8 3.2 4.26a.75.75 0 0 1 0-1.06z"/>
                </svg>
            </button>
            <div class="modal-body p-0">
                <img
                    src="{{ asset($promoCampaign->image_path) }}"
                    alt="{{ $promoCampaign->title }}"
                    class="promo-modal-image"
                >
                <div class="promo-modal-actions">
                    <a
                        href="{{ route('promotions.unlock', $promoCampaign) }}"
                        class="promo-modal-cta"
                        id="promoCampaignCta"
                    >
                        {{ $promoCampaign->button_text }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    (() => {
        const modalEl = document.getElementById('promoCampaignModal');
        if (!modalEl || typeof bootstrap === 'undefined') {
            return;
        }

        const modal = new bootstrap.Modal(modalEl, {
            backdrop: 'static',
            keyboard: false,
        });
        const show = () => modal.show();

        if (document.readyState === 'complete') {
            setTimeout(show, 600);
        } else {
            window.addEventListener('load', () => setTimeout(show, 600));
        }
    })();
</script>
@endpush
@endif
