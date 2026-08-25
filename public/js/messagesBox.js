function showToast(message, type) {
    type = type || 'success';

    var container = document.getElementById('amphi-toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'amphi-toast-container';
        container.className = 'amphi-toast-container';
        document.body.appendChild(container);
    }

    var toast = document.createElement('div');
    toast.className = 'amphi-toast amphi-toast-' + type;

    var icon = type === 'error' ? 'fa-circle-exclamation' : 'fa-circle-check';
    toast.innerHTML = '<i class="fa-solid ' + icon + '"></i><span></span>';
    toast.querySelector('span').textContent = message;

    container.appendChild(toast);

    requestAnimationFrame(function () {
        toast.classList.add('show');
    });

    setTimeout(function () {
        toast.classList.remove('show');
        setTimeout(function () { toast.remove(); }, 1500);
    }, 3200);
}
