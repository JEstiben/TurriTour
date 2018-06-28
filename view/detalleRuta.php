<?php
include '../public/header.php';
?>
<ol class="breadcrumb" style="border-radius: 0;">
	<li><a href="criterios.php">Rutas</a></li>
	<li><a href="obtenerRuta.php">Recomendaciones</a></li>
	<li class="active">Detalles</li>
</ol>

<?php
    include '../business/rutaBusiness.php';
    include '../business/atractivoBusiness.php';
    
    $rutaBusiness = new rutaBusiness();
    $ruta = $rutaBusiness->obtenerRutaId($_GET["id"]);

    $atractivoBusiness = new atractivoBusiness();
    $atrac = $atractivoBusiness->obtenerAtractivoespe($ruta->getTipoCamino());
?>

<!-- Contenido -->
<div class="about">
	<div class="container">
		<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em;">
			<div class="col-md-offset-1 col-md-10">
				<div class="col-md-12" style="text-align: center;">
					<?php
            echo '<h2>Ruta '.$ruta->getIdRuta().'</h2>';
          ?>
				</div>
				<div class="col-md-12">
					
				<div class="col-md-offset-1 col-md-5">
						<h1>
                    		<div id="map"></div>
                    		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1JuYmoq83Om5mLz0qyg_k1viClteC2NU&callback=initMap"></script>
                		</h1>
                	</div>

                	<div class="col-md-offset-2 col-md-4" style="text-align: center;">
						<h2> Distancia:</h2>
            <?php
                echo '<h2>'.$ruta->getDistancia().' KM</h2>';
            ?>
						<h2>Duraci&oacute;n:</h2>
						<?php
                echo '<h2>'.$ruta->getTiempo().' Hrs</h2>';
            ?>
            <h2>Destino: 
							<?php
                echo '<a href="detalleAtractivo.php?id='.$ruta->getIdRuta().'&origen=1">'.$ruta->getPuntoFinal().' </a>';
              ?>
						</h2>						
					</div>
          <div class="col-md-12" style="text-align: center;">
              <?php
              echo '<h1>Atractivos de interés</h1>';
                foreach ($atrac as $value) {
                   echo '<a href="detalleAtractivo.php?id='.$value->getIdAtractivo().'&origen=1"><img style="max-width: 150px; max-height: 150px; margin: 0.5em auto;" src="../images/atractivos/'.$value->getImagenAtractivo().'">                                          </a>';  
                }        
                echo '<input type="hidden" name="origen" id="origen" value="'.$ruta->getPuntoInicial().'" />';
                echo '<input type="hidden" name="destino" id="destino" value="'.$ruta->getPuntoFinal().'" />';
                ?>
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
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: 9.9062623, lng: -83.68420470000001}
        });
        directionsDisplay.setMap(map);

        calculateAndDisplayRoute(directionsService, directionsDisplay);
    }

	function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
        directionsService.route({
          origin: document.getElementById('origen').value,
          destination: document.getElementById('destino').value,
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
            var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
                  '</b><br>';
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
            }
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }

</script>