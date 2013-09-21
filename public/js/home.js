var map = null,
    latitude = null,
    longitude = null,
    infoWindow = null,
    geocoder = null,
    markersArray = [];

$(document).ready(function () {

    $('#mapa-canvas').height($('body').height());

    $('.nav.nav-pills a').click(function (e) {

        e.preventDefault();
        map.clearOverlays();

        var type = $(this).data('tipo');

        $.getJSON(ppi.baseUrl + 'lugares/' + type + '.json', function (spots) {
            addMarkerFromCat(spots, type);
        });

    });

    initialize();
    placeSpotsOnMap();

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

        latitude  = 24.80481147653668;
        longitude = -107.39376068115234;

        var mapOptions = {
            zoom: 13,
            center: new google.maps.LatLng(latitude, longitude),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById('mapa-canvas'), mapOptions);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
}

google.maps.Map.prototype.clearOverlays = function () {
    if (markersArray) {
        for (var i = 0; i < markersArray.length; i++) {
            markersArray[i].setMap(null);
        }
    }
}
