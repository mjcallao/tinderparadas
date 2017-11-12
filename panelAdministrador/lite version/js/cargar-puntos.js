/*function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-33.863276, 151.207977),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }*/

function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
	  // Especifica el lugar donde inicia el Google Maps, deberia ser la ubicacion del usuario.
	  center: {lat: -34.789288, lng: -58.523531},
	  zoom: 13,
	  mapTypeControlOptions: {
	    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
	  }
	});


	// Para pedir ubicacion.
	// Descomentar!
	/*
	if (navigator.geolocation) {
	      navigator.geolocation.getCurrentPosition(function(position) {
	        var pos = {
	          lat: position.coords.latitude,
	          lng: position.coords.longitude
	        };
	        map.setCenter(pos);
	      });
	    } else {
	      handleLocationError(false, map.getCenter());
	    }
    */

    // Array hardcodeado de puntos.	Tendria que traerlos de la BDD.
	var locations = [	
	{id:"loc1", lat: -34.789288, lng: -58.523531, tipo: "Banco", nombre:"El banco de carlitos"},
	{id:"loc2", lat: -34.781, lng: -58.52359, tipo:"Banco", nombre:"Banco Ciudad"},
	{id:"loc3", lat: -34.7899, lng: -58.52359, tipo:"Plaza", nombre:"Plaza 25 de mayo"}
	]

	// Recorre array de marcadores y los setea en el mapa.
	/*
	var markers = locations.map(function(location) {
	  return new google.maps.Marker({
	    position: location    
	  });
	});
	*/
	var infoWindow = new google.maps.InfoWindow;


	// Funcion que recorre la lista de locaciones y las pone en el mapa. Muy customizable.
	locations.forEach(function(location){
		console.log(location);
		var point = new google.maps.LatLng(
            location.lat, location.lng
            );
		var infowincontent = document.createElement('div');
		var strong = document.createElement('strong');
		strong.textContent = location.nombre;
		infowincontent.appendChild(strong);

		var marker = new google.maps.Marker({
		map: map,
		position: point
		});

		marker.addListener('click', function() {
		infoWindow.setContent(infowincontent);
		infoWindow.open(map, marker);
		});
	});

	// Trae la forma que va a tener el icono de cluster.
	/*
	var markerCluster = new MarkerClusterer(map, markers,
	    {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
	*/

}











