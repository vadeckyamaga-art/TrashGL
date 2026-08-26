@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            showToast(@json($errors->first()), 'error');
        });
    </script>
@endif
@if (session('success'))
    <script>
        console.log("Le message de success est bien passée!");
        document.addEventListener('DOMContentLoaded', function () {
            showToast(@json(session('success')), 'success');
            setTimeout(function (){
                window.location.href = '{{ route('welcome') }}';
            }, 1500);
        });
    </script>
@endif
