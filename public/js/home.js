var map = null,
    latitude = null,
    longitude = null,
    infoWindow = null,
    geocoder = null,
    markersArray = [];

$(document).ready(function () {

    $('#mapa-canvas').height($('body').height());

    $('#btn-municipios .dropdown-menu').on('click', 'a', function (event) {

        event.preventDefault();

        var $parent = $(this).closest('#btn-municipios'),
            $btn    = $parent.find('button'),
            $prev   = $parent.find('li.active'),
            $next   = $(this).parent().addClass('active');

        $prev.toggleClass('active');
        $parent.toggleClass('open');
        $btn.find('.text').text($next.find('a').text());
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
    $('#btn-reportar-lugar').click(function(){
        $('#modal-reportar-lugar').modal('show');
    });
    $('#btn-guardar-reportar-lugar').click(function(){

        $.post(ppi.baseUrl + 'lugares/reportar', $('#form-reportar-lugar').serialize(), function(resultado){
            if ( resultado.exito ) {
                document.getElementById('form-reportar-lugar').reset();
                $('#msj-error').removeClass('alert-danger').addClass('alert-success').html(resultado.msj);
                $('#msj-error').slideDown();
            }else{
                $('#msj-error').removeClass('alert-success').addClass('alert-danger').html(resultado.msj);
                $('#msj-error').slideDown();
            };
        },'json');

        return false;
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

        var address  = venues[i].calle + " " + venues[i].numero + " " + venues[i].colonia + " " +
            venues[i].ciudad + " " + venues[i].estado + " " + venues[i].pais;

        var marker = new google.maps.Marker({
            position:   new google.maps.LatLng(venues[i].lat, venues[i].lng),
            map:        map,
            title:      venues[i].nombre,
            icon:       ppi.baseUrl + 'images/' + catname + '.png',
            animation:  google.maps.Animation.DROP
        });

        markersArray.push(marker);

        // agregando Ventanas infoWindow
        (function (i, marker) {
            google.maps.event.addListener(marker, 'click', function () {

                // Verifica si la ventana ya existe, no vuelve a crear una nueva.
                if (!infoWindow) {
                    infoWindow = new google.maps.InfoWindow();
                }

                var desc = "<div class='spot'><div class='title' style='font-weight: bold'>" + venues[i].nombre + "</div>" +
                           "<div class='address'>" + address + "</div></div>";

                infoWindow.setContent(desc);
                infoWindow.open(map, marker);
            });
        })(i, marker);
    }
}

function initialize() {

    latitude  = 24.80481147653668;
    longitude = -107.39376068115234;

    var mapOptions = {
        zoom:       13,
        center:     new google.maps.LatLng(latitude, longitude),
        mapTypeId:  google.maps.MapTypeId.ROADMAP
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