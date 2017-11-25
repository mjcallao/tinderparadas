// Esta variable se suma por cada circulo que se agrega al mapa. Se usa para saber cual es el ID de un circulo nuevo. Temporal hasta que se cree del lado del servidor.
// Una funcion que lo devuelva al crearlo.
var idUnicoHardcodeado = 0;
lista

$(document).ready(function(){
	$("#formulario :input").attr("disabled", true);
	$("#botonCargarModificar").attr("disabled", true);

})

function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
	  // Especifica el lugar donde inicia el Google Maps, si el usuario acepta se va hasta su posicion.

	  // La facu.
	  center: {lat: -34.789288, lng: -58.523531},

	  // Casa Testing.
	  //center: {lat: -34.8145869, lng: -58.45},
	  zoom: 15,
	  mapTypeControlOptions: {
	    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
	  }
	});


	// Para pedir ubicacion.
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

	// Este Ajax deberia llamar una funcion que solo traiga la cascara de los datos!
	$.ajax({
	  dataType: "json",

	  // url que trae todos datos completos
	  url: "http://desarrolloupe.sytes.net:16333/cachengue/listar",

	  // url que trae los datos simples
	  // No trae los radios asi que uso el otro.
	  // url: "http://desarrolloupe.sytes.net:16333/cachengue/puntos",
	  data: null,
	  success: function(result){
	  	idUnicoHardcodeado = result.data.length+1;
	  	locations = result.data;
	  	// Recorro la lista de puntines
	  	locations.forEach(function(location){
	  		// Seteo latitud y longitud en la variable point
			var centro = new google.maps.LatLng(
            location.posX, location.posY
            );

            // Da forma al circulo y lo agrega al mapa.
			var cityCircle = new google.maps.Circle({
			strokeColor: '#FF0000',
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: '#FF0000',
			fillOpacity: 0.35,
			map: map,
			center: centro,
			// Hardcodeo el radio a 500 para que se vean en el mapa
			radius: parseInt(location.radio),
			//radius: 500,
			idCachengue:location.idCachengue
			});

		// Agrego al punto ciertas acciones.
		cityCircle.addListener('click', function() {
			// Esta funcion sirve para que solo se pueda arrastrar y editar un solo circulo a la vez.
			limpiarEditables();
			puntoAEditar.push(cityCircle);

			// Si habia creado un circulo nuevo sin guardar lo borra.
			limpiarCirculoActual();

			// aca le pasas el ID del punto a la funcion que lleva sus datos al editor.
			idUnico = location.idCachengue
			pedirDatosPuntos(idUnico);

			// Con esto lo haces dragabble	
			cityCircle.setDraggable(true);
			cityCircle.setEditable(true);

			$("#formulario :input").attr("disabled", false);
			$("#botonCargarModificar").attr("disabled", false);

			console.log(this.center.lat());
			console.log(this.center.lng());
			console.log(this.radius);

		});


	  	});
	  }
	});
}



// Cada vez que se clickea un caguenge sobre el mapa este pasa a estar dentro de la caja Editable.
// Con esta funcion si habia un circulo antes, se le quitan las propiedades editables a este y se vacia el array.
// Por lo general cuando las funciones quieren hacer editable un nuevo punto llaman a esta funcion y  despues ponen el punto a editar dentro. 
// Luego le asigan al punto editable las propiedades de edicion. Una vez que llaman a esta funcion se les quitan de vuelta.
var puntoAEditar = [];
function limpiarEditables()
{
	// La primera vez que se lo llama no va a tener ningun objeto dentro del array.
	if (puntoAEditar.length > 0){
		puntoAEditar[0].setDraggable(false);
		puntoAEditar[0].setEditable(false);
		puntoAEditar = [];
	}
}


// Solo sirve para llamar a la funcion que llena los inputs con los datos que traiga del servidor.
function pedirDatosPuntos(idUnico){
	$.ajax({
	  dataType: "json",
	  // Esto deberia ser una funcion que tome parametro ID y devuelva el resultado. Lo hago asi mientras tanto.
	  url: "http://desarrolloupe.sytes.net:16333/cachengue/listar/"+idUnico,
	  data: null,
	  success: function(result){
	  	completarDatos(result.data);
	  }
	});
}

