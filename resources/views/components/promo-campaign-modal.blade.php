@php
    /** @var \App\Models\PromoCampaign|null $promoCampaign */
@endphp

@if ($promoCampaign)
<style>
    .promo-modal-dialog {
        max-width: min(920px, 92vw);
        width: 92vw;
        margin: 1rem auto;
    }
    .promo-modal-content {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
    }
    .promo-modal-image {
        max-height: min(62vh, 540px);
        object-fit: contain;
        background: #fff;
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
            width: 94vw;
        }
        .promo-modal-image {
            max-height: min(52vh, 420px);
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
                    class="w-100 d-block promo-modal-image"
                >
                <div class="p-3 p-md-4 text-center" style="background: #fff;">
                    <a
                        href="{{ route('promotions.unlock', $promoCampaign) }}"
                        class="btn btn-lg w-100 fw-bold text-uppercase"
                        style="background: #ff4500; border-color: #ff4500; color: #fff; letter-spacing: .03em;"
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
        const campaignId = @json($promoCampaign->id);
        const storageKey = `promo_campaign_dismissed_${campaignId}`;
        if (window.localStorage.getItem(storageKey) === '1') {
            return;
        }

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

        modalEl.addEventListener('hidden.bs.modal', () => {
            window.localStorage.setItem(storageKey, '1');
        });

        document.getElementById('promoCampaignCta')?.addEventListener('click', () => {
            window.localStorage.setItem(storageKey, '1');
        });
    })();
</script>
@endpush
@endif
