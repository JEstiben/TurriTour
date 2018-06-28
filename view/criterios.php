<?php
include '../public/header.php';
include '../business/atractivoBusiness.php';
?>
<!--Scripts para hacer uso de máscaras-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script src="../jquery.min.js" type="text/javascript"></script>
<script src="jquery-3.2.1.js"></script>

<!--Obtención de los atractivos-->
	<?php
		$atractivoB = new atractivoBusiness();
		
		//Datos de atractivos que se van a necesitar para generar las rutas en el script
		$atractivos = $atractivoB->obtenerAtractivo();
		$cadenaAtractivos = "";
		foreach ($atractivos as $atractivoActual) {
			$cadenaAtractivos .= $atractivoActual->getIdAtractivo().'-'.
								 $atractivoActual->getNombreAtractivo().'-'.
								 $atractivoActual->getTipoCaminoAtractivo().';';
		}

	?>
<!--Obtención de los atractivos-->


<!-- Contenido -->
<div class="about">
	<div class="container">
		<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em;">
			<div class="col-md-offset-1 col-md-10">
				<div class="col-md-12" style="text-align: center;">
					<h2>Criterios de Búsqueda</h2>
				</div>				
				<div class="col-md-12" style="text-align: center;">
					<h1>
				    	<div id="map"></div>				                    	
				    </h1>
				
					<br><br>
					<div class="col-md-6" style="text-align: center;">
							<br>
							<label>Ingrese la distancia mínima del recorrido:</label>
							<br><br><br>
							<label>Ingrese la cantidad de tiempo que desea que desea durar durante el viaje:</label>							
							<br><br><br>
							<label>Seleccione el tipo de camino que desea transitar:</label>							
							<!--<a href="obtenerRuta.php">-->
							<input type="submit" id="rutas" value="Cargar Ruta" class="btn btn-accept">
								<!--<input type="button" value="Ver Rutas" name="rutas" id="rutas" class="btn btn-accept" src="obtenerRutaADM.php" />-->
							<!--</a>-->
					</div>					
					<div class="col-md-6" style="text-align: center;">
						<input class="form-control" type="text" name="distancia" id="distacia" placeholder="01.0KM">
						<script type="text/javascript">
    						$("#distacia").mask("00.0KM");
    					</script>
						<br>						
						<input class="form-control" type="text" name="tiempo" id="tiempo" placeholder="00:00Hrs">	
						<script type="text/javascript">
    						$("#tiempo").mask("00:00Hrs");
    					</script>
    					<br>	
    					<select id="terreno" name="terreno" class="form-control">
    					<?php
    						//Manejo de los tipos de terreno y mostrarlos en la vista
    						$terrenos = $atractivoB->obtenerTiposTerreno();
    						foreach ($terrenos as $terrenoActual) {
    							echo '<option  value='.$terrenoActual.'>'.$terrenoActual.'</option>';
    						}
    					?>
    					</select>

    					<a href="obtenerAtractivo.php">
						<input type="button" value="Ver Atracivos" name="atractivos" id="atractivos" class="btn btn-accept"/>
						</a>
						<br><br><br><br>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contenido -->
