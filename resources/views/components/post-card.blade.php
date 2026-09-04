@php
    $isOwner = Auth::check() && $post->user_id === Auth::id();
@endphp

<article class="post-card" data-post-uuid="{{ $post->uuid }}" data-bg-type="{{ $post->background_type }}" data-bg-value="{{ $post->background_type === 'image' ? ($post->backgroundImage->url ?? '') : $post->background_value }}" data-bg-image-id="{{ $post->background_image_id }}">
    <header class="post-header">
        <div class="avatar-wrap">
            <img src="https://i.pravatar.cc/150?img=5" alt="Avatar de {{ $post->user->pseudonym }}" class="avatar">
            @unless ($isOwner)
                <button type="button" class="follow-btn" aria-label="Suivre {{ $post->user->pseudonym }}">
                    <i class="fa-solid fa-plus"></i>
                </button>
            @endunless
        </div>

        <div class="post-identity">
            <span class="post-name">{{ $post->user->pseudonym }}</span>
            <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
        </div>

        <div class="post-menu-wrap">
            <button type="button" class="post-menu-btn" aria-haspopup="true" aria-expanded="false" aria-label="Plus d'option">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
            <ul class="post-menu-dropdown" hidden>
                @if ($isOwner)
                    <li><button type="button" class="post-menu-item" data-action="edit"><i class="fa-solid fa-pen"></i> Modifier</button></li>
                    <li><button type="button" class="post-menu-item" data-action="send"><i class="fa-solid fa-paper-plane"></i> Envoyer</button></li>
                    <li><button type="button" class="post-menu-item" data-action="copy-link"><i class="fa-solid fa-link"></i> Copier le lien</button></li>
                    <li><button type="button" class="post-menu-item text-danger" data-action="delete"><i class="fa-solid fa-trash"></i> Supprimer</button></li>
                @else
                    <li><button type="button" class="post-menu-item" data-action="send"><i class="fa-solid fa-paper-plane"></i> Envoyer</button></li>
                    <li><button type="button" class="post-menu-item" data-action="copy-link"><i class="fa-solid fa-link"></i> Copier le lien</button></li>
                    <li><button type="button" class="post-menu-item text-danger" data-action="report"><i class="fa-solid fa-flag"></i> Signaler</button></li>
                @endif
            </ul>
        </div>
    </header>

    <div class="post-text-bg"
        style="@if($post->background_type === 'image')background-image: linear-gradient(180deg, rgba(30,20,10,0.15), rgba(20,12,6,0.65)), url('{{ $post->backgroundImage->url ?? '' }}');@else background:{{ $post->background_value }};@endif">
        <p>{{ $post->content }}</p>
    </div>

    <footer class="post-actions">
        <button type="button" class="action-btn no-action" data-expanded="false">
            <i class="fa-solid fa-heart"></i> J'aime <span class="count">{{ $post->likes()->count() }}</span>
        </button>
        <button type="button" class="action-btn btn-comment-toggle" aria-expanded="false">
            <i class="fa-solid fa-comment"></i> Commenter <span class="count">{{ $post->comments()->count() }}</span>
        </button>
        <button type="button" class="action-btn no-action" data-expanded="false">
            <i class="fa-solid fa-share"></i> Partager
        </button>
    </footer>

    <div class="comments-section" hidden>
        <div class="comments-list">
            @foreach ($post->comments()->latest()->get() as $comment)
                <div class="comment">
                    <img src="https://i.pravatar.cc/150?img=21" alt="Avatar" class="comment-avatar">
                    <div class="comment-bubble">
                        <span class="comment-name">{{ $comment->user->pseudonym }}</span>
                        <p class="comment-text">{{ $comment->content }}</p>
                    </div>
                </div>
            @endforeach
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
