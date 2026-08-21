@php
    $promoCouponNotice = session('promo_coupon_notice');
@endphp

@if ($promoCouponNotice)
<style>
    .promo-notice-modal .modal-content {
        border: 0;
        border-radius: 10px;
        text-align: center;
        overflow: hidden;
    }
    .promo-notice-modal .modal-body {
        padding: 1.75rem 1.5rem 1.5rem;
    }
    .promo-notice-modal__icon {
        width: 56px;
        height: 56px;
        margin: 0 auto .9rem;
        display: grid;
        place-items: center;
        border-radius: 50%;
        background: #fff3ed;
        color: #ff4500;
        font-size: 1.45rem;
    }
    .promo-notice-modal__title {
        font-size: 1.15rem;
        font-weight: 800;
        margin: 0 0 .45rem;
        color: #151515;
    }
    .promo-notice-modal__text {
        color: #5b6168;
        font-size: .9rem;
        line-height: 1.5;
        margin: 0 0 1.15rem;
    }
    .promo-notice-modal__actions {
        display: flex;
        flex-wrap: wrap;
        gap: .55rem;
        justify-content: center;
    }
    .promo-notice-modal__btn {
        background: #ff4500;
        border: 0;
        border-radius: 6px;
        color: #fff;
        font-weight: 700;
        text-transform: uppercase;
        font-size: .78rem;
        letter-spacing: .03em;
        padding: .6rem 1.25rem;
        text-decoration: none;
    }
    .promo-notice-modal__btn:hover,
    .promo-notice-modal__btn:focus {
        background: #e03d00;
        color: #fff;
    }
    .promo-notice-modal__btn-outline {
        background: #fff;
        border: 1px solid #d8dde3;
        color: #1d2b41;
    }
    .promo-notice-modal__btn-outline:hover,
    .promo-notice-modal__btn-outline:focus {
        background: #f5f7f9;
        color: #1d2b41;
    }
</style>

<div
    class="modal fade promo-notice-modal"
    id="promoCouponNoticeModal"
    tabindex="-1"
    aria-labelledby="promoCouponNoticeTitle"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="promo-notice-modal__icon" aria-hidden="true">
                    <i class="fa fa-check"></i>
                </div>
                <h2 id="promoCouponNoticeTitle" class="promo-notice-modal__title">Desconto desbloqueado</h2>
                <p class="promo-notice-modal__text">{{ $promoCouponNotice }}</p>
                <div class="promo-notice-modal__actions">
                    <a href="{{ route('checkout.create') }}" class="promo-notice-modal__btn">Ir para o checkout</a>
                    <button type="button" class="promo-notice-modal__btn promo-notice-modal__btn-outline" data-bs-dismiss="modal">
                        Continuar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    (() => {
        const modalEl = document.getElementById('promoCouponNoticeModal');
        if (!modalEl || typeof bootstrap === 'undefined') {
            return;
        }

        const modal = new bootstrap.Modal(modalEl);
        const show = () => modal.show();

        if (document.readyState === 'complete') {
            setTimeout(show, 350);
        } else {
            window.addEventListener('load', () => setTimeout(show, 350));
        }
    })();
</script>
@endpush
@endif
