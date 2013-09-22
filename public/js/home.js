var map = null,
    latitude = null,
    longitude = null,
    infoWindow = null,
    geocoder = null,
    markersArray = [],
    culiacan = new google.maps.LatLng(24.80485, -107.385498),
    marker,
    map,
    geocoder,
    ciudad = "Culiacan Rosales",
    calle,
    numero,
    colonia,
    direccion = ciudad;


$(document).ready(function () {

    $('#calle').blur(function () {
        calle = $(this).val();
        buscarCoordenadas();
    });
    $('#numero').blur(function () {
        numero = $(this).val();
        buscarCoordenadas();
    });
    $('#colonia').blur(function () {
        colonia = $(this).val();
        buscarCoordenadas();
    });


    $('#mapa-canvas').height($('body').height());

    $('.sendEmail').live('click', function (e) {

        e.preventDefault();

        $.post(ppi.baseUrl + 'contacto/enviar', $('#contact-form').serialize(), function (response) {

            if (response.status == 'success') {

                alert(response.message);

                $('#modal-contacto').modal('hide');
            }

            if (response.status == 'error') {

                $('#mensaje-contacto').toggleClass('alert alert-danger');
                $('#mensaje-contacto').html(response.message);
            }

        }, 'json');

    });

    $('#btn-municipios .dropdown-menu').on('click', 'a', function (event) {

        event.preventDefault();

        var $parent = $(this).closest('#btn-municipios'),
            $btn = $parent.find('button'),
            $prev = $parent.find('li.active'),
            $next = $(this).parent().addClass('active');

        $prev.toggleClass('active');
        $parent.toggleClass('open');
        $btn.find('.text').text($next.find('a').text());

        // Move map
        latitude = $next.find('a').data('lat');
        longitude = $next.find('a').data('lng');

        latlng = new google.maps.LatLng(latitude, longitude);
        map.setCenter(latlng);
        map.setZoom(13);
    });

    $('#btn-tipo a').click(function (e) {

        e.preventDefault();
        map.clearOverlays();

        var type = $(this).data('tipo');

        $.getJSON(ppi.baseUrl + 'lugares/' + type + '.json', function (spots) {
            addMarkerFromCat(spots, type);
        });

    });

    $('#modal-reportar-lugar').on('hidden.bs.modal', function () {
        $('#msj-error').css({'display': 'none'});
        document.getElementById('form-reportar-lugar').reset();
    });

    $('#modal-reportar-lugar').on('shown.bs.modal', function () {
        $('#nombre').focus();
    });

    $('#modal-reportar-persona').on('shown.bs.modal', function () {
        $('#nombre_completo').focus();
    });

    $('#modal-contacto').on('shown.bs.modal', function () {
        $('#nombre_contacto').focus();
    });

    $('#btn-reportar-lugar').click(function () {
        $('#modal-reportar-lugar').modal('show');
    });

    $('#btn-guardar-reportar-lugar').click(function () {

        $.post(ppi.baseUrl + 'lugares/reportar', $('#form-reportar-lugar').serialize(), function (resultado) {
            if (resultado.exito) {
                document.getElementById('form-reportar-lugar').reset();
                $('#msj-error').removeClass('alert-danger').addClass('alert-success').html(resultado.msj);
                $('#msj-error').slideDown();
            } else {
                $('#msj-error').removeClass('alert-success').addClass('alert-danger').html(resultado.msj);
                $('#msj-error').slideDown();
            }
            ;
        }, 'json');

        return false;
    });

    // Repotar persona
    $('.reportarPersona').click(function (e) {

        e.preventDefault();
        var url = ppi.baseUrl + 'reportar/persona';

        // Cargar html del form.
        $.get(url, function (response) {
            $('#modal-reportar-persona').html(response.content);
            $('#modal-reportar-persona').modal('show');
        }, 'json');

    });

    $('.reportarPersonaSubmit').live('click', function (e) {

        e.preventDefault();

        var url = ppi.baseUrl + 'reportar/persona/save';

        $.post(url, $('#reportar-persona-form').serialize(), function (response) {

            if (response.status == 'success') {

                alert(response.message);

                $('#modal-reportar-persona').modal('hide');
            }

            if (response.status == 'error') {

                $('#mensaje-persona').toggleClass('alert alert-danger');
                $('#mensaje-persona').html(response.message);
            }

        }, 'json');
    });
});

