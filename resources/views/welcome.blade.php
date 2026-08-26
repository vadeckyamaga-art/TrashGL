@include('components.head')
    <title>TrashGL - Accueil</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    
    @include('components.nav')

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

    @include('components.messages')
</body>
</html>
