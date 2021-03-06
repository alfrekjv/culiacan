$(document).ready(function () {

    $('#ciudad').live('change', function (e) {
        var url = ppi.baseUrl + 'admin/lugar/updateColonias/' + $(this).val();

        $.get(url, function (response) {
            $('#colonia').html(response.content);
        }, 'json');
    });

    var position = new google.maps.LatLng($('#lat').val(), $('#lng').val()),
        marker,
        map;

    function initialize() {
        var mapOptions = {
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            center: position
        };

        map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);

        marker = new google.maps.Marker({
            map: map,
            animation: google.maps.Animation.DROP,
            position: position,
            draggable: true
        });
        google.maps.event.addListener(marker, 'click', toggleBounce);
        google.maps.event.addListener(map, 'click', function (event) {
            var latlng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
            moverMarcador(latlng);
        });
        google.maps.event.addListener(marker, 'mouseup', cambiaCoordenada);
    }

    function moverMarcador(latlng) {
        marker.setMap(null);
        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: latlng
        });
        cambiaCoordenada();
        google.maps.event.addListener(marker, 'mouseup', cambiaCoordenada);
    }

    function toggleBounce() {
        if (marker.getAnimation() != null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }

    function cambiaCoordenada() {
        document.getElementById('lat').value = marker.getPosition().lat();
        document.getElementById('lng').value = marker.getPosition().lng();
    }

    initialize();
});