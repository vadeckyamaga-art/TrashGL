var langForm = document.getElementById('langForm');
var localeSelect = langForm.querySelector('.lang-select');
var localeUrl = langForm.dataset.localeUrl;

localeSelect.addEventListener('change', function () {
    fetch(localeUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ locale: localeSelect.value })
    })
    .then(function (response) { return response.json(); })
    .then(function () { window.location.reload(); })
    .catch(function () { showToast('Impossible d\'enregistrer la langue, veuillez réessayer.', 'error'); });
});
