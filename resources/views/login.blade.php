@include('components.head')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>TrashGl - Connexion</title>
</head>
<body>

    {{-- <pre style="background: yellow; color:black; padding: 10px">
        DEBUG ERRORS: {{ $errors->any() ? 'OUI - '.$errors->first(): 'NON' }}
        DEBUG SUCCES: {{ session('success') ?? 'AUCUNE' }}
        DEBUG SESSION ID: {{ session()->getId() }}
        DEBUG TEST_DIRECT: {{ session('TEST8DIRECT') ?? 'AUCUNE' }}
    </pre> --}}

    <div class="container-fluid p-0">
        <div class="row g-0 min-vh-100">

            <!-- Panneau de marque -->
            <div class="col-lg-6 d-none d-lg-flex brand-panel">
                <div class="brand-content">
                    <a href="index.html" class="brand-logo">
                        <span class="logo-mark"><i class="fa-solid fa-graduation-cap"></i></span>
                        Amphi
                    </a>

                    <div class="brand-message">
                        <h1>Ta promo,<br>toujours à<br>portée de fil.</h1>
                        <p>Publie, commente, like et partage ce qui se passe dans ta promo. Un seul endroit, tout le monde dedans.</p>
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

            <!-- Panneau de connexion -->
            <div class="col-lg-6 form-panel">
                <div class="form-wrapper">
                    <a href="{{ route('login.form') }}" class="brand-logo brand-logo-mobile d-lg-none">
                        <span class="logo-mark"><i class="fa-solid fa-graduation-cap"></i></span>
                        Amphi
                    </a>

                    <h2 class="form-title">Connexion</h2>
                    <p class="form-subtitle">Retrouve ta promo en un clic.</p>

                    <form action="{{ route('login') }}" method="post">
                        @csrf

                        <div class="form-floating mb-3 input-icon-group">
                            <input type="email" class="form-control" id="adresse" name="email" value="{{ old('email') }}" placeholder="nom@etablissement.fr" required>
                            <label for="adresse"><i class="fa-solid fa-envelope"></i> Adresse e-mail</label>
                        </div>

                        <div class="form-floating mb-3 input-icon-group">
                            <input type="password" class="form-control" id="login_password" name="password" placeholder="Mot de passe" required>
                            <label for="login_password"><i class="fa-solid fa-lock"></i> Mot de passe</label>
                            @include('components.toggle-password', ['target' => 'login_password'])
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check remember-check">
                                <input class="form-check-input" name="remember" type="checkbox" id="se-souvenir" name="se_souvenir">
                                <label class="form-check-label" for="se-souvenir">Se souvenir de moi</label>
                            </div>
                            <a href="#" class="link-forgot">Mot de passe oublié ?</a>
                        </div>

                        <button type="submit" class="btn btn-connect w-100">Se connecter</button>

                        @include('components.social-connect-button')

                        <p class="signup-link">Pas de compte ? <a href="{{ route('register.form') }}">S'inscrire</a></p>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/messagesBox.js') }}" defer></script>
    <script src="{{ asset('js/togglePassword.js') }}" defer></script>
    @include('components.login-register-messages')
</body>
</html>
