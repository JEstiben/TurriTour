<?php
include '../public/header.php';
?>
<ol class="breadcrumb" style="border-radius: 0;">
	<li><a href="criterios.php">Rutas</a></li>
	<li class="active">Atractivos</li>
</ol>

<?php
    include '../business/atractivoBusiness.php';

    $atractivoBusiness = new atractivoBusiness();
    $atractivos = $atractivoBusiness->obtenerAtractivoBayes();
?>

<!-- Contenido -->
<div class="about">
	<div class="container">
		<?php
            foreach ($atractivos as $atractivo) {
echo '<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em; margin-top: 1em; margin-bottom: 1em;">';
	echo '<div class="col-md-offset-1 col-md-3" style="text-align: center;">';
		echo '<h4>'.$atractivo->getNombreAtractivo().'</h4>';
		echo '<a href="detalleAtractivo.php?idAtr='.$atractivo->getIdAtractivo().'">';
			echo '<img style="max-width: 100%; margin: 0.5em auto;" src="../images/atractivos/'.$atractivo->getImagenAtractivo().'">';
		echo '</a>';
	echo '</div>';
	echo '<div class="col-md-8" style="text-align: center;">';
		echo '<div class="col-md-12" style="text-align: justify;">';
			echo '<h4>'.$atractivo->getDescripcionAtractivo().'</h4>';
		echo '</div>';
	echo '</div>';
echo '</div>';
            }//foreach
        ?>
	</div>
</div>
<!-- Contenido -->
<?php
include '../public/footer.php';
?>