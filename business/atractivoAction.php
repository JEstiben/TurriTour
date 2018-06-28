<?php

include 'atractivoBusiness.php';

if (isset($_POST['crearAtractivo'])) {
	$tipo = $_FILES["imagen"]["type"];
    if($tipo == "image/jpeg"){
        $imagen = $_FILES["imagen"]["name"];
        $ruta = $_FILES["imagen"]["tmp_name"];
        $nombre = str_replace(".jpg", "", $imagen);
        $nuevoNombre = limpiarNombre($nombre);
        $imagen = str_replace($nombre, $nuevoNombre, $imagen);
        $destino="../images/atractivos/".$imagen;
        $video = str_replace("watch?v=", "embed/", $_POST['video']);
        $atractivo = new atractivo(0, $_POST['atractivo'], $_POST['descripcion'], $imagen, $video, $_POST['longitud'], $_POST['latitud'], $_POST['tipo_camino']);
        $atractivoBusiness = new atractivoBusiness();
		$resultado = $atractivoBusiness->crearAtractivo($atractivo);
		if($resultado == "true"){
			copy($ruta,$destino);
            echo "true";
        }else{
            echo "false";
        }//if-else
    }else{
        echo "error";
    }//if tipo archivo
}else if (isset($_POST['eliminarAtractivo'])) {
    $atractivoBusiness = new atractivoBusiness();
    $resultado = $atractivoBusiness->eliminarAtractivo($_POST['idAtractivo']);
    if($resultado == "true"){
        echo "true";
    }else{
        echo "false";
    }//if-else
}else if (isset($_POST['modificarAtractivo'])) {
    $tipo = $_FILES["imagen"]["type"];
    if($tipo == "image/jpeg"){
        $imagen = $_FILES["imagen"]["name"];
        $ruta = $_FILES["imagen"]["tmp_name"];
        $nombre = str_replace(".jpg", "", $imagen);
        $nuevoNombre = limpiarNombre($nombre);
        $imagen = str_replace($nombre, $nuevoNombre, $imagen);
        $destino="../images/atractivos/".$imagen;
        $video = str_replace("watch?v=", "embed/", $_POST['video']);
        $atractivo = new atractivo($_POST["idAtractivo"], $_POST['atractivo'], $_POST['descripcion'], $imagen, $video, $_POST['longitud'], $_POST['latitud'], $_POST['tipo_camino']);
        $atractivoBusiness = new atractivoBusiness();
        $resultado = $atractivoBusiness->modificarAtractivo($atractivo);
        if($resultado == "true"){
            copy($ruta,$destino);
            echo "true";
        }else{
            echo "false";
        }//if-else
    }else{
        echo "error";
    }//if tipo archivo
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
