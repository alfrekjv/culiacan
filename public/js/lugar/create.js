$(document).ready(function() {

    $('#ciudad').live('change',function(e) {

        var url = ppi.baseUrl + 'admin/lugar/updateColonias/' + $(this).val();

        $.get(url, function(response) {
            $('#colonia').html(response.content);
        }, 'json');
    });


    var culiacan = new google.maps.LatLng(24.80485, -107.385498);
	var marker;
	var map;

	function initialize() {
	  var mapOptions = {
	    zoom: 13,
	    mapTypeId: google.maps.MapTypeId.ROADMAP,
	    center: culiacan
	  };

	  map = new google.maps.Map(document.getElementById('map-canvas'),
	          mapOptions);

	  marker = new google.maps.Marker({
	    map:map,
	    draggable:true,
	    animation: google.maps.Animation.DROP,
	    position: culiacan
	  });
	  google.maps.event.addListener(marker, 'click', toggleBounce);
	  google.maps.event.addListener(marker, 'mouseup', cambiaCoordenada);
	}

	function toggleBounce() {

	  if (marker.getAnimation() != null) {
	    marker.setAnimation(null);
	  } else {
	    marker.setAnimation(google.maps.Animation.BOUNCE);
	  }
	}

	function cambiaCoordenada(){
		document.getElementById('lat').value = marker.getPosition().lat();
		document.getElementById('lng').value = marker.getPosition().lng();
	}
	google.maps.event.addDomListener(window, 'load', initialize);

});