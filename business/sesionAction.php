<?php

include 'sesionBusiness.php';

if (isset($_POST['iniciarSesion'])) {
    $sesionBusiness = new sesionBusiness();
	$resultado = $sesionBusiness->iniciarSesion($_POST['correo'], $_POST['contrasena']);
    if($resultado == "true"){
        session_start();
        $_SESSION['Usuario'] = $_POST['correo'];
    }
	echo $resultado;
}else if (isset($_POST['cerrarSesion'])) {
    session_start();
    session_destroy();
}//if-else

?>
