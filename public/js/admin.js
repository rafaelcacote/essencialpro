(function () {
    const modal = document.getElementById('adminDeleteModal');
    if (!modal) {
        return;
    }

    let pendingForm = null;

    const titleEl = modal.querySelector('[data-delete-title]');
    const messageEl = modal.querySelector('[data-delete-message]');
    const itemEl = modal.querySelector('[data-delete-item]');
    const itemWrap = modal.querySelector('[data-delete-item-wrap]');
    const confirmBtn = modal.querySelector('[data-delete-confirm]');
    const cancelEls = modal.querySelectorAll('[data-delete-cancel]');

    function openModal(form) {
        pendingForm = form;
        titleEl.textContent = form.dataset.confirmTitle || 'Confirmar exclusão';
        messageEl.textContent = form.dataset.confirmMessage || 'Tem certeza que deseja excluir este item?';

        const item = form.dataset.confirmItem;
        if (item) {
            itemEl.textContent = item;
            itemWrap.hidden = false;
        } else {
            itemWrap.hidden = true;
        }

        modal.hidden = false;
        modal.classList.add('is-open');
        document.body.classList.add('admin-modal-open');
        confirmBtn.focus();
    }

    function closeModal() {
        modal.classList.remove('is-open');
        modal.hidden = true;
        document.body.classList.remove('admin-modal-open');
        pendingForm = null;
    }

    document.addEventListener('submit', function (event) {
        const form = event.target.closest('.admin-delete-form');
        if (!form) {
            return;
        }

        if (form.dataset.confirmed === 'true') {
            return;
        }

        event.preventDefault();
        openModal(form);
    });

    confirmBtn.addEventListener('click', function () {
        if (pendingForm) {
            pendingForm.dataset.confirmed = 'true';
            pendingForm.submit();
        }
        closeModal();
    });

    cancelEls.forEach(function (el) {
        el.addEventListener('click', closeModal);
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.classList.contains('is-open')) {
            closeModal();
        }
    });
})();
