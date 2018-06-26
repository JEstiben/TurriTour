<?php
include '../public/header.php';
?>
<!-- Contenido -->
<div class="about">
	<div class="container">
		<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em; margin-top: 1em; margin-bottom: 1em;">
			<div class="col-md-offset-1 col-md-3" style="text-align: center;">
				<img style="max-width: 100%; margin: 0.5em auto;" src="../images/ruta0.png">
			</div>
			<div class="col-md-8" style="text-align: center;">
				<div class="col-md-12" style="text-align: justify;">
					<h4>Esta ruta recomendada lo lleva al atractivo tur&iacute;stico San Buenaventura.</h4>
				</div>
				<div class="col-md-3" style="text-align: justify;">
					<form id="form" method="POST" enctype="multipart/form-data" action="modificarRutaADM.php">
						<input type="submit" value="Modificar" name="modificar" id="modificar" class="btn btn-success"/>
					</form>
				</div>
				<div class="col-md-offset-1 col-md-3" style="text-align: justify;">
					<input type="button" value="Eliminar" name="eliminar" id="eliminar" class="btn btn-success" onclick="elimnar(1);" />
				</div>
			</div>
		</div>

		<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em; margin-top: 1em; margin-bottom: 1em;">
			<div class="col-md-offset-1 col-md-3" style="text-align: center;">
				<img style="max-width: 100%; margin: 0.5em auto;" src="../images/ruta0.png">
			</div>
			<div class="col-md-8" style="text-align: center;">
				<div class="col-md-12" style="text-align: justify;">
					<h4>Esta ruta recomendada lo lleva al atractivo tur&iacute;stico Monumento Guayabo.</h4>
				</div>
				<div class="col-md-3" style="text-align: justify;">
					<form id="form" method="POST" enctype="multipart/form-data" action="modificarRutaADM.php">
						<input type="submit" value="Modificar" name="modificar" id="modificar" class="btn btn-success"/>
					</form>
				</div>
				<div class="col-md-offset-1 col-md-3" style="text-align: justify;">
					<input type="button" value="Eliminar" name="eliminar" id="eliminar" class="btn btn-success" onclick="elimnar(2);" />
				</div>
			</div>
		</div>

		<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em; margin-top: 1em; margin-bottom: 1em;">
			<div class="col-md-offset-1 col-md-3" style="text-align: center;">
				<img style="max-width: 100%; margin: 0.5em auto;" src="../images/ruta0.png">
			</div>
			<div class="col-md-8" style="text-align: center;">
				<div class="col-md-12" style="text-align: justify;">
					<h4>Esta ruta recomendada lo lleva al atractivo tur&iacute;stico Sapito entre volcanes.</h4>
				</div>
				<div class="col-md-3" style="text-align: justify;">
					<form id="form" method="POST" enctype="multipart/form-data" action="modificarRutaADM.php">
						<input type="submit" value="Modificar" name="modificar" id="modificar" class="btn btn-success"/>
					</form>
				</div>
				<div class="col-md-offset-1 col-md-3" style="text-align: justify;">
					<input type="button" value="Eliminar" name="eliminar" id="eliminar" class="btn btn-success" onclick="elimnar(3);" />
				</div>
			</div>
		</div>

		<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em; margin-top: 1em; margin-bottom: 1em;">
			<div class="col-md-offset-1 col-md-3" style="text-align: center;">
				<img style="max-width: 100%; margin: 0.5em auto;" src="../images/ruta0.png">
			</div>
			<div class="col-md-8" style="text-align: center;">
				<div class="col-md-12" style="text-align: justify;">
					<h4>Esta ruta recomendada lo lleva al atractivo tur&iacute;stico Volc&aacute;n Turrialba.</h4>
				</div>
				<div class="col-md-3" style="text-align: justify;">
					<form id="form" method="POST" enctype="multipart/form-data" action="modificarRutaADM.php">
						<input type="submit" value="Modificar" name="modificar" id="modificar" class="btn btn-success"/>
					</form>
				</div>
				<div class="col-md-offset-1 col-md-3" style="text-align: justify;">
					<input type="button" value="Eliminar" name="eliminar" id="eliminar" class="btn btn-success" onclick="elimnar(4);" />
				</div>
			</div>
		</div>

		<div class="col-md-offset-1 col-md-10" style="background: #8492A6; border-radius: 2em; margin-top: 1em; margin-bottom: 1em;">
			<div class="col-md-offset-1 col-md-3" style="text-align: center;">
				<img style="max-width: 100%; margin: 0.5em auto;" src="../images/ruta0.png">
			</div>
			<div class="col-md-8" style="text-align: center;">
				<div class="col-md-12" style="text-align: justify;">
					<h4>Esta ruta recomendada lo lleva al atractivo tur&iacute;stico Rio Reventaz&oacute;n.</h4>
				</div>
				<div class="col-md-3" style="text-align: justify;">
					<form id="form" method="POST" enctype="multipart/form-data" action="modificarRutaADM.php">
						<input type="submit" value="Modificar" name="modificar" id="modificar" class="btn btn-success"/>
					</form>
				</div>
				<div class="col-md-offset-1 col-md-3" style="text-align: justify;">
					<input type="button" value="Eliminar" name="eliminar" id="eliminar" class="btn btn-success" onclick="elimnar(5);" />
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contenido -->
<?php
include '../public/footer.php';
?>
<script>
    function eliminar() {
        var parameters = {"eliminar" : 'eliminar',
                        "id" : promedioVar,};
        $.post("../business/rutaBusiness/rutaAction.php",parameters, function(data){
            
        });
    }//eliminar

</script>