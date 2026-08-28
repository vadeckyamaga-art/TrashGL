document.querySelector('.mark-all-read').addEventListener('click', function () {
    document.querySelectorAll('.notif-item.unread').forEach(function (item) {
        item.classList.remove('unread');
        var dot = item.querySelector('.unread-dot');
        if (dot) dot.remove();
    });
    showToast('Toutes les notifications ont été marquées comme lues.', 'success');
});

document.querySelectorAll('.notif-item').forEach(function (item) {
    item.addEventListener('click', function () {
        item.classList.remove('unread');
        var dot = item.querySelector('.unread-dot');
        if (dot) dot.remove();
    });
});
