class IdnAreaAPI {

    BASE_URL = 'http://localhost:8080/idn-administrative-area';

    /**
     *
     */
    constructor() {
    }

    /**
     * Request some data from API.
     *
     * Will return rejected promise if API produces an error response.
     *
     * @param {string} url The URL destination.
     * @returns Promise object.
     */
    async _requestData(url) {
        const response = await fetch(url);
        const responseJson = await response.json();

        if (responseJson.error) {
            return Promise.reject(`Fetch to ${url} produces an error response, [${responseJson.status}]: ${responseJson.message}`);
        }

        return responseJson.result;
    }


    /**
     *
     * @param {string} scope The scope area : provinces, regencies, districts, or villages.
     * @returns Promise object.
     */
    getAreas(scope) {
        return this._requestData(`${this.BASE_URL}/${scope}`);
    }


    /**
     *
     * @param {string} scope The scope area : provinces, regencies, districts, or villages.
     * @param {string} areaId The Area ID.
     * @returns Promise object.
     */
    getSubArea(scope, areaId) {
        return this._requestData(`${this.BASE_URL}/${scope}/${areaId}/sub`);
    }


    /**
     *
     * @returns Promise object.
     */
    getProvinces() {
        return this._requestData(`${this.BASE_URL}/provinces`);
    }
}
