<?php
include '../public/header.php';
?>

<?php
    include '../business/atractivoBusiness.php';

    $atractivoBusiness = new atractivoBusiness();
    $atractivos = $atractivoBusiness->obtenerAtractivo();
?>

<!-- Contenido -->
<div class="about">
	<div class="container">
        <?php
            if(session_status() != 2){
                session_start();
            }
            if(isset($_SESSION['Usuario'])){
        ?>
		<?php
            foreach ($atractivos as $atractivo) {
echo '<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em; margin-top: 1em; margin-bottom: 1em;">';
	echo '<div class="col-md-offset-1 col-md-3" style="text-align: center;">';
		echo '<h4>'.$atractivo->getNombreAtractivo().'</h4>';
		echo '<img style="max-width: 100%; margin: 0.5em auto;" src="../images/atractivos/'.$atractivo->getImagenAtractivo().'">';
	echo '</div>';
	echo '<div class="col-md-8" style="text-align: center;">';
		echo '<div class="col-md-12" style="text-align: justify;">';
			echo '<h4>'.$atractivo->getDescripcionAtractivo().'</h4>';
		echo '</div>';
		echo '<div class="col-md-3" style="text-align: justify;">';
			echo '<form id="form" method="POST" enctype="multipart/form-data" action="modificarAtractivo.php">';
				echo '<input type="hidden" name="idAtractivo" id="idAtractivo" value="'.$atractivo->getIdAtractivo().'" />';
				echo '<input type="submit" value="Modificar" name="modificar" id="modificar" class="btn btn-success"/>';
			echo '</form>';
		echo '</div>';
		echo '<div class="col-md-offset-1 col-md-3" style="text-align: justify;">';
			echo '<input type="button" value="Eliminar" name="eliminar" id="eliminar" class="btn btn-success" onclick="elimnar('.$atractivo->getIdAtractivo().');" />';
		echo '</div>';
	echo '</div>';
echo '</div>';
            }//foreach
        ?>
        <?php
            }else{
        ?>
        <div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em;">
            <div class="col-md-offset-1 col-md-10">
                <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                    <img style="max-width: 60%;" src="../images/error.png">
                </div>
                <div class="col-md-12" style="text-align: center;">
                    <h2>Error al cargar la p&aacute;gina.</h2>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
	</div>
</div>
<!-- Contenido -->
<?php
include '../public/footer.php';
?>
<script type="text/javascript">

    function elimnar(idAtractivo) {
		var parameters = {
            "eliminarAtractivo" : 'eliminarAtractivo',
            "idAtractivo" : idAtractivo
        };

        $.post("../business/atractivoAction.php",parameters, function(data){
        	if(data == "true"){
        		location.reload();
                mostrarMensaje("success", "Éxito al eliminar el atractivo.");
            }else if(data == "false"){
                mostrarMensaje("error", "Error al eliminar el atractivo.");
            }//if-else
        });
    }//eliminar

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