import './bootstrap';

function $(selector, root = document) {
    return root.querySelector(selector);
}

function $all(selector, root = document) {
    return Array.from(root.querySelectorAll(selector));
}

function openModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeModal(modal) {
    if (!modal) return;
    modal.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

function setupModals() {
    $all('[data-modal-open]').forEach((btn) => {
        btn.addEventListener('click', () => openModal(btn.getAttribute('data-modal-open')));
    });

    $all('[data-modal]').forEach((modal) => {
        $all('[data-modal-close]', modal).forEach((btn) => {
            btn.addEventListener('click', () => closeModal(modal));
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal(modal);
        });
    });

    document.addEventListener('keydown', (e) => {
        if (e.key !== 'Escape') return;
        const visible = $all('[data-modal]').find((m) => !m.classList.contains('hidden'));
        if (visible) closeModal(visible);
    });
}

function setupSidebar() {
    const sidebar = $('#appSidebar');
    const overlay = $('#appSidebarOverlay');
    const toggle = $('#appSidebarToggle');

    if (!sidebar || !toggle) return;

    function open() {
        sidebar.classList.remove('-translate-x-full');
        overlay?.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function close() {
        sidebar.classList.add('-translate-x-full');
        overlay?.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    toggle.addEventListener('click', () => {
        if (sidebar.classList.contains('-translate-x-full')) open();
        else close();
    });

    overlay?.addEventListener('click', close);

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            overlay?.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            sidebar.classList.remove('-translate-x-full');
        } else {
            sidebar.classList.add('-translate-x-full');
        }
    });
}

function setupCollapse() {
    $all('[data-collapse-toggle]').forEach((btn) => {
        const targetId = btn.getAttribute('data-collapse-toggle');
        const target = targetId ? document.getElementById(targetId) : null;
        if (!target) return;
        btn.addEventListener('click', () => {
            target.classList.toggle('hidden');
        });
    });
}

function setupNavbar() {
    const nav = document.getElementById('navbarNav');
    const toggler = document.querySelector('[data-bs-target="#navbarNav"]');
    if (!nav) return;
    function apply() {
        if (window.innerWidth >= 992) {
            nav.classList.add('show');
        } else {
            nav.classList.remove('show');
        }
    }
    apply();
    window.addEventListener('resize', apply);
    if (toggler) {
        toggler.addEventListener('click', () => {
            nav.classList.toggle('show');
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    setupModals();
    setupSidebar();
    setupCollapse();
    setupNavbar();
});
