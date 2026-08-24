@include('components.head')
    <link rel="stylesheet" href="{{ asset('css/connexion.css') }}">
    <title>TrashGl - Connexion</title>
</head>
<body>
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
                    <a href="index.html" class="brand-logo brand-logo-mobile d-lg-none">
                        <span class="logo-mark"><i class="fa-solid fa-graduation-cap"></i></span>
                        Amphi
                    </a>

                    <h2 class="form-title">Connexion</h2>
                    <p class="form-subtitle">Retrouve ta promo en un clic.</p>

                    <form action="{{ route('login') }}" method="post">
                        @csrf

                        <div class="form-floating mb-3 input-icon-group">
                            <input type="email" class="form-control" id="adresse" name="email" placeholder="nom@etablissement.fr" required>
                            <label for="adresse"><i class="fa-solid fa-envelope"></i> Adresse e-mail</label>
                        </div>

                        <div class="form-floating mb-3 input-icon-group">
                            <input type="password" class="form-control" id="mot-de-passe" name="password" placeholder="Mot de passe" required>
                            <label for="mot-de-passe"><i class="fa-solid fa-lock"></i> Mot de passe</label>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="form-check remember-check">
                                <input class="form-check-input" name="remember" type="checkbox" id="se-souvenir" name="se_souvenir">
                                <label class="form-check-label" for="se-souvenir">
                                    Se souvenir de moi
                                </label>
                            </div>
                            <a href="#" class="link-forgot">Mot de passe oublié ?</a>
                        </div>

                        <button type="submit" class="btn btn-connect w-100">Se connecter</button>

                        <div class="divider">
                            <span>ou continuer avec</span>
                        </div>

                        <div class="d-flex gap-3 social-row">
                            <a href="{{ route('google.redirect') }}" class="btn btn-social w-100">
                                <svg class="" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg> Google
                            </a>
                            <a href="#" class="btn btn-social w-100">
                                <i class="fa-brands fa-facebook-f"></i> Facebook
                            </a>
                        </div>

                        <p class="signup-link">Pas de compte ? <a href="{{ route('register.form') }}">S'inscrire</a></p>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/messagesBox.js') }}" defer></script>

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                showToast(@json($errors->first()), 'error');
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                showToast(@json(session('success')), 'success');
                setTimeout(function (){
                    window.location.href = '{{ route('welcome') }}';
                }, 1500);
            });
        </script>
    @endif
    <script>
        //showToast('Connexion réussie, bienvenue !', 'success');
        //setTimeout(function () { window.location.href = 'accueil.html'; }, 1200);
    </script>

</body>
</html>
