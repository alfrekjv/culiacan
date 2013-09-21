$(document).ready(function() 
{
  google_maps();
  $('#mapa-canvas').height($('body').height());
});
google_maps = function() {
  var map;
  function initialize() 
  {
    var mapOptions = {
      zoom: 8,
      center: new google.maps.LatLng(-34.397, 150.644),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('mapa-canvas'), mapOptions);
  }
  google.maps.event.addDomListener(window, 'load', initialize);
}