// Llena los inputs.
function completarDatos(location){
	$("#botonCargarModificar").html("Modificar");
	$("#botonCargarModificar").removeClass("btn-danger");
	$("#botonCargarModificar").addClass("btn-warning");

	$("#checkboxActiva").prop('checked', location.activa);
	$("#inputNombre").val(location.nombre);
	$("#selectTipo").val(location.tipo);

	// Se setean los dias en base al numero binario guardado.	
	if (location.diasActivo[0] == undefined || location.diasActivo[0] == 0){
		var ln = false;
	}else{
		var ln = location.diasActivo[4];
	}

	if (location.diasActivo[1] == undefined || location.diasActivo[1] == 0){
		var mt = false;
	}else{
		var mt = location.diasActivo[4];
	}

	if (location.diasActivo[2] == undefined || location.diasActivo[2] == 0){
		var mc = false;
	}else{
		var mc = location.diasActivo[4];
	}

	if (location.diasActivo[3] == undefined || location.diasActivo[3] == 0){
		var jv = false;
	}else{
		var jv = location.diasActivo[4];
	}

	if (location.diasActivo[4] == undefined || location.diasActivo[4] == 0){
		var vr = false;
	}else{
		var vr = location.diasActivo[4];
	}

	if (location.diasActivo[5] == undefined || location.diasActivo[5] == 0){
		var sb = false;
	} else{
		var sb = location.diasActivo[5];
	}

	if (location.diasActivo[6] == undefined || location.diasActivo[6] == 0){
		var dm = false;
	} else{
		var dm = location.diasActivo[6];
	}

	$("#checkboxLunes").prop('checked', ln);
	$("#checkboxMartes").prop('checked', mt);
	$("#checkboxMiercoles").prop('checked', mc);
	$("#checkboxJueves").prop('checked', jv);
	$("#checkboxViernes").prop('checked', vr);
	$("#checkboxSabado").prop('checked', sb);
	$("#checkboxDomingo").prop('checked', dm);

	$("#inputHoraInicio").val(location.horaIncio);

	$("#inputHoraFin").val(location.horaFin);
	
	$("#inputCajaComentario").val(location.comentario);

	$("#inputCantMinima").val(location.usuariosMinimos);

}

$("#agregarPunto").click(function(){
	limpiarEditables();
	$('#formulario').trigger("reset");
	$("#botonCargarModificar").html("Guardar");
	$("#botonCargarModificar").removeClass("btn-warning");
	$("#botonCargarModificar").addClass("btn-danger");
	$("#formulario :input").attr("disabled", false);
	$("#botonCargarModificar").attr("disabled", false);	
	crearNuevoPunto();
});

function crearNuevoPunto(){
	var cityCircle = new google.maps.Circle({
			strokeColor: '#0000FF',
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: '#0000FF',
			fillOpacity: 0.35,
			map: map,
			center: map.getCenter(),
			dragabble: true,
			editable: true,
			// Hardcodeo el radio a 500 para que se vean en el mapa
			// radius: location.radio
			radius: 30
			});

	cityCircle.addListener('click', function() {
			// Esta funcion sirve para que solo se pueda arrastrar y editar un solo circulo a la vez.
			limpiarEditables(cityCircle);
			puntoAEditar.push(cityCircle);
			// Con esto lo haces dragabble	
			cityCircle.setDraggable(true);
			cityCircle.setEditable(true);
		});

	// Quiero que cuando cree un nuevo limpie los editables anteriores y lo ponga a este en la lista de editables
	// Asi si se llama otra vez a esta funcion se limpian sus propiedades de edicion.
	limpiarEditables();
	puntoAEditar.push(cityCircle);

	// Esta funcion limpia si habia un circulo anterior nuevo sin guardar o editandose sin guardar.
	// Las funciones que guardan circulos nuevos o editados los remueven de esta lista al hacerlo.
	// Entonces al llamar a esta funcion no va a encontrar nada y por lo tanto no se van a eliminar.
	limpiarCirculoActual();
	circuloActual.push(cityCircle);
}

var circuloActual=[];
function limpiarCirculoActual(){
	if (circuloActual.length >0) {
		circuloActual[0].setMap(null);
		circuloActual=[];
	}
}

