document.querySelectorAll('.btn-comment-toggle').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var card = btn.closest('.post-card');
      var section = card.querySelector('.comments-section');
      var isHidden = section.hasAttribute('hidden');

      if (isHidden) {
        section.removeAttribute('hidden');
        btn.setAttribute('aria-expanded', 'true');
        var input = section.querySelector('.comment-input');
        if (input) input.focus();
      } else {
        section.setAttribute('hidden', '');
        btn.setAttribute('aria-expanded', 'false');
      }
    });
  });

  // Publier un commentaire dans le fil (uniquement côté client, pour la démo)
  function publierCommentaire(card) {
    var input = card.querySelector('.comment-input');
    var texte = input.value.trim();
    if (texte === '') return;

    var liste = card.querySelector('.comments-list');
    var nouveauCommentaire = document.createElement('div');
    nouveauCommentaire.className = 'comment';
    nouveauCommentaire.innerHTML =
      '<img src="https://i.pravatar.cc/150?img=5" alt="Ta photo de profil" class="comment-avatar">' +
      '<div class="comment-bubble">' +
      '<span class="comment-name">Toi</span>' +
      '<p class="comment-text"></p>' +
      '</div>';
    nouveauCommentaire.querySelector('.comment-text').textContent = texte;
    liste.appendChild(nouveauCommentaire);

    var compteur = card.querySelector('.btn-comment-toggle .count');
    compteur.textContent = parseInt(compteur.textContent, 10) + 1;

    input.value = '';
    liste.scrollTop = liste.scrollHeight;
  }

  document.querySelectorAll('.comment-submit').forEach(function (btn) {
    btn.addEventListener('click', function () {
      publierCommentaire(btn.closest('.post-card'));
    });
  });

  document.querySelectorAll('.comment-input').forEach(function (input) {
    input.addEventListener('keydown', function (e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        publierCommentaire(input.closest('.post-card'));
      }
    });
  });

  // Bouton "suivre" sur la photo de profil
  document.querySelectorAll('.follow-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var card = btn.closest('.post-card');
      var nom = card.querySelector('.post-name').textContent;
      var icon = btn.querySelector('i');
      var estAbonne = icon.classList.contains('fa-check');

      if (estAbonne) return;

      icon.classList.remove('fa-plus');
      icon.classList.add('fa-check');
      btn.setAttribute('aria-label', 'Abonné à ' + nom);
      showToast('Vous suivez désormais ' + nom, 'success');
    });
  });
