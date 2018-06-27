<?php
include '../public/header.php';
?>
<!--Scripts para hacer uso de máscaras-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>


<!-- Contenido -->
<div class="about">
	<div class="container">
		<div class="col-md-offset-3 col-md-6" style="background: #8492A6; border-radius: 2em;">
			<div class="col-md-offset-1 col-md-10">
				<form method="post" id="formulario" enctype="multipart/form-data">
					<div class="col-md-12" style="text-align: center;">
						<h2>Iniciar Sesi&oacute;n</h2>
					</div>				
					<div class="col-md-12" style="text-align: center;">
						<br><br>
						<div class="col-md-6" style="text-align: center;">
								<br>
								<label>Correo:</label>
								<br><br><br>
								<label>Contraseña:</label>							
								<br>
						</div>					
						<div class="col-md-6" style="text-align: center;">
							<input class="form-control" type="text" name="correo" id="correo">
							<br>						
							<input class="form-control" type="password" name="contrasena" id="contrasena">	
						</div>
						<div class="col-md-offset-2 col-md-8" style="text-align: center;">
							<input type="button" value="Iniciar Sesi&oacute;n" name="atractivos" id="atractivos" onclick="iniciarSesion();" class="btn btn-accept"/>
						</div>					
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Contenido -->
<?php
include '../public/footer.php';
?>
<script type="text/javascript">
	function iniciarSesion() {
        var correo = document.getElementById("correo").value;

        if (correo != ""){
            var contrasena = document.getElementById("contrasena").value;

            if(contrasena != ""){
                var formData = new FormData(document.getElementById("formulario"));
                formData.append("iniciarSesion", "iniciarSesion");
                $.ajax({
                    url: '../business/sesionAction.php',
                    type: "POST",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                })
                .done(function(data){
                    if(data == "true"){
                        location.href ="../index.php";
                    }else if(data == "false"){
                        mostrarMensaje("error", "Error al iniciar sesión.");
                    }//if-else
                });
            }else{
                mostrarMensaje("error", "Debe ingresar la contraseña.");
            }//if-else
        }else{
            mostrarMensaje("error", "Debe ingresar el correo.");
        }//if-else
    }//iniciarSesion

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