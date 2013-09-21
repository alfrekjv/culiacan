$(document).ready(function() {

    $('#ciudad').live('change',function(e) {

        var url = ppi.baseUrl + 'admin/lugar/updateColonias/' + $(this).val();

        $.get(url, function(response) {
            $('#colonia').html(response.content);
        }, 'json');
    });

});