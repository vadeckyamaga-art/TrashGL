var profilForm = document.getElementById('profilForm');
var emailInput = document.getElementById('param-email');
var emailUrl = profilForm.dataset.emailUrl

profilForm.addEventListener('submit', function (e) {
    var newEmail = emailInput.value.trim();
    var originalEmail = emailInput.dataset.originalEmail;

    if (newEmail === originalEmail) {
        return; // email inchangé: soumission classique, gère juste le nom
    }

    e.preventDefault();

    var submitBtn = profilForm.querySelector('button[type="submit"]');
    var defaultText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Envoi en cours...';

    fetch(emailUrl, {
        method : 'POST',

        headers: {
            'Accept' : 'application/json',

            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },

        body : JSON.stringify({email : newEmail})
    })
    .then(async function (response) {
        const data = await response.json();

        // console.log('Status HTTP: ', response.status);
        // console.log('Réponse Laravel : ', data);

        if (!data.success) {
            throw data;
        }

        return data;
    })
    .then(function () {
        ouvrirModalVerification();
    })
    .catch(function (error) {

        if (error.errors) {
            var firstMessage = Object.values(error.errors)[0][0];
            showToast(firstMessage, 'error');

        } else if (error.message) {
            showToast(error.message, 'error');

        } else {
            showToast('Une erreur est survenue, veuillez réessayer!', 'error');
        }

    })
    .finally(function () {
        submitBtn.disabled = false;
        submitBtn.innerHTML = defaultText;
    });
});
