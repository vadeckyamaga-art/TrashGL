document.querySelectorAll('.theme-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.theme-btn').forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');

        var choix = btn.dataset.theme;
        var appliquerSombre = false;

        if (choix === 'dark') {
            appliquerSombre = true;
        } else if (choix === 'system') {
            appliquerSombre = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        }

        document.documentElement.setAttribute('data-theme', appliquerSombre ? 'dark' : 'ligth');
    });
});

document.querySelectorAll('.theme-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.theme-btn').forEach(function (item) {
            item.classList.remove('active');
            btn.classList.add('active');
        });
    });
});

