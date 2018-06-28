<?php
include_once 'rutaData.php';

function euclides($datosUsuario, $registrosBaseDatos, $atributos) {
    $rutaData = new rutaData();
    $rutaData->eliminarRutasEuclides();
    //Diferencia que determina al mas similar
    $similitudMin = null;
    //Grupo de rutas similares
    $ruta = Array();
    //Se toman los registros de la Base de Datos 1 por 1, para compararlos contra lo ingresado
    foreach ($registrosBaseDatos as $registroActual) {
        //Se obtienen los datos necesarios del registro actual para la comparacion
        $datosregistro = array();
        foreach ($atributos as $atributoActual) {
            $datosregistro[$atributoActual] = $registroActual[$atributoActual];
        }//for atributos registro actual
        //Se calcula la similitud
        $similitud = calcularSimilitud($datosUsuario, $datosregistro, $atributos);
        //Se evalua si se tiene una similitud minima adecuada, para actualizarla o mantenerla
        if ($similitudMin == null) {
            $similitudMin = $similitud;
            $ruta[] = $registroActual;
        } else if ($similitud <= $similitudMin) {
            $similitudMin = $similitud;
            $ruta[] = $registroActual;
        }//if similitud minima
    }//for Base de datos
    //se registran las rutas en la tabla tb_ruta_euclides
    foreach ($ruta as $rutaActual) {
        $rutaA = new ruta($rutaActual['id'], $rutaActual['origen'], $rutaActual['destino'], $rutaActual['duracion'], $rutaActual['distancia'], $rutaActual['tipoCamino']);
        $rutaData->registrarRutaEuclides($rutaA);
    }//End foreach ($ruta as $rutaActual)
    //Se retorna el dato obtenido
    return $ruta;
}//euclides

function calcularSimilitud($datosUsuario, $datosregistro, $atributos) { 
    //Se estable la similitud en 0
    $similitud = 0;  
    //Se suma lo ingresado por el usuario y el registro actual en los mismos atributos
    foreach ($atributos as $atributoActual) {
        $similitud += pow(($datosregistro[$atributoActual] - $datosUsuario[$atributoActual]), 2);
    }//for atributos comparacion
    //Se retorna la similitud entre lo ingresado por el usuario y el registro actual
    return sqrt($similitud);
}//calcularSimilitud

?>