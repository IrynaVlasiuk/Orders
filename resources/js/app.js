require('./bootstrap');

function ajaxHandler(type, url, data, success, error) {
    $.ajax({
        type: type,
        url: url,
        data: data,
        success: success,
        error: error
    })
}

$(document).ready(function () {
   $('.edit-order').on('click', function () {
        $('#modalEdit').modal('toggle');
   });
});
