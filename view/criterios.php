<?php
include '../public/header.php';
include '../business/atractivoBusiness.php';
?>
<!--Scripts para hacer uso de máscaras-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script src="jquery.min.js" type="text/javascript"></script>
<script src="./jquery-3.2.1.js"></script>

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
							<a href="obtenerRuta.php">
								<input type="button" value="Ver Rutas" name="rutas" id="rutas" class="btn btn-accept" src="obtenerRutaADM.php" />
							</a>
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
          zoom: 13
        });
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
              map.setZoom(13);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
              map.setCenter(marker.position);
              infowindow.setContent('Usted está aquí: '+results[0].formatted_address);
              infowindow.open(map, marker);
              ubicacion = results[0].formatted_address;//******************************************UBICACIÓN DEL USUARIO
              document.getElementById('datos').value = ubicacion;
            } else {
              window.alert('No se encontraron resultados');
            }
          } else {
            window.alert('Falla en el geolocalizador de Google: ' + status);
          }
        });
      }//geocodeLatLng

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1JuYmoq83Om5mLz0qyg_k1viClteC2NU&callback=initMap">
    </script>