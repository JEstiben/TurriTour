<?php
include '../public/header.php';
?>
<!--Scripts para hacer uso de máscaras-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>


<!-- Contenido -->
<div class="about">
	<div class="container">
		<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em;">
			<div class="col-md-offset-1 col-md-10">
				<div class="col-md-12" style="text-align: center;">
					<h2>Criterios de Búsqueda</h2>
				</div>				
				<div class="col-md-12" style="text-align: center;">
					<br><br>
					<div class="col-md-6" style="text-align: center;">
							<br>
							<label>Ingrese la distancia mínima del recorrido:</label>
							<br><br><br>
							<label>Ingrese la cantidad de tiempo que desea que desea durar durante el viaje:</label>							
							<br>
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
<script type="text/javascript">
	$(document).ready(function () {
        initMap();
    });

	function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 9.9062623, lng: -83.68420470000001},
            zoom: 15
        });
        var geocoder = new google.maps.Geocoder();
        if(document.getElementById('lugar').value != ""){
        	geocodeAddress(geocoder, map);
        }
      }

	function geocodeAddress(geocoder, resultsMap) {
        var lugar = document.getElementById('lugar').value;

        geocoder.geocode({'address': lugar}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });            
            document.getElementById("lat").value = results[0].geometry.location.lat();
            document.getElementById("lon").value = results[0].geometry.location.lng();

          } else {
            alert('La localización no fue satisfactoria por la siguiente razón: ' + status);
          }
        });
      }
</script>