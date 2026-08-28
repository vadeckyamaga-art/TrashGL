<!-- Navigation principale : 4 onglets -->
<nav class="top-nav">
    <div class="nav-inner">
        <a href="{{ route('welcome') }}" class="brand-logo">
            <span class="logo-mark"><i class="fa-solid fa-graduation-cap"></i></span>
            <span class="d-none d-sm-inline">Amphi</span>
        </a>

        <div class="nav-tabs">
            <a href="{{ route('welcome') }}" class="nav-tab {{ request()->routeIs('welcome') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Accueil</span>
            </a>
            <a href="{{ route('notifications.feed') }}" class="nav-tab {{ request()->routeIs('notifications.feed') ? 'active' : '' }}">
                <i class="fa-solid fa-bell"></i>
                <span class="nav-badge">3</span>
                <span>Notifications</span>
            </a>
            <a href="" class="nav-tab">
                <i class="fa-solid fa-comment-dots"></i>
                <span>Messages</span>
            </a>
            <a href="{{ route('profil.edit') }}" class="nav-tab {{ request()->routeIs('profil.edit') ? 'active' : '' }}">
                <i class="fa-solid fa-user"></i>
                <span>Profil</span>
            </a>
        </div>
    </div>
</nav>
