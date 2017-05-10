$(document).ready(function () {

});

/**
 * 
 * @param {string} region
 * @param {string} method
 * @param {array} methodParams
 * @param {boolean} force_get_cache
 * @returns {json}
 */
function lolapicall(region, method, methodParams, force_get_cache) {
    var response = {};
    $.ajax({
        url: '/lolapi/',
        data: {
            method: method,
            region: region,
            methodParams: methodParams,
            force_get_cache: force_get_cache ? 1 : 0
        },
        dataType: 'json',
        async: false, //peticion sincronica,
        success: function (data, textStatus, jqXHR) {
            response = data;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            response = jqXHR.responseJSON;
        },
        crossDomain: true,
        timeout: 0,
        method: 'POST'
    });

    if (response.exception) {
        throw new Error(method + ' - ' + response.exception.message);
    }

    return response;
}