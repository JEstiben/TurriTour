<?php

include 'rutaBusiness.php';

if (isset($_POST['crearRuta'])) {

	    $rutaTemp = new atractivo(0, $_POST['puntoinicial'], $_POST['puntofinal'], $imagen, $_POST['tiempo'], $_POST['distancia'], $_POST['tipocamino']);

        $rutaBusiness = new rutaBusiness();
		$resultado = $rutaBusiness->registrarRuta($rutaTemp);
		if($resultado == "true"){
			echo "true";
        }else{
            echo "false";
        }//if-else
    }//if crearRuta

}else if (isset($_POST['eliminarAtractivo'])) {
    $atractivoBusiness = new atractivoBusiness();
    $resultado = $atractivoBusiness->eliminarAtractivo($_POST['idAtractivo']);
    if($resultado == "true"){
        echo "true";
    }else{
        echo "false";
    }//if-else
}//if-else

function limpiarNombre($nombreNuevo)
{
    //limpiar acento para la letra A/a
    $nombreNuevo = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $nombreNuevo
    );
    //limpiar acento para la letra E/e
    $nombreNuevo = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $nombreNuevo
    );
    //limpiar acento para la letra I/i
    $nombreNuevo = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $nombreNuevo
    );
    //limpiar acento para la letra O/o
    $nombreNuevo = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $nombreNuevo
    );
    //limpiar acento para la letra U/u
    $nombreNuevo = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $nombreNuevo
    );
    //limpiar letras Ñ/ñ y Ç/ç
    $nombreNuevo = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $nombreNuevo
    );

    return $nombreNuevo;
}//limpiarNombre
?>
