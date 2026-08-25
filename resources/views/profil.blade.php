@include('components.head')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/amphi-post.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>TrashGl - Profil</title>
</head>
<body>

    <!-- Navigation principale : 4 onglets -->
    <nav class="top-nav">
        <div class="nav-inner">
            <a href="{{ route('welcome') }}" class="brand-logo">
                <span class="logo-mark"><i class="fa-solid fa-graduation-cap"></i></span>
                <span class="d-none d-sm-inline">Amphi</span>
            </a>

            <div class="nav-tabs">
                <a href="{{ route('welcome') }}" class="nav-tab">
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
                <a href="{{ route('profil.edit') }}" class="nav-tab active">
                    <i class="fa-solid fa-user"></i>
                    <span>Profil</span>
                </a>
            </div>
        </div>
    </nav>

    <main class="profile-page">
        <!-- En-tête profil -->
        <section class="profile-header">
            <img src="https://i.pravatar.cc/150?img=5" alt="Ta photo de profil" class="profile-avatar">
            <div class="profile-identity">
                <h1>Nathan Belinga</h1>
                <p class="profile-sub">Promo Info 2026</p>
                <div class="profile-stats">
                    <span><strong>12</strong> publications</span>
                    <span><strong>184</strong> abonnés</span>
                    <span><strong>96</strong> abonnements</span>
                </div>
            </div>
        </section>

        <!-- Sous-onglets -->
        <div class="subtabs">
            <button type="button" class="subtab active" data-target="panel-post">
                <i class="fa-solid fa-image"></i> Publications
            </button>

            <button type="button" class="subtab" data-target="panel-parametres">
                <i class="fa-solid fa-gear"></i> Paramètres
            </button>
        </div>

        <!-- ============ Sous-onglet : Publications ============ -->
        <section id="panel-post" class="subpanel active">
            <div class="post-composer">

                <h2>Créer une publication</h2>
                <textarea id="post-text" class="composer-textarea" maxlength="240" placeholder="Exprime-toi devant toute la promo..."></textarea>
                <div class="bg-type-selector">
                    <button type="button" class="bg-type-btn active" data-type="couleur">
                        <i class="fa-solid fa-fill-drip"></i> Couleur
                    </button>

                    <button type="button" class="bg-type-btn" data-type="degrade">
                        <i class="fa-solid fa-layer-group"></i> Dégradé
                    </button>

                    <button type="button" class="bg-type-btn" data-type="image">
                        <i class="fa-solid fa-image"></i> Image
                    </button>
                </div>

                <div class="bg-picker" id="picker-couleur">
                    <button type="button" class="swatch selected" style="background:#FF6A1A" data-bg-type="couleur" data-bg-value="#FF6A1A" aria-label="Orange"></button>
                    <button type="button" class="swatch" style="background:#1F6F5C" data-bg-type="couleur" data-bg-value="#1F6F5C" aria-label="Vert sapin"></button>
                    <button type="button" class="swatch" style="background:#1B3B6F" data-bg-type="couleur" data-bg-value="#1B3B6F" aria-label="Bleu marine"></button>
                    <button type="button" class="swatch" style="background:#6B3FA0" data-bg-type="couleur" data-bg-value="#6B3FA0" aria-label="Violet"></button>
                    <button type="button" class="swatch" style="background:#D94F70" data-bg-type="couleur" data-bg-value="#D94F70" aria-label="Rose"></button>
                    <button type="button" class="swatch" style="background:#2B2420" data-bg-type="couleur" data-bg-value="#2B2420" aria-label="Charbon"></button>
                    <label class="swatch custom-swatch" aria-label="Couleur personnalisée">
                        <input type="color" id="custom-color" value="#FF6A1A">
                        <i class="fa-solid fa-eye-dropper"></i>
                    </label>
                </div>

                <div class="bg-picker" id="picker-degrade" hidden>
                    <button type="button" class="swatch" style="background:linear-gradient(135deg,#FF6A1A,#B93F00)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#FF6A1A,#B93F00)" aria-label="Dégradé orange"></button>
                    <button type="button" class="swatch" style="background:linear-gradient(135deg,#6B3FA0,#2B1655)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#6B3FA0,#2B1655)" aria-label="Dégradé violet"></button>
                    <button type="button" class="swatch" style="background:linear-gradient(135deg,#1F6F5C,#0B2E27)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#1F6F5C,#0B2E27)" aria-label="Dégradé vert"></button>
                    <button type="button" class="swatch" style="background:linear-gradient(135deg,#1B3B6F,#0A1B33)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#1B3B6F,#0A1B33)" aria-label="Dégradé bleu"></button>
                    <button type="button" class="swatch" style="background:linear-gradient(135deg,#D94F70,#7A1F3D)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#D94F70,#7A1F3D)" aria-label="Dégradé rose"></button>
                    <button type="button" class="swatch" style="background:linear-gradient(135deg,#4A4A4A,#111111)" data-bg-type="degrade" data-bg-value="linear-gradient(135deg,#4A4A4A,#111111)" aria-label="Dégradé charbon"></button>
                </div>

                <div class="bg-picker gallery" id="picker-image" hidden>
                    <button type="button" class="gallery-thumb" style="background-image:url('https://picsum.photos/seed/amphi-g1/200/200')" data-bg-type="image" data-bg-value="https://picsum.photos/seed/amphi-g1/700/420" aria-label="Image 1"></button>
                    <button type="button" class="gallery-thumb" style="background-image:url('https://picsum.photos/seed/amphi-g2/200/200')" data-bg-type="image" data-bg-value="https://picsum.photos/seed/amphi-g2/700/420" aria-label="Image 2"></button>
                    <button type="button" class="gallery-thumb" style="background-image:url('https://picsum.photos/seed/amphi-g3/200/200')" data-bg-type="image" data-bg-value="https://picsum.photos/seed/amphi-g3/700/420" aria-label="Image 3"></button>
                    <button type="button" class="gallery-thumb" style="background-image:url('https://picsum.photos/seed/amphi-g4/200/200')" data-bg-type="image" data-bg-value="https://picsum.photos/seed/amphi-g4/700/420" aria-label="Image 4"></button>
                    <button type="button" class="gallery-thumb" style="background-image:url('https://picsum.photos/seed/amphi-g5/200/200')" data-bg-type="image" data-bg-value="https://picsum.photos/seed/amphi-g5/700/420" aria-label="Image 5"></button>
                    <button type="button" class="gallery-thumb" style="background-image:url('https://picsum.photos/seed/amphi-g6/200/200')" data-bg-type="image" data-bg-value="https://picsum.photos/seed/amphi-g6/700/420" aria-label="Image 6"></button>
                </div>

                <p class="composer-label">Aperçu</p>
                <div class="composer-preview" id="composer-preview" style="background:#FF6A1A">
                    <p id="preview-text">Exprime-toi devant toute la promo...</p>
                </div>

                <div class="composer-actions">
                    <button type="button" id="cancel-edit" class="btn-cancel-edit" hidden>Annuler</button>
                    <button type="button" id="publish-btn" class="btn btn-connect">Publier</button>
                </div>
            </div>

            <h2 class="section-title">Mes publications</h2>

            <div class="my-posts" id="my-posts">

                @include('components.post-card')

            </div>
        </section>

        <!-- ============ Sous-onglet : Paramètres ============ -->
        <section id="panel-parametres" class="subpanel">

            <div class="settings-card">
                <h2>Informations personnelles</h2>
                <form action="{{ route('profil.update') }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="form-floating input-icon-group">
                                <input type="text" class="form-control" name="name" id="param-nom" value="{{ old('name', $user->name) }}">
                                <label for="param-nom"><i class="fa-solid fa-user"></i> Nom Ou Prénom</label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-floating input-icon-group">
                                <input type="email" class="form-control" name="email" id="param-email"
                                value="{{ old('name', $user->email) }}"
                                @if ($user->provider === 'Google') readonly @endif>
                                @if ($user->provider === 'Google')
                                    <p class="text-sm text-gray-500 mt-1"><i class="fa-circle-exclamation"></i> Cet adresse e-mail est gérée par ton compte Google et ne peut etre modidié içi!</p>
                                @endif
                                <label for="param-email"><i class="fa-solid fa-envelope"></i> Adresse e-mail</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-connect settings-save">Enregistrer les modifications</button>
                </form>
            </div>

            <div class="settings-card">
                <h2>Changer le mot de passe</h2>

                <form action="" method="POST">
                    @csrf
                    <div class="form-floating input-icon-group password-group mb-3">
                        <input type="password" class="form-control" id="mdp-actuel" name="password" placeholder="***********">
                        <label for="mdp-actuel"><i class="fa-solid fa-lock"></i> Mot de passe actuel</label>
                        <button type="button" class="toggle-password" data-target="mdp-actuel" aria-label="Afficher le mot de passe"><i class="fa-solid fa-eye"></i></button>
                    </div>

                    <div class="form-floating input-icon-group password-group mb-3">
                        <input type="password" class="form-control" id="mdp-nouveau" name="new_password" placeholder="***********">
                        <label for="mdp-nouveau"><i class="fa-solid fa-lock"></i> Nouveau mot de passe</label>
                        <button type="button" class="toggle-password" data-target="mdp-nouveau" aria-label="Afficher le mot de passe"><i class="fa-solid fa-eye"></i></button>
                    </div>

                    <div class="form-floating input-icon-group password-group mb-3">
                        <input type="password" class="form-control" id="mdp-confirmer" name="password_confirmation" placeholder="***********">
                        <label for="mdp-confirmer"><i class="fa-solid fa-lock"></i> Confirmer le nouveau mot de passe</label>
                        <button type="button" class="toggle-password" data-target="mdp-confirmer" aria-label="Afficher le mot de passe"><i class="fa-solid fa-eye"></i></button>
                    </div>

                    <button type="button" class="btn btn-connect settings-save">Mettre à jour le mot de passe</button>
                </form>
            </div>

            <div class="settings-card">
                <h2>Langue</h2>
                <select class="form-select lang-select">
                    <option selected>Français</option>
                    <option>English</option>
                </select>
            </div>

            <div class="settings-card">
                <h2>Apparence</h2>
                <p class="settings-hint">Choisis comment Amphi s'affiche sur cet appareil.</p>
                <div class="theme-options">
                    <button type="button" class="theme-btn active" data-theme="clair">
                        <i class="fa-solid fa-sun"></i> Clair
                    </button>
                    <button type="button" class="theme-btn" data-theme="sombre">
                        <i class="fa-solid fa-moon"></i> Sombre
                    </button>
                    <button type="button" class="theme-btn" data-theme="systeme">
                        <i class="fa-solid fa-circle-half-stroke"></i> Par défaut
                    </button>
                </div>
            </div>

            <div class="settings-card danger-zone">
                <a href="{{ route('logout') }}" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i> Se déconnecter
                </a>
            </div>
        </section>
    </main>

    <script src="{{ asset('js/messagesBox.js') }}" defer></script>
    @include('components.messages')
    <script src="{{ asset('js/profil.js') }}" defer></script>

</body>
</html>