<?php
include '../public/footer.php';
?>
<script>
	var ubicacion = "";//**UBICACIÓN DEL USUARIO
      
      var map, infoWindow, geocoder;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 15
        });

        var directionsService = new google.maps.DirectionsService;
      	var directionsDisplay = new google.maps.DirectionsRenderer;
        infoWindow = new google.maps.InfoWindow;
        geocoder = new google.maps.Geocoder;



        // Aquí se obtiene la ubicación del usuario
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var latitudString = pos.lat + "," + pos.lng;
            geocodeLatLng(geocoder, map, infoWindow, latitudString);

            //
            directionsDisplay.setMap(map);
            document.getElementById('rutas').addEventListener('click', function() {
          llamadoCalcular(directionsService, directionsDisplay);
        });

          });
      }
  }//init map

  		//método que se encarga de mostrar la ubicación del usuario en el mapa
      function geocodeLatLng(geocoder, map, infowindow, latitudString) {
        var latlngStr = latitudString.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              map.setZoom(15);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
              map.setCenter(marker.position);
              infowindow.setContent('Usted está aquí:'+results[0].formatted_address);
              infowindow.open(map, marker);
              ubicacion = results[0].formatted_address;//******************************************UBICACIÓN DEL USUARIO
              
            } else {
              window.alert('No se encontraron resultados');
            }
          } else {
            window.alert('Falla en el geolocalizador de Google: ' + status);
          }
        });
      }//geocodeLatLng

      function llamadoCalcular(directionsService, directionsDisplay){
      	//obtener los atractivos y generar el arreglo
      	var rutasParaEuclides = [];
      	var distanciaRuta;
      	var tiempoRuta;

      	//obtencion de la cadena de atractivos en php
      	var atractivosPHP = "<?php echo $cadenaAtractivos; ?>";
      	atractivosPHP = atractivosPHP.slice(0, -1);//saco el último ";"
      	var atractivosUnoPorUno = atractivosPHP.split(";");//aquí tengo los atractivos separando los valores por un "-"

      	var atractivoActual;
      	for(var j=0; j<atractivosUnoPorUno.length; j++){//teniendo los atributos todos "id-nombre-tipocamino" se crea cada uno por separado
      		atractivoActual = atractivosUnoPorUno[j].split("-");
      		//ID = atractivoActual[0]
      		//Nombre = atractivoActual[1]
      		//TipoTerreno = atractivoActual[2]
      		//alert("Wasa"+j);
      		calculateAndDisplayRoute(directionsService,directionsDisplay,atractivoActual);
      		

      	}//for que recorre todos los atractivos
      	//alert("Finichin");
      }

      //función encargada de calcular las distancias y los tiempos y mandarlos a guardar
      function calculateAndDisplayRoute(directionsService, directionsDisplay, atractivoActual) {
      		
        directionsService.route({
          origin: ubicacion,
          destination: atractivoActual[1],
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
        	//alert("Id: "+atractivoActual[0] + "*** Nombre: "+atractivoActual[1] +" ***Ubicacion: "+ubicacion);
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];

            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              
              //calculo de los valores para las rutas
              distanciaRuta = route.legs[i].distance.value;//esto viene en metros se tiene que dividir entre 1000 para tener los kms
              tiempoRuta = route.legs[i].duration.value;//esto viene en minutos y se tiene que dividr entre 60 para obtener las horas
              //sleep(2000);
              alert("Id: "+atractivoActual[0] + "*** Nombre: "+atractivoActual[1] +" ***Ubicacion: "+ubicacion+ " ***Distancia: "+distanciaRuta + " ***Tiempo: "+ tiempoRuta);
              //enviar a insertar.

              tiempoRuta = tiempoRuta/60;
              distanciaRuta = distanciaRuta/1000;              	

              var rutaEuclides = {
                "crearRuta" : 'crearRuta',
                "id" : atractivoActual[0],
                "puntoinicial" : ubicacion,
                "puntofinal" : atractivoActual[1],
                "tiempo" : tiempoRuta,
                "distancia" : distanciaRuta,
                "tipocamino" : atractivoActual[2]
            };

            $.post("../business/rutaAction.php",rutaEuclides, function(data){ });

            }
          } else {
          // === if we were sending the requests to fast, try this one again and increase the delay
          if (status == google.maps.GeocoderStatus.OVER_QUERY_LIMIT) {
            delay++;
          } else {
            var reason="Code "+status;
            var msg = 'address="' + search + '" error=' +reason+ '(delay='+delay+'ms)<br>';
            document.getElementById("messages").innerHTML += msg;
          }   
        }
        });
    
      }//calculateAndDisplayRoute

      function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}//sleep

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1JuYmoq83Om5mLz0qyg_k1viClteC2NU&callback=initMap">
    </script>