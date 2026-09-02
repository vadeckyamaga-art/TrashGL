@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            showToast(@json($errors->first()), 'error');
        });
    </script>
@elseif ($errors->passwordUpdate->any())
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
