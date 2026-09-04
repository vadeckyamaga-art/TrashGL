/* ---------- Sous-onglets Publications / Paramètres ---------- */
document.querySelectorAll('.subtab').forEach(function (tab) {
    tab.addEventListener('click', function () {
        document.querySelectorAll('.subtab').forEach(function (t) { t.classList.remove('active'); });
        document.querySelectorAll('.subpanel').forEach(function (p) { p.classList.remove('active'); });
        tab.classList.add('active');
        document.getElementById(tab.dataset.target).classList.add('active');
    });
});

/* ---------- Apparence (clair / sombre / par défaut) ---------- */
document.querySelectorAll('.theme-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.theme-btn').forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');

        var choix = btn.dataset.theme;
        var appliquerSombre = false;

        if (choix === 'sombre') {
        appliquerSombre = true;
        } else if (choix === 'systeme') {
        appliquerSombre = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        }

        document.documentElement.setAttribute('data-theme', appliquerSombre ? 'sombre' : 'clair');
    });
});

/* ---------- Composeur de publication ---------- */
var composer = {
    type: 'couleur',
    value: '#FF6A1A',
    editingId: null
};

var preview = document.getElementById('composer-preview');
var previewText = document.getElementById('preview-text');
var postText = document.getElementById('post-text');
var publishBtn = document.getElementById('publish-btn');
var cancelBtn = document.getElementById('cancel-edit');
var myPosts = document.getElementById('my-posts');
var postUrl = document.querySelector('.post-composer form').dataset.postUrl;

function appliquerFondAperçu() {
    if (composer.type === 'image') {
        preview.style.background =
        'linear-gradient(180deg, rgba(30,20,10,0.15), rgba(20,12,6,0.65)), center/cover no-repeat url("' + composer.value + '")';
    } else {
        preview.style.background = composer.value;
    }
}

postText.addEventListener('input', function () {
    previewText.textContent = postText.value || 'Exprime-toi devant toute la promo...';
});

// Choix du type de fond (couleur / dégradé / image)
document.querySelectorAll('.bg-type-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.bg-type-btn').forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');

        document.querySelectorAll('.bg-picker').forEach(function (p) { p.setAttribute('hidden', ''); });
        document.getElementById('picker-' + btn.dataset.type).removeAttribute('hidden');
    });
});

// Choix d'une couleur, d'un dégradé ou d'une image dans les pickers
document.querySelectorAll('.bg-picker .swatch, .bg-picker .gallery-thumb').forEach(function (option) {
    option.addEventListener('click', function () {
        var picker = option.closest('.bg-picker');
        picker.querySelectorAll('.swatch, .gallery-thumb').forEach(function (o) { o.classList.remove('selected'); });
        option.classList.add('selected');

        composer.type = option.dataset.bgType;
        composer.value = option.dataset.bgValue;
        composer.imageId = option.dataset.bgImageId || null;
        appliquerFondAperçu();
    });
});

// Couleur personnalisée
document.getElementById('custom-color').addEventListener('input', function (e) {
    document.querySelectorAll('#picker-couleur .swatch, #picker-couleur .custom-swatch').forEach(function (o) {
        o.classList.remove('selected');
    });
    document.querySelector('.custom-swatch').classList.add('selected');

    composer.type = 'couleur';
    composer.value = e.target.value;
    appliquerFondAperçu();
});

function fondPourCarte(type, value) {
    if (type === 'image') {
        return 'linear-gradient(180deg, rgba(30,20,10,0.15), rgba(20,12,6,0.65)), url(\'' + value + '\')';
    }
    return 'none';
}

function styleCouleurCarte(type, value) {
    return type === 'image' ? '' : ('background-color:' + value + ';');
}

// Publier ou enregistrer une modification
var postBaseUrl = document.querySelector('.post-composer form').dataset.postBaseUrl;
publishBtn.addEventListener('click', function () {
    var texte = postText.value.trim();
    if (texte === '') { postText.focus(); return; }

    var payload = {
        content: texte,
        background_type: composer.type,
        background_value: composer.type === 'image' ? null : composer.value,
        background_image_id: composer.type === 'image' ? composer.imageId : null
    };

    publishBtn.disabled = true;

    var url = composer.editingId ? (postBaseUrl + '/' + composer.editingId) : postUrl;
    var method = composer.editingId ? 'PATCH' : 'POST';

    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(payload)
    })
    .then(function (response) { return response.json(); })
    .then(function (data) {
        if (!data.success) { throw data; }

        if (composer.editingId) {
            var ancienneCarte = myPosts.querySelector('[data-post-uuid="' + composer.editingId + '"]');
            ancienneCarte.outerHTML = data.html;
            var carteMiseAJour = myPosts.querySelector('[data-post-uuid="' + composer.editingId + '"]');
            attacherOutilsCarte(carteMiseAJour);
            showToast('Publication modifiée.', 'success');
        } else {
            myPosts.insertAdjacentHTML('afterbegin', data.html);
            var nouvelleCarte = myPosts.querySelector('article');
            attacherOutilsCarte(nouvelleCarte);
            showToast('Publication créée.', 'success');
        }

        reinitialiserComposeur();
    })
    .catch(function () {
        showToast('Une erreur est survenue, veuillez réessayer.', 'error');
    })
    .finally(function () {
        publishBtn.disabled = false;
    });
});

function reinitialiserComposeur() {
    postText.value = '';
    previewText.textContent = 'Exprime-toi devant toute la promo...';
    composer.editingId = null;
    publishBtn.textContent = 'Publier';
    cancelBtn.setAttribute('hidden', '');
}

cancelBtn.addEventListener('click', reinitialiserComposeur);

// Modifier / supprimer une publication existante
function attacherOutilsCarte(carte) {
    var editBtn = carte.querySelector('[data-action="edit"]');
    var deleteBtn = carte.querySelector('[data-action="delete"]');

    if (!editBtn || !deleteBtn) return; // carte d'un autre utilisateur, pas d'outils d'édition

    editBtn.addEventListener('click', function () {
        var texte = carte.querySelector('.post-text-bg p').textContent;
        postText.value = texte;
        previewText.textContent = texte;

        composer.type = carte.dataset.bgType;
        composer.value = carte.dataset.bgValue;
        composer.editingId = carte.dataset.postUuid;

        appliquerFondAperçu();
        publishBtn.textContent = 'Enregistrer les modifications';
        cancelBtn.removeAttribute('hidden');

        document.querySelector('.post-composer').scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    deleteBtn.addEventListener('click', function () {
        if (!confirm('Supprimer définitivement cette publication ?')) {
            return;
        }

        var uuid = carte.dataset.postUuid;

        fetch(postBaseUrl + '/' + uuid, {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(function (response) { return response.json(); })
        .then(function (data) {
            if (!data.success) { throw data; }
            carte.remove();
            showToast('Publication supprimée.', 'success');
        })
        .catch(function () {
            showToast('Impossible de supprimer, veuillez réessayer.', 'error');
        });
    });
}

document.querySelectorAll('.my-post-card').forEach(attacherOutilsCarte);
