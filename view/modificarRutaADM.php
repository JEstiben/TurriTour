<?php
include '../public/header.php';
?>
<!-- Contenido -->
<div class="about">
	<div class="container">
		<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em;">
			<div class="col-md-offset-1 col-md-10">
				<div class="col-md-12" style="text-align: center;">
					<h2>Modificar Ruta</h2>
				</div>				
				<div class="col-md-12" style="text-align: center;">
					<div class="col-md-3" style="text-align: center;">
							<label>Punto Partida:</label>
							<select class="form-control" type="text" name="lat" id="lat">
							<option>Lugar Atractivo 1</option>
							<option>Lugar Atractivo 2</option>
							<option>Lugar Atractivo 3</option>
						</select>
							<label>Punto Destino:</label>
							<select class="form-control" type="text" name="lat" id="lat">
							<option>Lugar Atractivo 1</option>
							<option>Lugar Atractivo 2</option>
							<option>Lugar Atractivo 3</option>
						</select>
							<label>Duracion:</label>
							<input class="form-control" type="text" name="lon" id="lon" placeholder="00:12:00">
							<label>Distancia:</label>
							<input class="form-control" type="text" name="lon" id="lon" placeholder="2 km">
					</div>
					<form>
						<div class="col-md-offset-1 col-md-4" style="text-align: center;">
						<label>Sitios Cercanos</label>
						<select class="form-control" type="text" name="lat" id="lat">
							<option>Atractivo 1</option>
							<option>Atractivo 2</option>
							<option>Atractivo 3</option>
						</select>
						<select class="form-control" type="text" name="lat" id="lat">
							<option>Atractivo 1</option>
							<option>Atractivo 2</option>
							<option>Atractivo 3</option>
						</select>
					</div>
					</form>					
					<div class="col-md-offset-1 col-md-3" style="text-align: center;">
						<input type="button" value="Agregar" name="iagregar" id="agregar" class="btn btn-success"/>
						<input type="button" value="Eliminar" name="eliminar" id="eliminar" class="btn btn-success"/>
						<input type="button" value="Guardar" name="guardar" id="guardar" class="btn btn-success"/>
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