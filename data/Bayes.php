<?php

/*Funcion para calcular bayes*/
function calcularBayes($atractivo, $atractivosBD, $clases, $m) {
	
	//Variables importantes:
    $todasProbabilidades = [];//Todas las posibilidades que resulten del método se devuelven en un arreglo
    $n = 0;//Variable donde se almacena la cantidad de veces que una clase se encuentra en los registros totales        
    $pc = 0;//Variable que guarda la probabilidad correspondiente de la clase
    $pt = 0;//En esta variable se guardará la probabilidad total de una clase
    
    /*Paso 1: Recorrer las clases que se necesita sacar probabilidad*/
    foreach ($clases as $claseActual) {

        foreach ($atractivosBD as $atractivoActual) {
            
        	if($atractivoActual->getIdAtractivo() == $claseActual){//if que busca igualdad entre clases y registros

        		$n += 1;//si es de la misma clase se suma ++

        	}//if $atractivosBD->getIdAtractivo() == $claseActual->getIdAtractivo()

    	}//foreach que saca las clases

    	/*Passo 2: Se recorren los registros de la BD y se busca comparar datos con los insertados por el usuario*/
    	//valores que existen en la BD para cada atributo
    	$valTipoCamino = [];
    	$valDuracion = [];
    	$valDistancia = [];
    	//Variables que guardan cada nc de los atributos que insertó el usuario
    	$cantTipoCamino = 0;
    	$cantDuracion = 0;
    	$cantDistancia = 0;

    	foreach ($atractivosBD as $atractivoActual) {
    		/*Paso 3: Sacar todos los NC por cada atributo de la clase. Cada que se encuentra un atributo igual al insertado que poseea la misma clase se toma en cuenta. Además se guardan los valores que resultan según cada característica para luego sacar la probabilidad priori de cada atributo.*/
    		if($atractivoActual->getIdAtractivo() == $claseActual){//if que busca igualdad entre clases y registros
    			if ($atractivoActual->getTipoCaminoAtractivo() == $atractivo->getTipoCaminoAtractivo()){
    				$cantTipoCamino += 1;
    			}//if tipo camino
    			if ($atractivoActual->getDuracion() == $atractivo->getDuracion()){
    				$cantDuracion += 1;
    			}//if duracion
    			if ($atractivoActual->getDistancia() == $atractivo->getDistancia()){
    				$cantDistancia += 1;
    			}// dsitancia
    			//insertar valores dentro de arrays para manejarlos luego como datos para probabilidad priori
    			array_push($valTipoCamino, $atractivoActual->getTipoCaminoAtractivo());
    			array_push($valDuracion, $atractivoActual->getDuracion());
    			array_push($valDistancia, $atractivoActual->getDistancia());
    		}//if general de union entre clase y atractivo
    	}//foreach

    	//vectores que sacan cada uno de las diferentes opciones dentro de los vectores de valores para hacer priori de cada atributo
    	$unicosTipoCamino = array_unique($valTipoCamino);
    	$unicosDuracion = array_unique($valDuracion);
    	$unicosDistancia = array_unique($valDistancia);
    	//priori de cada atributo
    	$prioriTipoCamino = 1/sizeof($unicosTipoCamino);
    	$prioriDuracion = 1/sizeof($unicosDuracion);
    	$prioriDistancia = 1/sizeof($unicosDistancia);
    	
    	/*Paso 4: Sacar la probabilidad de cada atributo/característica de los obtenidos. Aplicando fórmula del enunciado
			Fórmula: (nc+(m*p))/(n+m)
    	*/

    	$probFiabilidad = ($cantTipoCamino + ($m * $prioriTipoCamino)) / ($n + $m);
    	$probEnlaces = ($cantDuracion + ($m * $prioriDuracion)) / ($n + $m);
    	$probCapacidad = ($cantDistancia + ($m * $prioriDistancia)) / ($n + $m);

    	/*Paso 5: sacar la probabilidad correspondiente*/
    	$pc = $n / sizeof($atractivosBD);
    	//sacar la probabilidad total de la atractivo
    	$pt = $probFiabilidad * $probEnlaces * $probCapacidad;
    	//Sacar la probabilidad final de la clase
    	$pf = $pt * $pc;

    	//Darle estructura a os datos para enviarse a mostrar. Se tomará el mayor y se dará como resultado además de todos los valores resultantes.
    	$probabilidadClase = array(
            'clase' => $claseActual,
            'probabilidadTotal' => $pt,
            'probabilidadCorrespondiente' => $pc,
            'probabilidadFinal' => $pf);
    	array_push($todasProbabilidades, $probabilidadClase);

    }//foreach general

    /*Paso 6: Envío de datos resultantes*/
    return $todasProbabilidades;

}//calcularbayes
?>