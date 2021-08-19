const navbarCollapse = $('.navbar-collapse');
const hamburgerMenu = $('.hamburger-menu');


$(hamburgerMenu).on('click', () => {
    if ($(hamburgerMenu).hasClass('collapsed')) {
        // reset icon
        $(hamburgerMenu).removeClass('close');
    } else {
        $(hamburgerMenu).addClass('close');
    }
});