function placeSpotsOnMap() {

    // Place Spots on the Map
    $.getJSON(ppi.baseUrl + 'lugares/agua.json', function (spots) {
        addMarkerFromCat(spots, 'agua');
    });

    $.getJSON(ppi.baseUrl + 'lugares/evacuadas.json', function (spots) {
        addMarkerFromCat(spots, 'evacuadas');
    });

    $.getJSON(ppi.baseUrl + 'lugares/albergues.json', function (spots) {
        addMarkerFromCat(spots, 'albergues');
    });

    $.getJSON(ppi.baseUrl + 'lugares/afectadas.json', function (spots) {
        addMarkerFromCat(spots, 'afectadas');
    });

    $.getJSON(ppi.baseUrl + 'lugares/centros.json', function (spots) {
        addMarkerFromCat(spots, 'centros');
    });
}

function addMarkerFromCat(spots, catname) {

    var venues = spots.data;

    for (i = 0; i < venues.length; i++) {

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(venues[i].lat, venues[i].lng),
            map: map,
            title: venues[i].nombre,
            icon: ppi.baseUrl + 'images/' + catname + '.png',
            animation: google.maps.Animation.DROP
        });

        markersArray.push(marker);

        // agregando Ventanas infoWindow
        (function (i, marker) {
            google.maps.event.addListener(marker, 'click', function () {

                // Verifica si la ventana ya existe, no vuelve a crear una nueva.
                if (!infoWindow) {
                    infoWindow = new google.maps.InfoWindow();
                }

                var address = venues[i].calle + " " + venues[i].numero + " " + venues[i].colonia + " " +
                    venues[i].ciudad + " " + venues[i].estado + " " + venues[i].pais;

                var desc = "<div class='spot'><div class='title' style='font-weight: bold'>" + venues[i].nombre + "</div>" +
                    "<div class='address'>" + address + "</div><br>" +
                    "<div class='observaciones'><p>" + venues[i].observaciones + "</p></div> " +
                    "</div>";

                infoWindow.setContent(desc);
                infoWindow.open(map, marker);
            });
        })(i, marker);
    }
}

function initialize() {

    latitude = 24.80481147653668;
    longitude = -107.39376068115234;

    var mapOptions = {
        zoom: 13,
        center: new google.maps.LatLng(latitude, longitude),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById('mapa-canvas'), mapOptions);

    placeSpotsOnMap();
}

google.maps.event.addDomListener(window, 'load', initialize);

google.maps.Map.prototype.clearOverlays = function () {
    if (markersArray) {
        for (var i = 0; i < markersArray.length; i++) {
            markersArray[i].setMap(null);
        }
    }
}

/***Mapa modal***/
function iniciarMapaLugar() {

    var mapOptions = {
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: culiacan
    };

    geocoder = new google.maps.Geocoder();
    lugarM = new google.maps.Map(document.getElementById('lugarMap'),
        mapOptions);

    marcadorL = new google.maps.Marker({
        map: lugarM,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: culiacan
    });

    google.maps.event.addListener(marcadorL, 'click', toggleBounce);
    google.maps.event.addListener(lugarM, 'click', function (event) {

        var latlng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
        moverMarcador(latlng);

    });

    google.maps.event.addListener(marcadorL, 'mouseup', cambiaCoordenada);
}
google.maps.event.addDomListener(window, 'load', iniciarMapaLugar);
lugarM.setCenter(marcadorL.getPosition());

function buscarCoordenadas() {
    adress = ciudad + " " + calle + " " + numero + " " + colonia;
    geocoder.geocode({ 'address': adress}, function (results) {
        moverMarcador(results[0].geometry.location);
    });

}

function moverMarcador(latlng) {
    marcadorL.setMap(null);
    marcadorL = new google.maps.Marker({
        map: lugarM,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: latlng
    });
    cambiaCoordenada();
    google.maps.event.addListener(marcadorL, 'mouseup', cambiaCoordenada);

}
function toggleBounce() {

    if (marcadorL.getAnimation() != null) {
        marcadorL.setAnimation(null);
    } else {
        marcadorL.setAnimation(google.maps.Animation.BOUNCE);
    }
}

function cambiaCoordenada() {
    document.getElementById('lat').value = marcadorL.getPosition().lat();
    document.getElementById('lng').value = marcadorL.getPosition().lng();
}
    