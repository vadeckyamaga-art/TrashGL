function showToast(message, type, duration) {
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
    var span = toast.querySelector('span');

    var cleanMessage = message.replace(/\s*\d+\s*minutes?/i, '').trim();

    if (duration && duration >0) {
        span.textContent = cleanMessage + '(' + duration + 's restantes)';
    } else {
        span.textContent = message;
    }

    container.appendChild(toast);

    requestAnimationFrame(function () {
        toast.classList.add('show');
    });

    if (duration && duration > 0) {
        var remaining = duration;
        var timerInterval =
        setInterval (function () {
            remaining--;
            if (remaining <= 0) {
                clearInterval(timerInterval);
                toast.classList.remove('show');
                setTimeout(function () { toast.remove(); }, 1500);
            } else {
                span.textContent = cleanMessage + '(' + remaining + 's restantes)'
            }
        }, 1000);

        setTimeout(function () {
            if (timerInterval) clearInterval(timerInterval);
            toast.classList.remove('show');
            setTimeout(function () { toast.remove(); }, 1500);
        }, (duration + 1) * 1000);
    } else {
        setTimeout(function () {
            toast.classList.remove('show');
            setTimeout(function () { toast.remove(); }, 1500);
        }, 3200);
    }

}
