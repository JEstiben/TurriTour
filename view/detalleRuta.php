<?php
include '../public/header.php';
?>
<ol class="breadcrumb" style="border-radius: 0;">
	<li><a href="criterios.php">Rutas</a></li>
	<li><a href="obtenerRuta.php">Recomendaciones</a></li>
	<li class="active">Detalles</li>
</ol>
<!-- Contenido -->
<div class="about">
	<div class="container">
		<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em;">
			<div class="col-md-offset-1 col-md-10">
				<div class="col-md-12" style="text-align: center;">
					<h2>Ruta 2</h2>
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
						<br>
						<h2>Duraci&oacute;n:</h2>
						<br>
						<h2>Destino: 
							<a href="detallesAtractivo.php?">Monumento Guayabo</a>
						</h2>						
						<div class="col-md-12" style="text-align: center;">
							<form id="form" method="POST" enctype="multipart/form-data" action="AtractivosCercanos.php">
								<a href="detalleRuta.php">
									<img style="max-width: 100%; margin: 0.5em auto;" src="../images/ruta1.png">
								</a>
							</form>
						</div>
						
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

        document.getElementById('submit').addEventListener('click', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
    }

	function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
            waypts.push({
              location: "Universidad de Costa Rica, Sede del Atlántico, Provincia de Cartago, Turrialba",
              stopover: true
            });
            waypts.push({
              location: "Parque Quesada Casal, Calle 1, Provincia de Cartago, Turrialba",
              stopover: true
            });
        directionsService.route({
          origin: "Turrialba, Provincia de Cartago",
          destination: "Monumento Nacional Guayabo, Provincia de Cartago, Turrialba",
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