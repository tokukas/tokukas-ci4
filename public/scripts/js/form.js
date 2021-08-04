// === Password Field ===
const passwordFields = $('.password-field');

$(passwordFields).each((i, field) => {
    // -- showing password (toggle event-handler) --
    const input = $(field).find('input');
    const toggle = $(field).find('.show-password-toggle');
    const icon = $(toggle).children('i.material-icons');

    $(toggle).on('click', () => {
        if ($(icon).html() === 'visibility_off') {
            $(icon).html('visibility_on');
            $(input).attr('type', 'text');
        } else {
            $(icon).html('visibility_off');
            $(input).attr('type', 'password');
        }
    });
});
