<div id="adminDeleteModal" class="admin-delete-modal" role="dialog" aria-modal="true" aria-labelledby="adminDeleteModalTitle" hidden>
    <div class="admin-delete-modal__overlay" data-delete-cancel tabindex="-1"></div>
    <div class="admin-delete-modal__dialog">
        <div class="admin-delete-modal__icon" aria-hidden="true">
            <i class="bi bi-exclamation-triangle"></i>
        </div>
        <h2 id="adminDeleteModalTitle" class="admin-delete-modal__title" data-delete-title>Confirmar exclusão</h2>
        <p class="admin-delete-modal__message" data-delete-message>Tem certeza que deseja excluir este item?</p>
        <div class="admin-delete-modal__item-wrap" data-delete-item-wrap hidden>
            <span class="admin-delete-modal__item-label">Item selecionado</span>
            <span class="admin-delete-modal__item" data-delete-item></span>
        </div>
        <p class="admin-delete-modal__warning">
            <i class="bi bi-info-circle"></i>
            Esta ação é irreversível e não pode ser desfeita.
        </p>
        <div class="admin-delete-modal__actions">
            <button type="button" class="btn btn-outline-secondary" data-delete-cancel>
                <i class="bi bi-x-lg"></i> Cancelar
            </button>
            <button type="button" class="btn btn-danger" data-delete-confirm>
                <i class="bi bi-trash"></i> Sim, excluir
            </button>
        </div>
    </div>
</div>
