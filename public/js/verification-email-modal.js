var otpBoxes = Array.from(document.querySelectorAll('.otp-box'));
var otpRow = document.getElementById('otp-row');
var verifyResult = document.getElementById('verify-result');
var verifyIcon = document.getElementById('verify-icon');
var verifyMessage = document.getElementById('verify-message');
var actionBtn = document.getElementById('verify-action-btn');
var verifyModalEl = document.getElementById('verifyModal');
var verifyUrl = verifyModalEl.dataset.verifyUrl;


// Vérification du code avec Laravel
function verifierCode() {

    var code = otpBoxes.map (function (b){
        return b.value;
    }).join('');

    if (code.length !==6) {
        return;
    }

    otpBoxes.forEach(function (b) { b.disabled = true; });
    otpRow.classList.add('checking');

    fetch(verifyUrl, {
        method: 'POST',
        headers: {
            'Content-Type' : 'application/json',
            'Accept' : 'application/json',
            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body : JSON.stringify({
            code : code
        })
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
        otpRow.classList.remove('checking');

        if (data.success) {
            afficherResultat(true);

            actionBtn.dataset.redirect = data.redirect;
        } else {
            afficherResultat(false);
        }
    })
    .catch(function (error) {
        console.error('Erreur lors de la vérification : ', error);

        otpRow.classList.remove('checking');

        afficherResultat(false);
    });
}

// Afficher le résultat
function afficherResultat(correct) {
    verifyResult.hidden = false;
    verifyIcon.className = 'verify-icon ' + (correct ? 'success' : 'error');
    verifyIcon.innerHTML = '<i class="fa-solid ' + (correct ? 'fa-check' : 'fa-xmark') + '"></i>';
    verifyMessage.textContent = correct
        ? 'Adresse vérifiée avec succès !'
        : 'Code incorrect. Vérifie les chiffres et réessaie.';

    actionBtn.hidden = false;
    actionBtn.textContent = correct ? 'Continuer' : 'Réessayer';
    actionBtn.dataset.state = correct ? 'success' : 'error';
}

// Gestion des 06 cases
otpBoxes.forEach(function (box, i) {
    box.addEventListener('input', function () {
        box.value = box.value.replace(/[^0-9]/g, '').slice(0, 1);
        if (box.value && i < otpBoxes.length - 1) {
            otpBoxes[i + 1].focus();
        }
        if (box.value && i === otpBoxes.length - 1) {
            verifierCode();
        }
    });

    box.addEventListener('keydown', function (e) {
        if (e.key === 'Backspace' && !box.value && i > 0) {
            otpBoxes[i - 1].focus();
        }
    });

    box.addEventListener('paste', function (e) {
        e.preventDefault();
        var chiffres = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '').slice(0, 6).split('');
        chiffres.forEach(function (chiffre, idx) { if (otpBoxes[idx]) otpBoxes[idx].value = chiffre; });
        if (chiffres.length === 6) {
            verifierCode();
        } else if (chiffres.length) {
            otpBoxes[chiffres.length].focus();
        }
    });
});

//Bouton Continuer / Réessayer
actionBtn.addEventListener('click', function () {
    if (actionBtn.dataset.state === 'success') {
        window.location.href = actionBtn.dataset.redirect;
        return;
    }

    // Réessayer : on remet la boîte à zéro
    verifyResult.hidden = true;
    actionBtn.hidden = true;
    otpRow.classList.remove('checking');
    otpBoxes.forEach(function (b) { b.value = ''; b.disabled = false; });
    otpBoxes[0].focus();
});

document.getElementById('verifyModal').addEventListener('shown.bs.modal', function () {
    otpBoxes[0].focus();
});