// Funcionamiento del boton Cargar que cambia de texto y color en el HTML.
$(document).ready(function(){
	$("#botonCargarModificar").click(function(){
		// Para que vea si tiene sentido tocar el boton.
		if (puntoAEditar.length > 0) 
		{
			// Esto pregunta si es uno nuevo. 
			// Lo pregunta sabe si circulo nuevo (cpuesto esta dentro del array puntoAEditar) no tiene ID.
			if(puntoAEditar[0].idCachengue==undefined)
			{
				//if (true)
				if (validarCampos()) 
				{
					// Preparo los datos para mandarlos a la BDD.

					// valor de nombre
					var nombre = $("#inputNombre").val();

					// Valor de posX y posY
					var posX = circuloActual[0].center.lat();
					var posY = circuloActual[0].center.lng();

					// Valor de Radio
					var radio = circuloActual[0].radius;

					// Valor de Activa
					if($("#checkboxActiva").prop('checked'))
					{
						var activa = 1;
					}
					else
					{
						var activa = 0;
					}

					// Valor de tipo
					var tipo = $("#selectTipo").val();

					// Valor de comentario
					var comentario = $("#inputCajaComentario").val();

					// Valor de dias
					var dias = ""
					if ($("#checkboxLunes").is(":checked")) {
						dias+="1";
					}else{
						dias+="0";
					}
					
					if ($("#checkboxMartes").is(":checked")) {
						dias+="1";
					}else{
						dias+="0";
					}

					if ($("#checkboxMiercoles").is(":checked")) {
						dias+="1";
					}else{
						dias+="0";
					}

					if ($("#checkboxJueves").is(":checked")) {
						dias+="1";
					}else{
						dias+="0";
					}

					if ($("#checkboxViernes").is(":checked")) {
						dias+="1";
					}else{
						dias+="0";
					}			
					
					if ($("#checkboxSabado").is(":checked")) {
						dias+="1";
					}else{
						dias+="0";
					}		

					if ($("#checkboxDomingo").is(":checked")) {
						dias+="1";
					}else{
						dias+="0";
					}				


					//Valor de horas
					var horaInicio = $("#inputHoraInicio").val();
					var horaFin = $("#inputHoraFin").val();

					//Valor usuariosMinimos
					var usuariosMinimos = $("#inputCantMinima").val();

					//Valor usuariosActivos
					var usuariosActivos = "0";					
					
					// Debug
					// var arraycosas = [nombre, posX, posY, radio, activa, tipo, comentario, dias, horaInicio, horaFin, usuariosMinimos, usuariosActivos];
					//console.log(arraycosas);

					if (validarRadio(circuloActual[0])) {
						cargarNuevoCachengue(nombre, posX, posY, radio, activa, tipo, comentario, dias, horaInicio, horaFin, usuariosMinimos, usuariosActivos);
						// Si funciona la carga lo cambia de color y le setea el ID por si hay que modificarlo.
						// Esto deberia hacerse con una respuesta del ajax pero no hay tiempo.
						circuloActual[0].set('strokeColor', "#FF0000");
						circuloActual[0].set('fillColor', "#FF0000");
						circuloActual[0].set("fillOpacity", "0.35");
						circuloActual[0].set("idUnico", idUnicoHardcodeado);

						// Esta variable se cuenta en base a cuantos puntos hay en el mapa actualmente, al agregar uno se le agrega un numero al ID unico. Ese va a ser el id 
						// Del proximo punto. Cambiar esto y hacerlo como la gente pls.
						idUnicoHardcodeado +=1;

						// Se le agregan funciones onClick que son las unicas que le faltan para ser un punto hecho y derecho.
		  				circuloActual[0].addListener('click', function() {
		  					pedirDatosPuntos(this.idUnico);
		  					limpiarCirculoActual();
		  				});
					}

				}
			}
			else
			{
				console.log("Es uno existente");
				$("#footerErrores").children().hide();
				$("#datosCargadosConExito").fadeIn();
				setTimeout(function(){
			    $("#datosCargadosConExito").fadeOut();
				},3000)
				return true;
			}
		}
	});
});

