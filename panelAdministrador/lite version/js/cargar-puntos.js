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
	{id:"loc1", lat: -34.789288, lng: -58.523531, radio: 15, tipo: "Banco", nombre:"El banco de carlitos"},
	{id:"loc2", lat: -34.781, lng: -58.52359, radio: 15, tipo:"Banco", nombre:"Banco Ciudad"},
	{id:"loc3", lat: -34.7899, lng: -58.52359, radio: 15, tipo:"Plaza", nombre:"Plaza 25 de mayo"}
	]

	// Creo un array vacio que voy a llenar con las ubicaciones ya formateadas.
	var markers = [];

	// Crea ventana customizable de Google para setearsela a cada ubicacion.
	var infoWindow = new google.maps.InfoWindow;

	// Funcion que recorre la lista de locaciones. Muy customizable.
	locations.forEach(function(location){

		// Seteo latitud y longitud en la variable point
		var centro = new google.maps.LatLng(
            location.lat, location.lng
            );

		// Creo el cartelito arriba de cada punto y le pongo el nombre.
		var infowincontent = document.createElement('div');
		var strong = document.createElement('strong');
		strong.textContent = location.nombre;
		infowincontent.appendChild(strong);

		var cityCircle = new google.maps.Circle({
      	  strokeColor: '#FF0000',
	      strokeOpacity: 0.8,
	      strokeWeight: 2,
	      fillColor: '#FF0000',
	      fillOpacity: 0.35,
	      map: map,
	      center: centro,
	      radius: location.radio
	    });


		// Agrego el objeto al array makers para clusterizarlo despues
		markers.push(cityCircle);

		// Agrego al punto una accion.
		cityCircle.addListener('click', function() {
		infoWindow.setContent(infowincontent);
		infoWindow.open(map, cityCircle);
		});

	});


		/*

		// Seteo latitud y longitud en la variable point
		var point = new google.maps.LatLng(
            location.lat, location.lng
            );

		// Creo el cartelito arriba de cada punto y le pongo el nombre.
		var infowincontent = document.createElement('div');
		var strong = document.createElement('strong');
		strong.textContent = location.nombre;
		infowincontent.appendChild(strong);

		// Instancio un nuevo objeto de punto y lo pongo en el mapa.
		var marker = new google.maps.Marker({
		map: map,
		position: point
		});

		// Agrego el objeto al array makers para clusterizarlo despues
		markers.push(marker);

		// Agrego al punto una accion.
		marker.addListener('click', function() {
		infoWindow.setContent(infowincontent);
		infoWindow.open(map, marker);
		});
	});

	// Crea una clusterizacion de datos y le setea la imagen que va a tener.
	var markerCluster = new MarkerClusterer(map, markers,
	    {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

	*/

}











