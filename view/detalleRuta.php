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
				<div class="col-md-offset-3 col-md-6">
					<img style="max-width: 100%;" src="../images/ruta.png">
				</div>
				<div class="col-md-12" style="text-align: center;">
					<h2>Distancia: 10 KM - Duraci&oacute;n: 20 MIN</h2>
					<h2>Destino: <a href="detallesAtractivo.php">Monumento Guayabo</a></h2>
					<div class="col-md-offset-2 col-md-3" style="text-align: center;">
						<form id="form" method="POST" enctype="multipart/form-data" action="AtractivosCercanos.php">
							<input type="hidden" name="ruta" value="">
							<input type="submit" value="Atractivos cercanos" name="atractivos" id="atractivos" class="btn btn-success"/>
						</form>
					</div>
					<div class="col-md-offset-2 col-md-3" style="text-align: center;">
						<form id="form" method="POST" enctype="multipart/form-data" action="visualizar.php">
							<input type="hidden" name="ruta" value="">
							<input type="submit" value="Visualizar ruta" name="visualizar" id="visualizar" class="btn btn-success"/>
						</form>
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