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


// === Button Loading Spinner ===
const forms = $('form[data-form-loading="true"]');

$(forms).each((i, form) => {
    $(form).on('submit', () => {
        const btnSpinner = $(form).find('.btn-spinner[type="submit"]');
        const loadingName = $(btnSpinner).children('.btn-name').data('loading-name') || 'Memproses ...';

        // showing btn spinner
        $(btnSpinner).attr('disabled', '');
        $(btnSpinner).children('.btn-name').html(loadingName);
        $(btnSpinner).children('.spinner-border').removeClass('d-none');

        // disabling all submit btn on this page
        $('button[type="submit"]').attr('disabled', '');
    });
});
