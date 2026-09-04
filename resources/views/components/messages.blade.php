@php
    $rateLimitActive = session('rate_limit_expires_at') && now()->timestamp < session('rate_limit_expires_at');
@endphp

@if ($errors->any() && !$rateLimitActive)
    <script>
        console.log('script messages.blade.php exécuté');
        document.addEventListener('DOMContentLoaded', function () {
            showToast(@json($errors->first()), 'error');
        });
    </script>
@elseif ($errors->passwordUpdate->any() && !$rateLimitActive)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            showToast(@json($errors->passwordUpdate->first()), 'error');
        });
    </script>
@endif

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            showToast(@json(session('success')), 'success');
        });
    </script>
@endif

@if (session('rate_limit_expires_at') && now()->timestamp < session('rate_limit_expires_at'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let now = Math.floor(Date.now() / 1000);
            let expiresAt = {{ session('rate_limit_expires_at') }};
            let remaining = Math.max(0, expiresAt - now);
            let message = @json(session('rate_limit_message') ?? 'Trop de tentatives. Réessayer plus tard');

            console.log('now: ', now);
            console.log('expiresAt: ', expiresAt);
            console.log('remaining: ', remaining);
            console.log('message: ', message);
            if (remaining > 0) {
                showToast(message, 'error', remaining);
            } else {
                fetch('{{ route('clear.rate.limit') }}', {
                    method: 'POST',
                    headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')}
                });
            }
        });
    </script>
@endif
