document.querySelectorAll('.toggle-password').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var input = document.getElementById(btn.getAttribute('data-target'));
      var icon = btn.querySelector('i');
      var isHidden = input.type === 'password';

      input.type = isHidden ? 'text' : 'password';
      icon.classList.toggle('fa-eye', !isHidden);
      icon.classList.toggle('fa-eye-slash', isHidden);
      btn.setAttribute('aria-label', isHidden ? 'Masquer le mot de passe' : 'Afficher le mot de passe');
    });
});
