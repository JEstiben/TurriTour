<?php
include '../public/header.php';
?>
<?php
	if(isset($_GET['origen'])){
?>
	<ol class="breadcrumb" style="border-radius: 0;">
		<li><a href="criterios.php">Rutas</a></li>
		<li><a href="obtenerRuta.php">Recomendaciones</a></li>
		<?php
			echo '<li><a href="detalleRuta.php?id='.$_GET['id'].'">Detalle ruta</a></li>';
		?>		
		<li class="active">Detalle atractivo</li>
	</ol>
<?php
	}else{
?>
	<ol class="breadcrumb" style="border-radius: 0;">
		<li><a href="criterios.php">Rutas</a></li>
		<li><a href="obtenerAtractivo.php">Atractivos</a></li>
		<li class="active">Detalle</li>
	</ol>
<?php
	}
?>

<?php
    include '../business/atractivoBusiness.php';

    $atractivoBusiness = new atractivoBusiness();
    $atractivo = $atractivoBusiness->obtenerAtractivoId($_GET["idAtr"]);
?>

<!-- Contenido -->
<div class="about">
	<div class="container">
		<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em;">
			<div class="col-md-offset-1 col-md-10">
				<div class="col-md-12" style="text-align: center;">
					<?php
						echo '<h2>'.$atractivo->getNombreAtractivo().'</h2>';
					?>
				</div>
				<div class="col-md-offset-3 col-md-6">
					<?php
						echo '<img style="max-width: 100%;" src="../images/atractivos/'.$atractivo->getImagenAtractivo().'">';
					?>
				</div>
				<div class="col-md-12" style="text-align: center;">
					<?php
						echo '<h4>'.$atractivo->getDescripcionAtractivo().'</h4>';
					?>
				<br>
					<?php
						echo '<iframe class="col-md-offset-3 col-md-6" width="560" height="315" src="'.$atractivo->getVideoAtractivo().'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
					?>
				</div>
				<div class="col-md-12" style="text-align: center;">
				<br><br>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contenido -->
<?php
include '../public/footer.php';
?>