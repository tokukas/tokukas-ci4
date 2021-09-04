const setNumInputField = () => {
    $('.card input').each((i, checkbox) => {
        if (checkbox.checked) {
            // show number input field
            const destNumUsed = $(checkbox).data('dest-num-used');
            const field = $('#transferDestField');
            const label = $(field).find('label');
            const input = $(field).find('input');
            const icon = $(field).find('#icon');
            const textHelper = $(field).find('.form-text');

            if (destNumUsed === '') {
                $(field).addClass('d-none');
                $(input).removeAttr('required');
            } else {
                const labelText = destNumUsed === 'phone' ? 'nomor telepon' : 'nomor rekening';
                const placeholderText = destNumUsed === 'phone' ? '0812345678' : '12345678';
                const iconName = destNumUsed === 'phone' ? 'fas fa-phone' : 'fas fa-money-check';

                $(field).removeClass('d-none');
                $(label).html(ucwords(`${labelText} :`));
                $(input).attr('required', '');
                $(input).attr('placeholder', `Contoh : ${placeholderText}`);
                $(icon).removeClass().addClass(iconName)
                $(textHelper).html(`Gunakan ${labelText} yang terdaftar pada layanan yang anda pilih.`);
            }
        }
    });
}

$('.card input').each((i, checkbox) => {
    $(checkbox).on('input', setNumInputField);
});

setNumInputField();
