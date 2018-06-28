<?php
include '../data/ProfesorData.php';
include '../data/EstudianteData.php';
include '../data/RedData.php';
include '../data/EstiloData.php';

/*Para la implementación de Bayes primero se reciben los datos y se identifica que tipo de entrada se tiene para ver que algoritmo implementar*/
function recepcionDatosBayes($tipo, $objeto){
    $resultado = "";
    switch ($tipo) {
        case 'PROFESOR':
                $base = new ProfesorData();
                $profesoresBD = $base->obtenerProfesor();//los datos de la BD según se requiere
                $clases = $base->obtenerClases();//clases posibles de la clase
                $resultado = calcularBayesProfesor($objeto, $profesoresBD, $clases, 8);//llamado a la funcion de euclides que corresponda
                return $resultado;
            break;
        case 'RECINTO':
                $base = new EstudianteData();
                $recintosBD = $base->obtenerEstudiante();//los datos de la BD según se requiere
                $clases = $base->obtenerClasesRecinto();//clases posibles de la clase
                $resultado = calcularBayesRecinto($objeto, $recintosBD, $clases, 4);//llamado a la funcion de euclides que corresponda
                return $resultado;
            break;
        case 'ESTILODATOS':
                $base = new EstudianteData();
                $estilosBD = $base->obtenerEstudiante();//los datos de la BD según se requiere
                $clases = $base->obtenerClasesEA();//clases posibles de la clase
                $resultado = calcularBayesEAD($objeto, $estilosBD, $clases, 4);//llamado a la funcion de euclides que corresponda
                return $resultado;
            break;
        case 'ESTILOPUNTOS':
                $base = new EstiloData();
                $estilosBD = $base->obtenerEstilo();//los datos de la BD según se requiere
                $clases = $base->obtenerClases();//clases posibles de la clase
                $resultado = calcularBayesEAP($objeto, $estilosBD, $clases, 5);//llamado a la funcion de euclides que corresponda
                return $resultado;
            break;
        case 'SEXO':
                $base = new EstudianteData();
                $sexosBD = $base->obtenerEstudiante();//los datos de la BD según se requiere
                $clases = $base->obtenerClasesSexo();//clases posibles de la clase
                $resultado = calcularBayesSexo($objeto, $sexosBD, $clases, 4);//llamado a la funcion de euclides que corresponda
                return $resultado;                
            break;
        case 'RED':
                $base = new RedData();
                $redesBD = $base->obtenerRed();//los datos de la BD según se requiere
                $clases = $base->obtenerClases();//clases posibles de la clase
                $resultado = calcularBayesRedes($objeto, $redesBD, $clases,5);//llamado a la funcion de euclides que corresponda
                return $resultado;
            break;
        default:
            return $resultado ="NO_TIPO";
            break;
    }//switch

}//function recepcionDatosBayes

//*****************************************************************************************************************************************

