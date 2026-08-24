@include('components.head')
    <title>TrashGL - Accueil</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <!-- Navigation principale : 4 onglets -->
    <nav class="top-nav">
        <div class="nav-inner">
            <a href="accueil.html" class="brand-logo">
                <span class="logo-mark"><i class="fa-solid fa-graduation-cap"></i></span>
                <span class="d-none d-sm-inline">Amphi</span>
            </a>

            <div class="nav-tabs">
                <a href="accueil.html" class="nav-tab active">
                    <i class="fa-solid fa-house"></i>
                    <span>Accueil</span>
                </a>
                <a href="notifications.html" class="nav-tab">
                    <i class="fa-solid fa-bell"></i>
                    <span class="nav-badge">3</span>
                    <span>Notifications</span>
                </a>
                <a href="messages.html" class="nav-tab">
                    <i class="fa-solid fa-comment-dots"></i>
                    <span>Messages</span>
                </a>
                <a href="profil.html" class="nav-tab">
                    <i class="fa-solid fa-user"></i>
                    <span>Profil</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Fil de publications -->
    <main class="feed">

        <div class="ad-banner" id="ad-banner">
            <button type="button" class="ad-close" aria-label="Fermer la publicité">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <span class="ad-label">Publicité</span>
            <div class="ad-content">
                <img src="https://picsum.photos/seed/amphi-librairie/160/160" alt="" class="ad-image">
                <div class="ad-text">
                    <h3>Pack rentrée à -20% — Librairie du Campus</h3>
                    <p>Manuels, fournitures et goodies Amphi, jusqu'au 30 septembre.</p>
                    <a href="#" class="ad-cta">En savoir plus <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Raccourci de publication -->
        <button type="button" class="quick-post" data-bs-toggle="modal" data-bs-target="#quickPostModal">
            <img src="https://i.pravatar.cc/150?img=5" alt="Ta photo de profil" class="avatar">
            <span class="quick-post-placeholder">Quoi de neuf, David ?</span>
            <span class="quick-post-icon"><i class="fa-solid fa-image"></i></span>
        </button>

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

        <article class="post-card">
            <header class="post-header">
            <div class="avatar-wrap">
                <img src="https://i.pravatar.cc/150?img=33" alt="Photo de profil de Yannick Fotso" class="avatar">
                <button type="button" class="follow-btn" aria-label="Suivre Yannick Fotso">
                <i class="fa-solid fa-plus"></i>
                </button>
            </div>
            <div class="post-identity">
                <span class="post-name">Yannick Fotso</span>
                <span class="post-time">Il y a 5 h · Promo Info 2026</span>
            </div>
            </header>

            <div class="post-text-bg" style="background-image: linear-gradient(180deg, rgba(30,20,10,0.1), rgba(20,12,6,0.7)), url('https://picsum.photos/seed/amphi-soiree/700/420');">
            <p>Soirée d'intégration ce vendredi à l'amphi C ! Qui vient avec moi 🎉</p>
            </div>

            <footer class="post-actions">
            <button type="button" class="action-btn">
                <i class="fa-solid fa-heart"></i> J'aime <span class="count">102</span>
            </button>
            <button type="button" class="action-btn btn-comment-toggle" aria-expanded="false">
                <i class="fa-solid fa-comment"></i> Commenter <span class="count">27</span>
            </button>
            <button type="button" class="action-btn">
                <i class="fa-solid fa-share"></i> Partager
            </button>
            </footer>

            <div class="comments-section" hidden>
            <div class="comments-list">
                <div class="comment">
                <img src="https://i.pravatar.cc/150?img=44" alt="Photo de profil de Carine Ngo" class="comment-avatar">
                <div class="comment-bubble">
                    <span class="comment-name">Carine Ngo</span>
                    <p class="comment-text">Je viens avec grand plaisir ! 🎉</p>
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

        <article class="post-card">
            <header class="post-header">
            <div class="avatar-wrap">
                <img src="https://i.pravatar.cc/150?img=47" alt="Photo de profil de Sandrine Mbida" class="avatar">
                <button type="button" class="follow-btn" aria-label="Suivre Sandrine Mbida">
                <i class="fa-solid fa-plus"></i>
                </button>
            </div>
            <div class="post-identity">
                <span class="post-name">Sandrine Mbida</span>
                <span class="post-time">Hier · Promo Info 2026</span>
            </div>
            </header>

            <div class="post-text-bg" style="background-image: linear-gradient(180deg, rgba(30,20,10,0.15), rgba(20,12,6,0.65)), url('https://picsum.photos/seed/amphi-notes/700/420');">
            <p>Merci à ceux qui ont partagé leurs notes de la semaine dernière, vous êtes des légendes 🙏</p>
            </div>

            <footer class="post-actions">
            <button type="button" class="action-btn">
                <i class="fa-solid fa-heart"></i> J'aime <span class="count">64</span>
            </button>
            <button type="button" class="action-btn btn-comment-toggle" aria-expanded="false">
                <i class="fa-solid fa-comment"></i> Commenter <span class="count">14</span>
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
                    <p class="comment-text">Merci à toi aussi pour le résumé de compta 🙌</p>
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
    </main>

    <script src="{{ asset('js/Home.js') }}" defer></script>
    <script src="{{ asset('js/messagesBox.js') }}" defer></script>
</body>
</html>
