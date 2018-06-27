<?php
include '../public/header.php';
?>
<ol class="breadcrumb" style="border-radius: 0;">
	<li><a href="criterios.php">Rutas</a></li>
	<li class="active">Recomendaciones</li>
</ol>

<?php
    include '../business/rutaBusiness.php';

    $rutaBusiness = new rutaBusiness();
    $rutas = $rutaBusiness->obtenerRutaEuclides();
?>

<!-- Contenido -->
<div class="about">
	<div class="container">
		<?php
			$contador = 1;
            foreach ($rutas as $ruta) {
echo '<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em; margin-top: 1em; margin-bottom: 1em;">';
	echo '<div class="col-md-offset-1 col-md-3" style="text-align: center;">';
		echo '<a href="detalleRuta.php?id='.$ruta->getIdRuta().'"><img style="max-width: 100%; margin: 0.5em auto;" src="../images/ruta'.$contador.'.png"></a>';
	echo '</div>';
	echo '<div class="col-md-8" style="text-align: center;">';
		echo '<div class="col-md-12" style="text-align: justify;">';
			echo '<br><br><br><br>';
			echo '<h4>Esta ruta recomendada lo lleva al atractivo tur&iacute;stico '.$ruta->getPuntoFinal().'.</h4>';
		echo '</div>';
	echo '</div>';
echo '</div>';
			$contador++;
            }//foreach
        ?>
	</div>
</div>
<!-- Contenido -->
<?php
include '../public/footer.php';
?>