/*
 | ----------------------------------------------
 | Constanta
 | ----------------------------------------------
 */

/** API Object */
const idnArea = new IdnAreaAPI();

/** Province Input Element */
const provinceInputEl = $('#province');

/** Regency Input Element */
const regencyInputEl = $('#regency');

/** District Input Element */
const districtInputEl = $('#district');

/** Village Input Element */
const villageInputEl = $('#village');

/*
 | ----------------------------------------------
 | Functions
 | ----------------------------------------------
 */

/**
 *
 * @param {string} scope
 * @param {HTMLInputElement} inputEl
 * @param {object} areas
 */
const createDatalist = (scope, inputEl, areas) => {
    // creating datalist element
    const datalistEl = document.createElement('datalist');
    const datalistId = 'datalist' + ucwords(scope);
    $(datalistEl).attr('id', datalistId);

    // creating options
    areas.forEach((area) => {
        const opt = document.createElement('option');
        $(opt).html(area.name);
        $(opt).attr('value', area.name);
        $(opt).data('id', area.id);
        $(opt).appendTo(datalistEl);
    });

    // append the datalist at the bottom the input element
    $(datalistEl).appendTo($(inputEl).parent());
    $(inputEl).attr('list', datalistId);
}


/**
 *
 * @param {HTMLInputElement} datalistElId
 */
const removeDatalist = (datalistElId) => {
    $('#' + datalistElId).remove();
}


/**
 *
 * @param {HTMLInputElement} inputEl
 * @param {HTMLOptionElement[]} optionList
 * @returns String of Area Id
 */
const getValidAreaId = (inputEl, optionList) => {
    let id = '';
    const areaName = $(inputEl).val();

    $(optionList).each((i, option) => {
        if (areaName.toUpperCase() === $(option).val().toUpperCase()) {
            id = $(option).data('id');
        }
    });

    return id;
}


/*
 | ----------------------------------------------
 | Event Handler (Executor)
 | ----------------------------------------------
 */

// create datalist province
idnArea.getProvinces()
    .then((response) => response.sort((a, b) => a.name > b.name))
    .then((response) => createDatalist('province', provinceInputEl, response))
    .catch((error) => console.error(error))
    ;


// create datalist regency
regencyInputEl.on('focus', (e) => {
    const provinceId = getValidAreaId(provinceInputEl, $('#datalistProvince option'));
    removeDatalist('datalistRegency');

    if (provinceId !== '') {
        // fetch data from API
        idnArea.getSubArea('provinces', provinceId)
            .then((response) => response.sort((a, b) => a.name > b.name))
            .then((response) => createDatalist('regency', regencyInputEl, response))
            .catch((error) => console.error(error));
    }
});


// create datalist district
districtInputEl.on('focus', (e) => {
    const regencyId = getValidAreaId(regencyInputEl, $('#datalistRegency option'));
    removeDatalist('datalistDistrict');

    if (regencyId !== '') {
        // fetch data from API
        idnArea.getSubArea('regencies', regencyId)
            .then((response) => response.sort((a, b) => a.name > b.name))
            .then((response) => createDatalist('district', districtInputEl, response))
            .catch((error) => console.error(error));
    }
});


// create datalist district
villageInputEl.on('focus', (e) => {
    const districtId = getValidAreaId(districtInputEl, $('#datalistDistrict option'));
    removeDatalist('datalistVillage');

    if (districtId !== '') {
        // fetch data from API
        idnArea.getSubArea('districts', districtId)
            .then((response) => response.sort((a, b) => a.name > b.name))
            .then((response) => createDatalist('village', villageInputEl, response))
            .catch((error) => console.error(error));
    }
});
