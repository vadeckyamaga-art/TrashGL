<article class="post-card">
    <header class="post-header">
        <div class="avatar-wrap">
            <img src="https://i.pravatar.cc/150?img=12" alt="Photo de profil de Léa Kamdem" class="avatar">
            <button type="button" class="follow-btn" aria-label="Suivre Léa Kamdem">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>

        <div class="post-identity">
            <span class="post-name">Léa Kamdem</span>
            <span class="post-time">Il y a 2 h · Promo Info 2026</span>
        </div>

        <div class="post-menu-wrap">
            <button type="button" class="post-menu-btn" aria-haspopup="true" aria-expanded="false" aria-label="Plus d'option">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
            <ul class="post-menu-dropdown" hidden>
                <li><button type="button" class="post-menu-item" data-action="edit"><i class="fa-solid fa-pen"></i> Modifier</button></li>
                <li><button type="button" class="post-menu-item text-danger" data-action="delete"><i class="fa-solid fa-trash"></i> Supprimer</button></li>
                <li><button type="button" class="post-menu-item" data-action="send"><i class="fa-solid fa-paper-plane"></i> Envoyer</button></li>
                <li><button type="button" class="post-menu-item" data-action="copy-link"><i class="fa-solid fa-link"></i> Copier le lien</button></li>
                <li><button type="button" class="post-menu-item text-danger" data-action="report"><i class="fa-solid fa-flag"></i> Signaler</button></li>
            </ul>
        </div>
    </header>

    <div class="post-text-bg" style="background-image: linear-gradient(180deg, rgba(30,20,10,0.15), rgba(20,12,6,0.65)), url('https://picsum.photos/seed/amphi-revisions/700/420');">
        <p>Qui d'autre est encore à la BU un dimanche soir ? Courage à toute la promo pour les partiels 💪</p>
    </div>

    <footer class="post-actions">
        <button type="button" class="action-btn">
            <i class="fa-solid fa-heart"></i> J'aime <span class="count">38</span>
        </button>
        <button type="button" class="action-btn btn-comment-toggle" aria-expanded="false">
            <i class="fa-solid fa-comment"></i> Commenter <span class="count">9</span>
        </button>
        <button type="button" class="action-btn">
            <i class="fa-solid fa-share"></i> Partager
        </button>
    </footer>

    <div class="comments-section" hidden>
        <div class="comments-list">
            <div class="comment">
                <img src="https://i.pravatar.cc/150?img=21" alt="Photo de profil de Junior Abanda" class="comment-avatar">
                <div class="comment-bubble">
                    <span class="comment-name">Junior Abanda</span>
                    <p class="comment-text">Courage, on y est presque 💪</p>
                </div>
            </div>
        </div>
        <div class="comment-form">
            <img src="https://i.pravatar.cc/150?img=5" alt="Ta photo de profil" class="comment-avatar">
            <input type="text" class="comment-input" placeholder="Écris un commentaire...">
            <button type="button" class="comment-submit" aria-label="Publier le commentaire">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </div>
</article>

<script src="{{ asset('js/post-card.js') }}" defer></script>