function validarCampos(){
	// Valida que el nombre sea unico.
	if (nombreExiste()){
		$("#footerErrores").children().hide(); 
		$("#nombreExistenteError").fadeIn();
		setTimeout(function(){
		$("#nombreExistenteError").fadeOut();
		},5000)
		return false;
	}

	// Valida que el nombre este bien ingresado.
	if (!$("#inputNombre").val()) {
		$("#footerErrores").children().hide(); 
		$("#nombreValidoError").fadeIn();
		setTimeout(function(){
		$("#nombreValidoError").fadeOut();
		},7000)
		return false;
	}

	// Regex tambien
	var reg = /^[A-Za-z0-9 ]{6,24}$/;
	var match = $("#inputNombre").val().match(reg);
	if (!match) {
		$("#footerErrores").children().hide(); 
		$("#nombreValidoError").fadeIn();
		setTimeout(function(){
		$("#nombreValidoError").fadeOut();
		},7000)
		return false;
	}

	// Valida que el tipo este bien ingresado.
	if (!$("#selectTipo").val()) {
		$("#footerErrores").children().hide(); 
		$("#seleccionValidaError").fadeIn();
		setTimeout(function(){
		$("#seleccionValidaError").fadeOut();
		},5000)
		return false;
	}

	// valida que al menos haya un dia chequeado.
	if($('#dias_semana input:checked').length == 0){
		$("#footerErrores").children().hide(); 
		$("#diasValidosError").fadeIn();
		setTimeout(function(){
		$("#diasValidosError").fadeOut();
		},5000)
		return false;
	}

	// Valida que la hora de Inicio y Fin esten ingresadas.
	if (!$("#inputHoraInicio").val() || !$("#inputHoraFin").val()){
		$("#footerErrores").children().hide(); 
		$("#horariosValidosError").fadeIn();
		setTimeout(function(){
		$("#horariosValidosError").fadeOut();
		},5000)
		return false;
	}

	if ($("#inputHoraInicio").val() > $("#inputHoraFin").val()){
		$("#footerErrores").children().hide(); 
		$("#horariosValidosError").fadeIn();
		setTimeout(function(){
		$("#horariosValidosError").fadeOut();
		},5000)
		return false;
	}
	
	// Validar cantidad minima.
	if(!$("#inputCantMinima").val()){
		$("#footerErrores").children().hide(); 
		$("#cantiMinimaValidaError").fadeIn();
		setTimeout(function(){
		$("#cantiMinimaValidaError").fadeOut();
		},5000)
		return false;
	}

	if($("#inputCantMinima").val() <= 0){
		$("#footerErrores").children().hide(); 
		$("#cantiMinimaValidaError").fadeIn();
		setTimeout(function(){
		$("#cantiMinimaValidaError").fadeOut();
		},5000)
		return false;
	}

	// Si esta todo bien no entra en ninguna excepcion, se muestra un mensaje de OK y se devuelve True.
	$("#footerErrores").children().hide();
	$("#datosCargadosConExito").fadeIn();
	setTimeout(function(){
    $("#datosCargadosConExito").fadeOut();
	},3000)
	return true;
}

function validarRadio(circulo){
	console.log(circulo);
	if (circulo.radius > 500) {
		$("#footerErrores").children().hide(); 
		$("#areaCirculoError").fadeIn();
		setTimeout(function(){
		$("#areaCirculoError").fadeOut();
		},5000)
		return false;
	}


	return false;
}

function nombreExiste(){
	return false;
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

function cargarNuevoCachengue(nombre, posX, posY, radio, activa, tipo, comentario, diasActivo, horaIncio, horaFin, usuariosMinimos, usuariosActivos){
	$.ajax({
	  type: "POST",
	  url: "http://desarrolloupe.sytes.net:16333/cachengue/guardar",
	  data: 
	  {
	  	"nombre":nombre,
	  	"posX":posX,
	  	"posY":posY,
	  	"radio":radio,
	  	"activa":activa,
	  	"tipo":tipo,
	  	"comentario":comentario,
	  	"diasActivo":diasActivo,
	  	"horaIncio":horaIncio,
	  	"horaFin":horaFin,
	  	"usuariosMinimos":usuariosMinimos,
	  	"usuariosActivos":usuariosActivos
	  },
	  success: function(result){
	  	circuloActual=[];	  	
	  },
	  error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
        console.log(xhr.responseText);
      }
	});
}















