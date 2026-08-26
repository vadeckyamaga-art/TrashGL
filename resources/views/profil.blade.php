@include('components.head')
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/amphi-post.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <title>TrashGl - Profil</title>
</head>
<body>

    @include('components.nav')

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

        @include('components.banner')

        <!-- ============ Sous-onglet : Publications ============ -->
        <section id="panel-post" class="subpanel active">
            <div class="post-composer">

                <h2>Créer une publication</h2>
                <form action="" method="POST">
                    @csrf

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

                    @include('components.background')

                    <p class="composer-label">Aperçu</p>
                    <div class="composer-preview" id="composer-preview" style="background:#FF6A1A">
                        <p id="preview-text">Exprime-toi devant toute la promo...</p>
                    </div>

                    <div class="composer-actions">
                        <button type="button" id="cancel-edit" class="btn-cancel-edit" hidden>Annuler</button>
                        <button type="submit" id="publish-btn" class="btn btn-connect">Publier</button>
                    </div>
                </form>
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
                        <input type="password" class="form-control" id="actual_password" name="password" placeholder="***********">
                        <label for="actual_paswword"><i class="fa-solid fa-lock"></i> Mot de passe actuel</label>
                        @include('components.toggle-password', ['target' => 'actual_password'])
                    </div>

                    <div class="form-floating input-icon-group password-group mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="***********">
                        <label for="password"><i class="fa-solid fa-lock"></i> Nouveau mot de passe</label>
                        @include('components.toggle-password', ['target' => 'password'])
                    </div>

                    <div class="form-floating input-icon-group password-group mb-3">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="***********">
                        <label for="password_confirmation"><i class="fa-solid fa-lock"></i> Confirmer le nouveau mot de passe</label>
                        @include('components.toggle-password', ['target' => 'password_confirmation'])
                    </div>

                    <button type="button" class="btn btn-connect settings-save">Mettre à jour le mot de passe</button>
                </form>
            </div>

            <form action="" method="POST">
                @csrf

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
            </form>

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
