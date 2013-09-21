(function () {

    window.onload = function () {

        // Creando las opciones del mapa
        var options = {
            zoom: 6,
            center: new google.maps.LatLng(36.1834, -117.4960),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        // creando el mapa
        var map = new google.maps.Map(document.getElementById("map"), options);
    };
})();

