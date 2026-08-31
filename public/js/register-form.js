var registerForm = document.getElementById('registerForm');
var submitBtn = registerForm.querySelector('button[type="submit"]');
var submitBtnDefault = submitBtn.innerHTML;

registerForm.addEventListener('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(registerForm);

    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Envoi en cours...';

    fetch(registerForm.action, {
        method : 'POST',

        headers: {
            'Accept' : 'application/json',

            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },

        body : formData
    })
    .then(async function (response) {
        const data = await response.json();

        console.log('Status HTTP: ', response.status);
        console.log('Réponse Laravel : ', data);

        if (!data.success) {
            throw data;
        }

        return data;
    })
    .then(function (data) {
        console.log('Inscription réussie: ', data);
        ouvrirModalVerification();
    })
    .catch(function (error) {
        console.error ('Erreur Laravel : ', error);

        if (error.errors) {
            console.table(error.errors);

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
        submitBtn.innerHTML = submitBtnDefault;
    });
});

function ouvrirModalVerification() {
    var modalElement = document.getElementById('verifyModal');
    var modal = bootstrap.Modal.getOrCreateInstance(modalElement);
    modal.show();
}
