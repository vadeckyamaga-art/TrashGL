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
publishBtn.addEventListener('click', function () {
    var texte = postText.value.trim();
    if (texte === '') { postText.focus(); return; }

    if (composer.editingId) {
        var carte = myPosts.querySelector('[data-post-id="' + composer.editingId + '"]');
        carte.dataset.bgType = composer.type;
        carte.dataset.bgValue = composer.value;
        var fondDiv = carte.querySelector('.my-post-bg');
        fondDiv.style.backgroundImage = fondPourCarte(composer.type, composer.value);
        fondDiv.style.backgroundColor = composer.type === 'image' ? '' : composer.value;
        fondDiv.querySelector('p').textContent = texte;
        carte.querySelector('.my-post-time').textContent = 'Modifié à l\'instant';
        showToast('Publication modifiée.', 'success');
    } else {
        var id = 'p' + Date.now();
        var article = document.createElement('article');
        article.className = 'my-post-card';
        article.dataset.postId = id;
        article.dataset.bgType = composer.type;
        article.dataset.bgValue = composer.value;

        article.innerHTML =
        '<div class="my-post-bg" style="background-image:' + fondPourCarte(composer.type, composer.value) + ';' + styleCouleurCarte(composer.type, composer.value) + '">' +
        '<p></p></div>' +
        '<div class="my-post-meta">' +
        '<span class="my-post-time">À l\'instant · 0 j\'aime · 0 commentaire</span>' +
        '<div class="my-post-tools">' +
        '<button type="button" class="tool-btn edit-post" aria-label="Modifier la publication"><i class="fa-solid fa-pen"></i></button>' +
        '<button type="button" class="tool-btn delete-post" aria-label="Supprimer la publication"><i class="fa-solid fa-trash"></i></button>' +
        '</div></div>';

        article.querySelector('.my-post-bg p').textContent = texte;
        myPosts.insertBefore(article, myPosts.firstChild);
        attacherOutilsCarte(article);
        showToast('Publication créée.', 'success');
    }

    reinitialiserComposeur();
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
    carte.querySelector('.edit-post').addEventListener('click', function () {
        var texte = carte.querySelector('.my-post-bg p').textContent;
        postText.value = texte;
        previewText.textContent = texte;

        composer.type = carte.dataset.bgType;
        composer.value = carte.dataset.bgValue;
        composer.editingId = carte.dataset.postId;

        appliquerFondAperçu();
        publishBtn.textContent = 'Enregistrer les modifications';
        cancelBtn.removeAttribute('hidden');

        document.querySelector('.post-composer').scrollIntoView({ behavior: 'smooth', block: 'start' });
    });

    carte.querySelector('.delete-post').addEventListener('click', function () {
        if (confirm('Supprimer définitivement cette publication ?')) {
        carte.remove();
        showToast('Publication supprimée.', 'success');
        }
    });
}

document.querySelectorAll('.my-post-card').forEach(attacherOutilsCarte);


