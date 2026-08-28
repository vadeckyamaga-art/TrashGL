@include('components.head')
    <link rel="stylesheet" href="{{ asset('css/notifications.css') }}">
    <title>TrashGl - Notifications</title>
</head>
<body>

    @include('components.nav')

    <main class="notif-page">

        <div class="notif-header">
            <h1>Notifications</h1>
            <button type="button" class="mark-all-read">Tout marquer comme lu</button>
        </div>

        <section class="notif-group">
            <h2 class="notif-group-title">Aujourd'hui</h2>

            <a href="{{ route('notifications.feed') }}" class="notif-item unread">
                <div class="notif-avatar-wrap">
                    <img src="https://i.pravatar.cc/150?img=44" alt="Photo de profil de Carine Ngo" class="notif-avatar">
                    <span class="notif-type-badge type-like"><i class="fa-solid fa-heart"></i></span>
                </div>
                <div class="notif-body">
                    <p><span class="notif-name">Carine Ngo</span> a aimé votre publication</p>
                    <span class="notif-time">Il y a 20 min</span>
                </div>
                <span class="unread-dot" aria-hidden="true"></span>
            </a>

        </section>

        <section class="notif-group">
            <h2 class="notif-group-title">Cette semaine</h2>

            <a href="{{ route('notifications.feed') }}" class="notif-item">
                <div class="notif-avatar-wrap">
                    <img src="https://i.pravatar.cc/150?img=47" alt="Photo de profil de Sandrine Mbida" class="notif-avatar">
                    <span class="notif-type-badge type-share"><i class="fa-solid fa-share"></i></span>
                </div>
                <div class="notif-body">
                    <p><span class="notif-name">Sandrine Mbida</span> a partagé votre publication</p>
                    <span class="notif-time">Hier</span>
                </div>
            </a>

        </section>
    </main>

    <script src="{{ asset('js/notifications.js') }}" defer></script>
    <script src="{{ asset('js/messagesBox.js') }}" defer></script>
    @include('components.messages')

</body>
</html>
