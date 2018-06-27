<?php
include '../public/header.php';
?>

<?php
    include '../business/atractivoBusiness/atractivoBusiness.php';

    $atractivoBusiness = new atractivoBusiness();
    $atractivo = $atractivoBusiness->obtenerAtractivoId($_POST["idAtractivo"]);
?>

<!-- Contenido -->
<div class="about">
	<div class="container">
		<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em;">
			<div class="col-md-offset-1 col-md-10">
				<div class="col-md-12" style="text-align: center;">
					<h2>Modificar Atractivo Turístico</h2>
				</div>
				<div class="col-md-offset-3 col-md-6">
					<h2>
                    	<div id="map"></div>
                    	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1JuYmoq83Om5mLz0qyg_k1viClteC2NU&callback=initMap"></script>
                	</h2>
				</div>
				
				<div class="col-md-12" style="text-align: center;">
					<div class="col-md-3" style="text-align: center;">
							<label>Atractivo</label>
							<?php
                                echo '<input class="form-control" type="text" name="lugar" id="lugar" value="'.$atractivo->getNombreAtractivo().'" disabled>';
                            ?>
							<label>Latitud</label>
							<input class="form-control" type="text" name="lat" id="lat" disabled>
							<label>Longitud</label>
							<input class="form-control" type="text" name="lon" id="lon" disabled>
					</div>
					<div class="col-md-offset-1 col-md-4" style="text-align: center;">
						<label>Tipo Camino</label>
                        <select id="tipo_camino" name="tipo_camino" class="form-control">
                            <option selected="true" value="Asfalto">Asfalto</option>
                            <option value="Piedra">Piedra</option>
                            <option value="Tierra">Tierra</option>
                        </select>
						<label>Imagen</label>
						<div class="fileUpload btn btn-success" style="text-align: center;">
						    <span>Subir imagen</span>
						    <input type="file" name="imagen" id="imagen" class="upload" accept="image/jpeg"/>
						</div>
						<label>Link video</label>
						<input class="form-control" type="text" name="video" id="video">
						<input type="button" value="Guardar" name="guarda" id="guarda" onclick="modificar();" class="btn btn-success"/>
					</div>
					<div class="col-md-offset-1 col-md-3" style="text-align: center;">
						<label>Descripci&oacute;n</label>
						<textarea class="form-control" rows="7" name="descripcion" id="descripcion"></textarea>
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

    function modificar() {
      	var formData = new FormData(document.getElementById("formulario"));
      	formData.append("crearAtractivo", "crearAtractivo");
      	formData.append("latitud", document.getElementById("latitud").value);
      	formData.append("longitud", document.getElementById("longitud").value);
      	$.ajax({
		    url: '../business/atractivoBusiness/atractivoAction.php',
            type: "POST",
		    dataType: "html",
		    data: formData,
		    cache: false,
		    contentType: false,
		    processData: false
		})
	    .done(function(data){
	    	if(data == "true"){
                mostrarMensaje("success", "Éxito al crear el atractivo.");
            }else if(data == "false"){
                mostrarMensaje("error", "Error al crear el atractivo.");
            }else if(data == "error"){
                mostrarMensaje("error", "El formato de la imagen es incorrecto.");
            }//if-else
	    });
    }//guardar

    function mostrarMensaje(estado,mensaje){
        if(estado === "success"){
            reset();
            alertify.success(mensaje);
            return false;
        }else if(estado === "error"){
            reset();
            alertify.error(mensaje);
            return false;
        }//if-else
    }//mostrarMensaje

    /*FUNCION QUE LIMPIA EL ESPACIO PARA COLOCAR LAS NOTIFICACIONES*/
    function reset () {
        $("#toggleCSS").attr("href", "../js/alertify.default.css");
        alertify.set({
            labels : {
                ok     : "OK",
                cancel : "Cancel"
            },
            delay : 5000,
            buttonReverse : false,
            buttonFocus   : "ok"
        });
    }//reset
</script>