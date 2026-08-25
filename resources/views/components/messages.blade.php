@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function (){
                showToast(@json($errors->first()), 'error');
            }, 1500);
        });
    </script>
@endif

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function (){
                showToast(@json(session('success')), 'success');
            }, 1500);
        });
    </script>
@endif
