
var map;
function initMap() {
map = new google.maps.Map(document.getElementById('map'), {
  center: {lat: -34.789288, lng: -58.523531},
  zoom: 13
});

var uluru = {lat: -34.789288, lng: -58.523531};

var marker = new google.maps.Marker({
  position: uluru,
  map: map
});



}


