var map = null,
    latitude = null,
    longitude = null,
    infoWindow = null,
    geocoder = null,
    markersArray = [];

$(document).ready(function () {

    $('#mapa-canvas').height($('body').height());

    $('#btn-municipios .dropdown-menu').on('click', 'a', function (event)
    {
      event.preventDefault();
      var $parent = $(this).closest('#btn-municipios');
      var $btn = $parent.find('button');
      var $prev = $parent.find('li.active');
      $prev.toggleClass('active');
      var $next = $(this).parent().addClass('active');
      $parent.toggleClass('open');
      $btn.find('.text').text($next.find('a').text());
      return false;
    });
    
    $('#modal-directorio').on('shown.bs.modal', function () {
        $('a[data-toggle=tooltip]').tooltip();
    })

    $('.nav.nav-pills a').click(function (e) {

        e.preventDefault();
        map.clearOverlays();

        var type = $(this).data('tipo');

        $.getJSON(ppi.baseUrl + 'lugares/' + type + '.json', function (spots) {
            addMarkerFromCat(spots, type);
        });

    });

    //check if the geolocation object is supported, if so get position
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {

            latitude   = position.coords.latitude;
            longitude  = position.coords.longitude;
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(latitude, longitude),
                map:      map,
                title:    'Tu estas aqui',
                // icon:     'images/gpspoint.png',
                animation:google.maps.Animation.DROP
            });

            google.maps.event.addListener(marker, 'click', function () {

                // Verifica si la ventana ya existe, no vuelve a crear una nueva.
                if (!infoWindow) {
                    infoWindow = new google.maps.InfoWindow();
                }

                var desc = "<h2>You are Here</h2>";

                infoWindow.setContent(desc);
                infoWindow.open(map, marker);
            });

            placeSpotsOnMap();

        }, function (e) {
            useDefaultLocation();
        });
    } else {
        // browser don't support geo.
        useDefaultLocation();
    }

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

    initialize();

});

function placeSpotsOnMap() {

    // Place Spots on the Map
    $.getJSON(ppi.baseUrl + 'lugares/centros.json', function (spots) {
        addMarkerFromCat(spots, 'centros');
    });

    $.getJSON(ppi.baseUrl + 'lugares/evacuadas.json', function (spots) {
        addMarkerFromCat(spots, 'evacuadas');
    });

    $.getJSON(ppi.baseUrl + 'lugares/albergues.json', function (spots) {
        addMarkerFromCat(spots, 'albergues');
    });

    latlng = new google.maps.LatLng(latitude, longitude);
    map.setCenter(latlng);
    map.setZoom(14);

    $.getJSON(ppi.baseUrl + 'lugares/afectadas.json', function (spots) {
        addMarkerFromCat(spots, 'afectadas');
    });

    $.getJSON(ppi.baseUrl + 'lugares/agua.json', function (spots) {
        addMarkerFromCat(spots, 'agua');
    });

}

function addMarkerFromCat(category, catname) {

    var venues = category.data;

    for (i = 0; i < venues.length; i++) {


        var address  = venues[i].calle + " " + venues[i].numero + " " + venues[i].colonia + " " +
                       venues[i].ciudad + " " + venues[i].estado + " " + venues[i].pais;

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(venues[i].lat, venues[i].lng),
            map:      map,
            title:    venues[i].nombre,
            icon:     ppi.baseUrl + 'images/' + catname + '.png',
            animation:google.maps.Animation.DROP
        });

        markersArray.push(marker);

        // agregando Ventanas infoWindow
        (function (i, marker) {
            google.maps.event.addListener(marker, 'click', function () {

                // Verifica si la ventana ya existe, no vuelve a crear una nueva.
                if (!infoWindow) {
                    infoWindow = new google.maps.InfoWindow();
                }

                var desc = "<div class='title'>" + venues[i].nombre + "</div>";

                infoWindow.setContent(desc);
                infoWindow.open(map, marker);
            });
        })(i, marker);
    }
}

initialize = function () {

    function initialize() {

        var mapOptions = {
            zoom: 8,
            center: new google.maps.LatLng(-34.397, 150.644),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById('mapa-canvas'), mapOptions);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
}

function useDefaultLocation() {

    latitude  = 31.8391;
    longitude = -106.5631;

    placeSpotsOnMap();
}

google.maps.Map.prototype.clearOverlays = function () {
    if (markersArray) {
        for (var i = 0; i < markersArray.length; i++) {
            markersArray[i].setMap(null);
        }
    }
}
