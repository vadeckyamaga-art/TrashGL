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
                <a href="{{ route('profil.edit') }}" class="nav-tab">
                    <i class="fa-solid fa-user"></i>
                    <span>Profil</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Fil de publications -->
    <main class="feed">

        @include('components.banner')

        <!-- Raccourci de publication -->
        <button type="button" class="quick-post" data-bs-toggle="modal" data-bs-target="#quickPostModal">
            <img src="https://i.pravatar.cc/150?img=5" alt="Ta photo de profil" class="avatar">
            <span class="quick-post-placeholder">Quoi de neuf, David ?</span>
            <span class="quick-post-icon"><i class="fa-solid fa-image"></i></span>
        </button>

        @include('components.post-card')

    </main>

    <script src="{{ asset('js/Home.js') }}" defer></script>
    <script src="{{ asset('js/messagesBox.js') }}" defer></script>
</body>
</html>