function calcularBayesEAP($estilo, $estilosBD, $clases, $m) {
    
    //Variables importantes:
    $todasProbabilidades = [];//Todas las posibilidades que resulten del método se devuelven en un arreglo
    $n = 0;//Variable donde se almacena la cantidad de veces que una clase se encuentra en los registros totales        
    $pc = 0;//Variable que guarda la probabilidad correspondiente de la clase
    $pt = 0;//En esta variable se guardará la probabilidad total de una clase
    
    /*Paso 1: Recorrer las clases que se necesita sacar probabilidad*/
    foreach ($clases as $claseActual) {

        foreach ($estilosBD as $estiloActual) {
            
            if($estiloActual->getEstilo() == $claseActual){//if que busca igualdad entre clases y registros

                $n += 1;//si es de la misma clase se suma ++

            }//if $redesBD->getClase() == $claseActual->getClase()

        }//foreach que saca las clases

        /*Passo 2: Se recorren los registros de la BD y se busca comparar datos con los insertados por el usuario*/
        //valores que existen en la BD para cada atributo
        $valCA = [];
        $valEC = [];
        $valEA = [];
        $valOR = [];
        //Variables que guardan cada nc de los atributos que insertó el usuario
        $cantCA = 0;
        $cantEC = 0;
        $cantEA = 0;
        $cantOR = 0;

        foreach ($estilosBD as $estiloActual) {
            /*Paso 3: Sacar todos los NC por cada atributo de la clase. Cada que se encuentra un atributo igual al insertado que poseea la misma clase se toma en cuenta. Además se guardan los valores que resultan según cada característica para luego sacar la probabilidad priori de cada atributo.*/
            if($estiloActual->getClase() == $claseActual){//if que busca igualdad entre clases y registros
                if ($estiloActual->getCA() == $estilo->getCA()){
                    $cantFiabilidad += 1;
                }//if 
                if ($estiloActual->getEC() == $estilo->getEC()){
                    $cantEnlaces += 1;
                }//if
                if ($estiloActual->getEA() == $estilo->getEA()){
                    $cantCapacidad += 1;
                }//if
                if ($estiloActual->getOR() == $estilo->getOR()){
                    $cantCosto += 1;
                }//if 
                //insertar valores dentro de arrays para manejarlos luego como datos para probabilidad priori
                array_push($valCA, $estiloActual->getCA());
                array_push($valEC, $estiloActual->getEC());
                array_push($valEA, $estiloActual->getEA());
                array_push($valOR, $estiloActual->getOR());
            }//if general de union entre clase y estilo
        }//foreach

        //vectores que sacan cada uno de las diferentes opciones dentro de los vectores de valores para hacer priori de cada atributo
        $unicosCA = array_unique($valCA);
        $unicosEC = array_unique($valEC);
        $unicosEA = array_unique($valEA);
        $unicosOR = array_unique($valOR);
        //priori de cada atributo
        $prioriCA = 1/sizeof($unicosCA);
        $prioriEC = 1/sizeof($unicosEC);
        $prioriEA = 1/sizeof($unicosEA);
        $prioriOR = 1/sizeof($unicosOR);
        
        /*Paso 4: Sacar la probabilidad de cada atributo/característica de los obtenidos. Aplicando fórmula del enunciado
            Fórmula: (nc+(m*p))/(n+m)
        */

        $probCA = ($cantFiabilidad + ($m * $prioriCA)) / ($n + $m);
        $probEC = ($cantEnlaces + ($m * $prioriEC)) / ($n + $m);
        $probEA = ($cantCapacidad + ($m * $prioriEA)) / ($n + $m);
        $probOR = ($cantCosto + ($m * $prioriOR)) / ($n + $m);

        /*Paso 5: sacar la probabilidad correspondiente*/
        $pc = $n / sizeof($estilosBD);
        //sacar la probabilidad total de la red
        $pt = $probCA * $probEC * $probEA * $probOR;
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

}//bayes EAP


function calcularBayesProfesor($profesor, $profesoresBD, $clases, $m) {
	
	//Variables importantes:
    $todasProbabilidades = [];//Todas las posibilidades que resulten del método se devuelven en un arreglo
    $n = 0;//Variable donde se almacena la cantidad de veces que una clase se encuentra en los registros totales        
    $pc = 0;//Variable que guarda la probabilidad correspondiente de la clase
    $pt = 0;//En esta variable se guardará la probabilidad total de una clase
    
    /*Paso 1: Recorrer las clases que se necesita sacar probabilidad*/
    foreach ($clases as $claseActual) {

        foreach ($profesoresBD as $profesorActual) {
            
        	if($profesorActual->getClase() == $claseActual){//if que busca igualdad entre clases y registros

        		$n += 1;//si es de la misma clase se suma ++

        	}//if $redesBD->getClase() == $claseActual->getClase()

    	}//foreach que saca las clases

    	/*
	private $edad;
    private $sexo;
    private $autoEvaluacion;
    private $vecesCurso;
    private $disciplina;
    private $habilidades;	
    private $tecnologia;
    private $sitioWeb;
    	*/

    	/*Passo 2: Se recorren los registros de la BD y se busca comparar datos con los insertados por el usuario*/
    	//valores que existen en la BD para cada atributo
    	$valEdad = [];
    	$valSexo = [];
    	$valAutoEval = [];
    	$valVeces = [];
    	$valDiscuplina = [];
    	$valHabilidades = [];
    	$valTecnologia = [];
    	$valSitioWeb = [];
    	
    	//Variables que guardan cada nc de los atributos que insertó el usuario
    	$cantEdad = 0;
    	$cantSexo = 0;
    	$cantAutoEval = 0;
    	$cantVeces= 0;
    	$cantDisciplina = 0;
    	$cantHabilidades = 0;
    	$cantTecnologia = 0;
    	$cantSitioWeb = 0;

    	foreach ($profesoresBD as $profesorActual) {
    		/*Paso 3: Sacar todos los NC por cada atributo de la clase. Cada que se encuentra un atributo igual al insertado que poseea la misma clase se toma en cuenta. Además se guardan los valores que resultan según cada característica para luego sacar la probabilidad priori de cada atributo.*/
    		if($profesorActual->getClase() == $claseActual){//if que busca igualdad entre clases y registros
    			if ($profesorActual->getEdad() == $profesor->getEdad()){
    				$cantEdad += 1;
    			}//if 
    			if ($profesorActual->getSexo() == $profesor->getSexo()){
    				$cantSexo += 1;
    			}//if
    			if ($profesorActual->getAutoEvaluacion() == $profesor->getAutoEvaluacion()){
    				$cantAutoEval += 1;
    			}//if
    			if ($profesorActual->getVecesCurso() == $profesor->getVecesCurso()){
    				$cantVeces += 1;
    			}//if
    			if ($profesorActual->getDisciplina() == $profesor->getDisciplina()){
    				$cantDisciplina += 1;
    			}//if
    			if ($profesorActual->getHabilidades() == $profesor->getHabilidades()){
    				$cantHabilidades += 1;
    			}//if
    			if ($profesorActual->getTecnologia() == $profesor->getTecnologia()){
    				$cantTecnologia += 1;
    			}//if
    			if ($profesorActual->getSitioWeb() == $profesor->getSitioWeb()){
    				$cantSitioWeb += 1;
    			}//if

    			//insertar valores dentro de arrays para manejarlos luego como datos para probabilidad priori
    			array_push($valEdad, $profesorActual->getEdad());
    			array_push($valSexo, $profesorActual->getSexo());
    			array_push($valAutoEval, $profesorActual->getAutoEvaluacion());
    			array_push($valVeces, $profesorActual->getVecesCurso());
    			array_push($valDiscuplina, $profesorActual->getDisciplina());
    			array_push($valHabilidades, $profesorActual->getHabilidades());
    			array_push($valTecnologia, $profesorActual->getTecnologia());
    			array_push($valSitioWeb, $profesorActual->getSitioWeb());
    			
    		}//if general de union entre clase y red
    	}//foreach

    	//vectores que sacan cada uno de las diferentes opciones dentro de los vectores de valores para hacer priori de cada atributo
    	$unicosEdad = array_unique($valEdad);
    	$unicosSexo = array_unique($valSexo);
    	$unicosAutoEval = array_unique($valAutoEval);
    	$unicosVeces = array_unique($valVeces);
    	$unicosDisciplina = array_unique($valDiscuplina);
    	$unicosHabilidades = array_unique($valHabilidades);
    	$unicosTecnologia = array_unique($valTecnologia);
    	$unicosSitioWeb = array_unique($valSitioWeb);    	

    	//priori de cada atributo
    	$prioriEdad = 1/sizeof($unicosEdad);
    	$prioriSexo = 1/sizeof($unicosSexo);
    	$prioriAutoEval = 1/sizeof($unicosAutoEval);
    	$prioriVeces = 1/sizeof($unicosVeces);
    	$prioriDisciplina = 1/sizeof($unicosDisciplina);
    	$prioriHabilidades = 1/sizeof($unicosHabilidades);
    	$prioriTecnologia = 1/sizeof($unicosTecnologia);
    	$prioriSitioWeb = 1/sizeof($unicosSitioWeb);
    	
    	
    	/*Paso 4: Sacar la probabilidad de cada atributo/característica de los obtenidos. Aplicando fórmula del enunciado
			Fórmula: (nc+(m*p))/(n+m)
    	*/

    	$probEdad = ($cantEdad + ($m * $prioriEdad)) / ($n + $m);
    	$probSexo = ($cantSexo + ($m * $prioriSexo)) / ($n + $m);
    	$probAutoEval = ($cantAutoEval + ($m * $prioriAutoEval)) / ($n + $m);
    	$probVeces = ($cantVeces + ($m * $prioriVeces)) / ($n + $m);
    	$probDisciplina = ($cantDisciplina + ($m * $prioriDisciplina)) / ($n + $m);
    	$probHabilidades = ($cantHabilidades + ($m * $prioriHabilidades)) / ($n + $m);
    	$probTecnologia = ($cantTecnologia + ($m * $prioriTecnologia)) / ($n + $m);
    	$probSitioWeb = ($cantSitioWeb + ($m * $prioriSitioWeb)) / ($n + $m);

    	/*Paso 5: sacar la probabilidad correspondiente*/
    	$pc = $n / sizeof($profesoresBD);
    	//sacar la probabilidad total de la red
    	$pt = $probEdad * $probSexo * $probAutoEval * $probVeces * $probDisciplina * $probHabilidades * $probTecnologia * $probSitioWeb;
    	//Sacar la probabilidad final de la clase
    	$pf = $pt * $pc;

    	//Darle estructura a los datos para enviarse a mostrar. Se tomará el mayor y se dará como resultado además de todos los valores resultantes.
    	$probabilidadClase = array(
            'clase' => $claseActual,
            'probabilidadTotal' => $pt,
            'probabilidadCorrespondiente' => $pc,
            'probabilidadFinal' => $pf);
    	array_push($todasProbabilidades, $probabilidadClase);

    }//foreach general

    /*Paso 6: Envío de datos resultantes*/
    return $todasProbabilidades;

}//bayes profesor

function calcularBayesEAD($estudiante, $estudiantesBD, $clases, $m) {
	
	//Variables importantes:
    $todasProbabilidades = [];//Todas las posibilidades que resulten del método se devuelven en un arreglo
    $n = 0;//Variable donde se almacena la cantidad de veces que una clase se encuentra en los registros totales        
    $pc = 0;//Variable que guarda la probabilidad correspondiente de la clase
    $pt = 0;//En esta variable se guardará la probabilidad total de una clase
    
    /*Paso 1: Recorrer las clases que se necesita sacar probabilidad*/
    foreach ($clases as $claseActual) {

        foreach ($estudiantesBD as $estudianteActual) {
            
        	if($estudianteActual->getEstilo() == $claseActual){//if que busca igualdad entre clases y registros

        		$n += 1;//si es de la misma clase se suma ++

        	}//if $redesBD->getClase() == $claseActual->getClase()

    	}//foreach que saca las clases

    	/*Passo 2: Se recorren los registros de la BD y se busca comparar datos con los insertados por el usuario*/
    	//valores que existen en la BD para cada atributo
    	$valRecinto = [];
    	$valPromedio = [];
    	$valSexo = [];
    	//Variables que guardan cada nc de los atributos que insertó el usuario
    	$cantRecinto = 0;
    	$cantPromedio = 0;
    	$cantSexo = 0;

    	foreach ($estudiantesBD as $estudianteActual) {
    		/*Paso 3: Sacar todos los NC por cada atributo de la clase. Cada que se encuentra un atributo igual al insertado que poseea la misma clase se toma en cuenta. Además se guardan los valores que resultan según cada característica para luego sacar la probabilidad priori de cada atributo.*/
    		if($estudianteActual->getEstilo() == $claseActual){//if que busca igualdad entre clases y registros
    			if ($estudianteActual->getRecinto() == $estudiante->getRecinto()){
    				$cantRecinto += 1;
    			}//if confiabilidad
    			if ($estudianteActual->getPromedio() == $estudiante->getPromedio()){
    				$cantPromedio += 1;
    			}//ifenlaces
    			if ($estudianteActual->getSexo() == $estudiante->getSexo()){
    				$cantSexo += 1;
    			}//ifcapacidad
    			
    			//insertar valores dentro de arrays para manejarlos luego como datos para probabilidad priori
    			array_push($valRecinto, $estudianteActual->getRecinto());
    			array_push($valPromedio, $estudianteActual->getPromedio());
    			array_push($valSexo, $estudianteActual->getSexo());
    			
    		}//if general de union entre clase y red
    	}//foreach

    	//vectores que sacan cada uno de las diferentes opciones dentro de los vectores de valores para hacer priori de cada atributo
    	$unicosRecinto = array_unique($valRecinto);
    	$unicosPromedio = array_unique($valPromedio);
    	$unicosSexo = array_unique($valSexo);
    	
    	//priori de cada atributo
    	$prioriRecinto = 1/sizeof($unicosRecinto);
    	$prioriPromedio = 1/sizeof($unicosPromedio);
    	$prioriSexo = 1/sizeof($unicosSexo);
    	
    	/*Paso 4: Sacar la probabilidad de cada atributo/característica de los obtenidos. Aplicando fórmula del enunciado
			Fórmula: (nc+(m*p))/(n+m)
    	*/

    	$probRecinto = ($cantRecinto + ($m * $prioriRecinto)) / ($n + $m);
    	$probPromedio = ($cantPromedio + ($m * $prioriPromedio)) / ($n + $m);
    	$probSexo = ($cantSexo + ($m * $prioriSexo)) / ($n + $m);
    	
    	/*Paso 5: sacar la probabilidad correspondiente*/
    	$pc = $n / sizeof($estudiantesBD);
    	//sacar la probabilidad total de la red
    	$pt = $probFiabilidad * $probRecinto * $probPromedio * $probSexo;
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

}//bayes EAD

function calcularBayesRecinto($recinto, $recintosBD, $clases, $m) {
	
	//Variables importantes:
    $todasProbabilidades = [];//Todas las posibilidades que resulten del método se devuelven en un arreglo
    $n = 0;//Variable donde se almacena la cantidad de veces que una clase se encuentra en los registros totales        
    $pc = 0;//Variable que guarda la probabilidad correspondiente de la clase
    $pt = 0;//En esta variable se guardará la probabilidad total de una clase
    
    /*Paso 1: Recorrer las clases que se necesita sacar probabilidad*/
    foreach ($clases as $claseActual) {

        foreach ($recintosBD as $estudianteActual) {
            
        	if($estudianteActual->getRecinto() == $claseActual){//if que busca igualdad entre clases y registros

        		$n += 1;//si es de la misma clase se suma ++

        	}//if $redesBD->getClase() == $claseActual->getClase()

    	}//foreach que saca las clases

    	/*Passo 2: Se recorren los registros de la BD y se busca comparar datos con los insertados por el usuario*/
    	//valores que existen en la BD para cada atributo
    	$valEA = [];
    	$valPromedio = [];
    	$valSexo = [];
    	//Variables que guardan cada nc de los atributos que insertó el usuario
    	$cantEA = 0;
    	$cantPromedio = 0;
    	$cantSexo = 0;

    	foreach ($recintosBD as $estudianteActual) {
    		/*Paso 3: Sacar todos los NC por cada atributo de la clase. Cada que se encuentra un atributo igual al insertado que poseea la misma clase se toma en cuenta. Además se guardan los valores que resultan según cada característica para luego sacar la probabilidad priori de cada atributo.*/
    		if($estudianteActual->getRecinto() == $claseActual){//if que busca igualdad entre clases y registros
    			if ($estudianteActual->getEstilo() == $recinto->getEstilo()){
    				$cantEA += 1;
    			}//if EA
    			if ($estudianteActual->getPromedio() == $recinto->getPromedio()){
    				$cantPromedio += 1;
    			}//if Promedio
    			if ($estudianteActual->getSexo() == $recinto->getSexo()){
    				$cantRecinto += 1;
    			}//if Sexo
    			//insertar valores dentro de arrays para manejarlos luego como datos para probabilidad priori
    			array_push($valEA, $estudianteActual->getEstilo());
    			array_push($valPromedio, $estudianteActual->getPromedio());
    			array_push($valSexo, $estudianteActual->getSexo());
    		}//if general de union entre clase y recinto
    	}//foreach

    	//vectores que sacan cada uno de las diferentes opciones dentro de los vectores de valores para hacer priori de cada atributo
    	$unicosEA = array_count_values($valEA);
    	$unicosPromedio = array_count_values($valPromedio);
    	$unicosSexo = array_count_values($valSexo);
    	
    	//priori de cada atributo
    	$prioriEA = 1/sizeof($unicosEA);
    	$prioriPromedio = 1/sizeof($unicosPromedio);
    	$prioriSexo = 1/sizeof($unicosSexo);
    	
    	/*Paso 4: Sacar la probabilidad de cada atributo/característica de los obtenidos. Aplicando fórmula del enunciado
			Fórmula: (nc+(m*p))/(n+m)
    	*/

    	$probEA = ($cantEA + ($m * $prioriEA)) / ($n + $m);
    	$probPromedio = ($cantPromedio + ($m * $prioriPromedio)) / ($n + $m);
    	$probSexo = ($cantSexo + ($m * $prioriSexo)) / ($n + $m);
    	
    	/*Paso 5: sacar la probabilidad correspondiente*/
    	$pc = $n / sizeof($recintosBD);
    	//sacar la probabilidad total de la red
    	$pt = $probEA * $probPromedio * $probSexo;
    	//Sacar la probabilidad final de la clase
    	$pf = $pt * $pc;

    	//Darle estructura a los datos para enviarse a mostrar. Se tomará el mayor y se dará como resultado además de todos los valores resultantes.
    	$probabilidadClase = array(
            'clase' => $claseActual,
            'probabilidadTotal' => $pt,
            'probabilidadCorrespondiente' => $pc,
            'probabilidadFinal' => $pf);
    	array_push($todasProbabilidades, $probabilidadClase);

    }//foreach general

    /*Paso 6: Envío de datos resultantes*/
    return $todasProbabilidades;
    
}//bayes Recinto

function calcularBayesSexo($estudiante, $estudiantesBD, $clases, $m) {
	
	//Variables importantes:
    $todasProbabilidades = [];//Todas las posibilidades que resulten del método se devuelven en un arreglo
    $n = 0;//Variable donde se almacena la cantidad de veces que una clase se encuentra en los registros totales        
    $pc = 0;//Variable que guarda la probabilidad correspondiente de la clase
    $pt = 0;//En esta variable se guardará la probabilidad total de una clase
    
    /*Paso 1: Recorrer las clases que se necesita sacar probabilidad*/
    foreach ($clases as $claseActual) {

        foreach ($estudiantesBD as $estudianteActual) {
            
        	if($estudianteActual->getSexo() == $claseActual){//if que busca igualdad entre clases y registros

        		$n += 1;//si es de la misma clase se suma ++

        	}//if $redesBD->getClase() == $claseActual->getClase()

    	}//foreach que saca las clases

    	/*Passo 2: Se recorren los registros de la BD y se busca comparar datos con los insertados por el usuario*/
    	//valores que existen en la BD para cada atributo
    	$valEA = [];
    	$valPromedio = [];
    	$valRecinto = [];
    	//Variables que guardan cada nc de los atributos que insertó el usuario
    	$cantEA = 0;
    	$cantPromedio = 0;
    	$cantRecinto = 0;

    	foreach ($estudiantesBD as $estudianteActual) {
    		/*Paso 3: Sacar todos los NC por cada atributo de la clase. Cada que se encuentra un atributo igual al insertado que poseea la misma clase se toma en cuenta. Además se guardan los valores que resultan según cada característica para luego sacar la probabilidad priori de cada atributo.*/
    		if($estudianteActual->getSexo() == $claseActual){//if que busca igualdad entre clases y registros
    			if ($estudianteActual->getEstilo() == $estudiante->getEstilo()){
    				$cantEA += 1;
    			}//if EA
    			if ($estudianteActual->getPromedio() == $estudiante->getPromedio()){
    				$cantPromedio += 1;
    			}//if Promedio
    			if ($estudianteActual->getRecinto() == $estudiante->getRecinto()){
    				$cantRecinto += 1;
    			}//if Recinto
    			//insertar valores dentro de arrays para manejarlos luego como datos para probabilidad priori
    			array_push($valEA, $estudianteActual->getEstilo());
    			array_push($valPromedio, $estudianteActual->getPromedio());
    			array_push($valRecinto, $estudianteActual->getRecinto());
    		}//if general de union entre clase y red
    	}//foreach

    	//vectores que sacan cada uno de las diferentes opciones dentro de los vectores de valores para hacer priori de cada atributo
    	$unicosEA = array_unique($valEA);
    	$unicosPromedio = array_unique($valPromedio);
    	$unicosRecinto = array_unique($valRecinto);
    	
    	//priori de cada atributo
    	$prioriEA = 1/sizeof($unicosEA);
    	$prioriPromedio = 1/sizeof($unicosPromedio);
    	$prioriRecinto = 1/sizeof($unicosRecinto);
    	
    	/*Paso 4: Sacar la probabilidad de cada atributo/característica de los obtenidos. Aplicando fórmula del enunciado
			Fórmula: (nc+(m*p))/(n+m)
    	*/

    	$probEA = ($cantEA + ($m * $prioriEA)) / ($n + $m);
    	$probPromedio = ($cantPromedio + ($m * $prioriPromedio)) / ($n + $m);
    	$probRecinto = ($cantRecinto + ($m * $prioriRecinto)) / ($n + $m);
    	
    	/*Paso 5: sacar la probabilidad correspondiente*/
    	$pc = $n / sizeof($estudiantesBD);
    	//sacar la probabilidad total de la red
    	$pt = $probEA * $probPromedio * $probRecinto;
    	//Sacar la probabilidad final de la clase
    	$pf = $pt * $pc;

    	//Darle estructura a los datos para enviarse a mostrar. Se tomará el mayor y se dará como resultado además de todos los valores resultantes.
    	$probabilidadClase = array(
            'clase' => $claseActual,
            'probabilidadTotal' => $pt,
            'probabilidadCorrespondiente' => $pc,
            'probabilidadFinal' => $pf);
    	array_push($todasProbabilidades, $probabilidadClase);

    }//foreach general

    /*Paso 6: Envío de datos resultantes*/
    return $todasProbabilidades;
    
}//bayes Sexo

/*Funcion para calcular bayes en redes*/
function calcularBayesRedes($red, $redesBD, $clases, $m) {
	
	//Variables importantes:
    $todasProbabilidades = [];//Todas las posibilidades que resulten del método se devuelven en un arreglo
    $n = 0;//Variable donde se almacena la cantidad de veces que una clase se encuentra en los registros totales        
    $pc = 0;//Variable que guarda la probabilidad correspondiente de la clase
    $pt = 0;//En esta variable se guardará la probabilidad total de una clase
    
    /*Paso 1: Recorrer las clases que se necesita sacar probabilidad*/
    foreach ($clases as $claseActual) {

        foreach ($redesBD as $redActual) {
            
        	if($redActual->getClase() == $claseActual){//if que busca igualdad entre clases y registros

        		$n += 1;//si es de la misma clase se suma ++

        	}//if $redesBD->getClase() == $claseActual->getClase()

    	}//foreach que saca las clases

    	/*Passo 2: Se recorren los registros de la BD y se busca comparar datos con los insertados por el usuario*/
    	//valores que existen en la BD para cada atributo
    	$valFiabilidad = [];
    	$valEnlaces = [];
    	$valCapacidad = [];
    	$valCosto = [];
    	//Variables que guardan cada nc de los atributos que insertó el usuario
    	$cantFiabilidad = 0;
    	$cantEnlaces = 0;
    	$cantCapacidad = 0;
    	$cantCosto = 0;

    	foreach ($redesBD as $redActual) {
    		/*Paso 3: Sacar todos los NC por cada atributo de la clase. Cada que se encuentra un atributo igual al insertado que poseea la misma clase se toma en cuenta. Además se guardan los valores que resultan según cada característica para luego sacar la probabilidad priori de cada atributo.*/
    		if($redActual->getClase() == $claseActual){//if que busca igualdad entre clases y registros
    			if ($redActual->getConfiabilidad() == $red->getConfiabilidad()){
    				$cantFiabilidad += 1;
    			}//if confiabilidad
    			if ($redActual->getEnlaces() == $red->getEnlaces()){
    				$cantEnlaces += 1;
    			}//ifenlaces
    			if ($redActual->getCapacidad() == $red->getCapacidad()){
    				$cantCapacidad += 1;
    			}//ifcapacidad
    			if ($redActual->getCosto() == $red->getCosto()){
    				$cantCosto += 1;
    			}//if costo
    			//insertar valores dentro de arrays para manejarlos luego como datos para probabilidad priori
    			array_push($valFiabilidad, $redActual->getConfiabilidad());
    			array_push($valEnlaces, $redActual->getEnlaces());
    			array_push($valCapacidad, $redActual->getCapacidad());
    			array_push($valCosto, $redActual->getCosto());
    		}//if general de union entre clase y red
    	}//foreach

    	//vectores que sacan cada uno de las diferentes opciones dentro de los vectores de valores para hacer priori de cada atributo
    	$unicosFiabilidad = array_unique($valFiabilidad);
    	$unicosEnlaces = array_unique($valEnlaces);
    	$unicosCapacidad = array_unique($valCapacidad);
    	$unicosCosto = array_unique($valCosto);
    	//priori de cada atributo
    	$prioriFiabilidad = 1/sizeof($unicosFiabilidad);
    	$prioriEnlaces = 1/sizeof($unicosEnlaces);
    	$prioriCapacidad = 1/sizeof($unicosCapacidad);
    	$prioriCosto = 1/sizeof($unicosCosto);
    	
    	/*Paso 4: Sacar la probabilidad de cada atributo/característica de los obtenidos. Aplicando fórmula del enunciado
			Fórmula: (nc+(m*p))/(n+m)
    	*/

    	$probFiabilidad = ($cantFiabilidad + ($m * $prioriFiabilidad)) / ($n + $m);
    	$probEnlaces = ($cantEnlaces + ($m * $prioriEnlaces)) / ($n + $m);
    	$probCapacidad = ($cantCapacidad + ($m * $prioriCapacidad)) / ($n + $m);
    	$probCosto = ($cantCosto + ($m * $prioriCosto)) / ($n + $m);

    	/*Paso 5: sacar la probabilidad correspondiente*/
    	$pc = $n / sizeof($redesBD);
    	//sacar la probabilidad total de la red
    	$pt = $probFiabilidad * $probEnlaces * $probCapacidad * $probCosto;
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

}//bayes REDES


?>