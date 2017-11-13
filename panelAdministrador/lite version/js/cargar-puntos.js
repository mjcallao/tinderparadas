function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
	  // Especifica el lugar donde inicia el Google Maps, si el usuario acepta se va hasta su posicion.
	  //center: {lat: -34.789288, lng: -58.523531},
	  center: {lat: -34.8145869, lng: -58.4702204},
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

	// Este Ajax deberia llamar una funcion que solo traiga la cascara de los datos!
	$.ajax({
	  dataType: "json",
	  url: "http://www.sucursal24.com/emanuel/apirest/cachengue/listar",
	  data: null,
	  success: function(result){
	  	locations = result.data;
	  	// Recorro la lista de puntines
	  	locations.forEach(function(location){
	  		// Seteo latitud y longitud en la variable point
			var centro = new google.maps.LatLng(
            location.posX, location.posY
            );

            // Da forma al circulo
			var cityCircle = new google.maps.Circle({
			strokeColor: '#FF0000',
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: '#FF0000',
			fillOpacity: 0.35,
			map: map,
			center: centro,
			// Hardcodeo el radio a 500 para que se vean en el mapa
			// radius: location.radio
			radius: 500
			});

		// Agrego al punto una accion.
		cityCircle.addListener('click', function() {
			idUnico = location.idCachengue
			pedirDatosPuntos(idUnico);
		});


	  	});
	  }
	});

	// Creo un array vacio que voy a llenar con las ubicaciones ya formateadas.
	var markers = [];

	// Crea ventana customizable de Google para setearsela a cada ubicacion.
	var infoWindow = new google.maps.InfoWindow;
}

function pedirDatosPuntos(idUnico){
	$.ajax({
	  dataType: "json",
	  // Esto deberia ser una funcion que tome parametro ID y devuelva el resultado. Lo hago asi mientras tanto.
	  url: "http://www.sucursal24.com/emanuel/apirest/cachengue/listar/",
	  data: null,
	  success: function(result){
	  	datosLocacion = result.data
	  	datosLocacion.forEach(function(location){
	  		if(location.idCachengue == idUnico){
	  			completarDatos(location);
	  		}
	  	});	
	  }
	});
}

function completarDatos(location){
	$("#botonCargarModificar").html("Modificar");
	$("#botonCargarModificar").removeClass("btn-danger");
	$("#botonCargarModificar").addClass("btn-warning");

	$("#checkboxActiva").prop('checked', location.activa);
	$("#inputNombre").val(location.nombre);
	$("#selectTipo").val(location.tipo);

	// Faltan los dias de semana. Quedan hardcodeados hasta que este.
	$("#checkboxLunes").prop('checked', true);
	$("#checkboxMartes").prop('checked', true);
	$("#checkboxMiercoles").prop('checked', true);
	$("#checkboxJueves").prop('checked', true);
	$("#checkboxViernes").prop('checked', true);

	var horaInicio = location.horaIncio.slice(0,2)+":"+location.horaIncio.slice(2,4);
	$("#inputHoraInicio").val(horaInicio);

	var horaFin = location.horaFin.slice(0,2)+":"+location.horaFin.slice(2,4);
	$("#inputHoraFin").val(horaFin);
	
	$("#inputCajaComentario").val(location.comentario);

	$("#inputCantMinima").val(location.usuariosMinimos);

}


		// Esto funcionaba si los puntos eran puntos y no areas. Si son areas no anda.

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












