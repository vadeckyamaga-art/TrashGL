document.addEventListener('click', function (e) {
    const menuBtn = e.target.closest('.post-menu-btn');
    const isInsideMenu = e.target.closest('.post-menu-wrap');

    document.querySelectorAll('.post-menu-dropdown').forEach(function (dropdown) {
        if (!isInsideMenu || dropdown !== menuBtn?.nextElementSibling) {
            dropdown.hidden = true;
            dropdown.previousElementSibling.setAttribute('aria-expanded', false);
        }
    });

    if (menuBtn) {
        const dropdown = menuBtn.nextElementSibling;
        const isOpen = !dropdown.hidden;
        dropdown.hidden = isOpen;
        menuBtn.setAttribute('aria-expanded', String(!isOpen));
    }

    const buttons = document.querySelectorAll('.no-action');
    buttons.forEach(button => {
        button.addEventListener("click", () => {
            buttons.forEach(btn => {
                btn.dataset.expanded = "false";
            });
            button.dataset.expanded = "true";
        });
    });

});
