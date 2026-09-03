var themeUrl = document.body.dataset.themeUrl;

function setThemeCookie(theme) {
    var expires = new Date();
    expires.setFullYear(expires.getFullYear() + 5);
    document.cookie = 'theme=' + theme + '; expires=' + expires.toUTCString() + '; path=/';
}

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

        document.documentElement.setAttribute('data-theme', appliquerSombre ? 'dark' : 'light');
        setThemeCookie(choix);

        if (themeUrl) {
            fetch(themeUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ theme: choix })
            })
            .catch(function () {
                showToast('Impossible d\'enregistrer le thème, veuillez réessayer.', 'error');
            });
        }
    });
});
