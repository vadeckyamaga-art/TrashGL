@include('components.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <title>TrashGL - Inscription</title>
</head>
<body>

    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">
            <!-- Panneau de marque -->
            <div class="col-lg-6 d-none d-lg-flex brand-panel">
                <div class="brand-content">

                    <a href="{{ route('register.form') }}" class="brand-logo">
                        <span class="logo-mark"><i class="fa-solid fa-graduation-cap"></i></span>
                        Amphi
                    </a>

                    <div class="brand-message">
                        <h1>Rejoins ta promo,<br>partage ta vie<br>de campus.</h1>
                        <p>Crée ton compte pour publier, commenter, liker et partager avec toute ta promo, au même endroit.</p>
                    </div>

                    <!-- Signature : aperçu du fil, en écho au produit -->
                    <div class="feed-preview" aria-hidden="true">
                        <div class="preview-card card-back">
                            <div class="preview-head">
                                <span class="avatar avatar-b"></span>
                                <div class="preview-lines">
                                    <span class="line-name"></span>
                                    <span class="line-time"></span>
                                </div>
                            </div>
                            <span class="line-text w-75"></span>
                        </div>

                        <div class="preview-card card-front">
                            <div class="preview-head">
                                <span class="avatar avatar-a"></span>
                                <div class="preview-lines">
                                    <span class="line-name"></span>
                                    <span class="line-time"></span>
                                </div>
                            </div>
                            <span class="line-text w-100"></span>
                            <span class="line-text w-50"></span>
                            <div class="preview-actions">
                                <span><i class="fa-solid fa-heart"></i> 24</span>
                                <span><i class="fa-solid fa-comment"></i> 6</span>
                                <span><i class="fa-solid fa-share"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panneau d'inscription -->
            <div class="col-lg-6 form-panel">
                <div class="form-wrapper">

                    <a href="index.html" class="brand-logo brand-logo-mobile d-lg-none">
                        <span class="logo-mark"><i class="fa-solid fa-graduation-cap"></i></span>
                        Amphi
                    </a>

                    <h2 class="form-title">Créer un compte</h2>
                    <p class="form-subtitle">Quelques infos et te voilà dans la promo.</p>

                    <form id="registerForm" action="{{ route('register') }}" method="post">
                        @csrf

                        <div class="form-floating mb-3 input-icon-group">
                            <input type="email" class="form-control" id="adresse" name="email" value="{{ old('email') }}" placeholder="nom@etablissement.fr" required>
                            <label for="adresse"><i class="fa-solid fa-envelope"></i> Adresse e-mail</label>
                        </div>

                        <div class="form-floating mb-3 input-icon-group">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Jean Dupont" required>
                            <label for="name"><i class="fa-solid fa-envelope"></i> Nom</label>
                        </div>

                        <div class="form-floating mb-3 input-icon-group password-group">
                            <input type="password" class="form-control" id="register_password" name="password" placeholder="Mot de passe" required>
                            <label for="register_password"><i class="fa-solid fa-lock"></i> Mot de passe</label>
                            @include('components.toggle-password', ['target' => 'register_password'])
                        </div>

                        <div class="form-floating mb-4 input-icon-group password-group">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
                            <label for="password_confirmation"><i class="fa-solid fa-lock"></i> Confirmer le mot de passe</label>
                            @include('components.toggle-password', ['target' => 'password_confirmation'])
                        </div>

                        <div class="form-check remember-check mb-4">
                            <input class="form-check-input" type="checkbox" id="conditions" name="conditions" required>
                            <label class="form-check-label" for="conditions">
                                J'accepte les <a href="#" class="terms-link">conditions d'utilisation</a>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-connect w-100">Créer mon compte</button>

                        @include('components.social-connect-button')

                        <p class="signup-link">Déjà un compte ? <a href="{{ route('login.form') }}">Se connecter</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>

   @include('components.verification-email-modal', [
                'verifyUrl' => route('register.verify.email'),
                'cancelUrl' => route('register.cancel'),
            ])
    @include('components.messages')

    <script src="{{ asset('js/togglePassword.js') }}" defer></script>
    <script src="{{ asset('js/messagesBox.js') }}" defer></script>
    <script src="{{ asset('js/register-form.js') }}" defer></script>
    <script src="{{ asset('js/verification-email-modal.js') }}" defer></script>

</body>
</html>
