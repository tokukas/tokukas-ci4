
const addressIdStorage = $('#addressIdStorage');
const addressButtons = $('[data-btn="address"]');

const resetAllBtnToActive = () => {
    $('[data-btn="address"]').each((i, btn) => {
        $(btn).removeClass('btn-outline-primary');
        $(btn).removeAttr('disabled');
        $(btn).addClass('btn-outline-secondary');
        $(btn).html(`<span>Pilih Alamat</span>`);
    });
}

$(addressButtons).each((i, btn) => {
    $(btn).on('click', () => {
        $(addressIdStorage).val($(btn).data('id'));

        // set view
        resetAllBtnToActive();
        $(btn).removeClass('btn-outline-secondary');
        $(btn).addClass('btn-outline-primary');
        $(btn).attr('disabled', '');
        $(btn).html(`
            <i class="material-icons">checked</i>
            <span>Terpilih</span>
        `);
    });
});
