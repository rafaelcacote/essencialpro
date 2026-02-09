/**
 * Nav Tree - Menu em cascata (hover: submenu abre ao lado)
 */
(function () {
    'use strict';

    var nav = document.querySelector('.nav-essencial');
    if (!nav) return;

    var triggers = nav.querySelectorAll('[data-nav-tree-trigger]');
    var isDesktop = function () { return window.innerWidth >= 992; };
    var hoverDelay = 120;

    function closeAllPanels() {
        triggers.forEach(function (t) {
            t.setAttribute('data-open', 'false');
            var p = t.querySelector('[data-nav-tree-panel]');
            if (p) p.setAttribute('aria-hidden', 'true');
        });
    }

    function closeAllTreeItems(container) {
        if (!container) return;
        container.querySelectorAll('.nav-tree__item--has-children').forEach(function (el) {
            el.classList.remove('nav-tree__item--open');
        });
    }

    function openPanel(trigger) {
        closeAllPanels();
        trigger.setAttribute('data-open', 'true');
        var panel = trigger.querySelector('[data-nav-tree-panel]');
        if (panel) panel.setAttribute('aria-hidden', 'false');
    }

    // ---- Desktop: hover no trigger do navbar ----
    triggers.forEach(function (trigger) {
        var panel = trigger.querySelector('[data-nav-tree-panel]');
        if (!panel) return;

        trigger.addEventListener('mouseenter', function () {
            if (isDesktop()) openPanel(trigger);
        });

        trigger.addEventListener('mouseleave', function (e) {
            if (!isDesktop()) return;
            var related = e.relatedTarget;
            if (related && (trigger.contains(related) || panel.contains(related))) return;
            trigger.setAttribute('data-open', 'false');
            panel.setAttribute('aria-hidden', 'true');
            closeAllTreeItems(panel);
        });
    });

    // ---- Desktop: hover nos itens com filhos (abrir submenu ao lado, com delay para não fechar ao passar) ----
    function bindTreeItems() {
        var items = nav.querySelectorAll('.nav-tree__item--has-children');
        items.forEach(function (item) {
            var sub = item.querySelector(':scope > .nav-tree__list');
            if (!sub) return;

            var closeTimer = null;

            function openSub() {
                if (closeTimer) {
                    clearTimeout(closeTimer);
                    closeTimer = null;
                }
                // Fechar irmãos no mesmo nível (só um submenu aberto por vez)
                var parentList = item.parentElement;
                if (parentList) {
                    parentList.querySelectorAll(':scope > .nav-tree__item--has-children').forEach(function (sib) {
                        if (sib !== item) sib.classList.remove('nav-tree__item--open');
                    });
                }
                item.classList.add('nav-tree__item--open');
            }

            function closeSub() {
                closeTimer = setTimeout(function () {
                    item.classList.remove('nav-tree__item--open');
                    closeTimer = null;
                }, hoverDelay);
            }

            function cancelClose() {
                if (closeTimer) {
                    clearTimeout(closeTimer);
                    closeTimer = null;
                }
            }

            item.addEventListener('mouseenter', function () {
                if (!isDesktop()) return;
                openSub();
            });

            item.addEventListener('mouseleave', function (e) {
                if (!isDesktop()) return;
                var related = e.relatedTarget;
                if (related && (item.contains(related) || sub.contains(related))) return;
                closeSub();
            });

            sub.addEventListener('mouseenter', function () {
                if (!isDesktop()) return;
                cancelClose();
                item.classList.add('nav-tree__item--open');
            });
        });
    }

    bindTreeItems();

    // Fechar tudo ao sair do nav
    nav.addEventListener('mouseleave', function (e) {
        if (!isDesktop()) return;
        var related = e.relatedTarget;
        if (related && nav.contains(related)) return;
        closeAllPanels();
        nav.querySelectorAll('[data-nav-tree-panel]').forEach(function (p) {
            closeAllTreeItems(p);
        });
    });

    // ---- Mobile: clique no trigger e accordion ----
    nav.addEventListener('click', function (e) {
        var trigger = e.target.closest('[data-nav-tree-trigger]');
        if (trigger && isDesktop()) return;

        if (trigger) {
            e.preventDefault();
            var open = trigger.getAttribute('data-open') === 'true';
            closeAllPanels();
            if (!open) {
                trigger.setAttribute('data-open', 'true');
                var p = trigger.querySelector('[data-nav-tree-panel]');
                if (p) p.setAttribute('aria-hidden', 'false');
            }
            return;
        }

        var item = e.target.closest('.nav-tree__item--has-children');
        if (item && !isDesktop()) {
            var link = item.querySelector('.nav-tree__link');
            if (link && e.target.closest('a') === link) {
                e.preventDefault();
                item.classList.toggle('nav-tree__item--open');
            }
        }
    });

    window.addEventListener('resize', function () {
        if (isDesktop()) {
            closeAllPanels();
            nav.querySelectorAll('[data-nav-tree-panel]').forEach(function (p) {
                closeAllTreeItems(p);
            });
        }
    });
})();
