// tooltips init
const tooltipTriggerList = [].slice.call($('[data-bs-toggle="tooltip"]'));

const tooltipList = tooltipTriggerList.map((tooltipTriggerEl) => {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
