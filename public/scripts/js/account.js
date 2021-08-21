/**
 * ----------------------------------------------------
 * Toggle for Delete Confirm Modal
 * ----------------------------------------------------
 */
$('.delete-toggle[data-bs-toggle="modal"]').each((i, toggle) => {
    $(toggle).on('click', () => {
        $('#deleteConfirm form').attr('action', $(toggle).attr('data-link'));
    });
});
