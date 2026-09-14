// Sidebar mobile drawer toggle (dashboard layout)
window.toggleSidebar = function () {
    const sidebar = document.getElementById('dashboard-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    sidebar?.classList.toggle('-translate-x-full');
    overlay?.classList.toggle('hidden');
};

// Debounced live search for katalog page
window.debounce = function (fn, delay = 400) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => fn(...args), delay);
    };
};
