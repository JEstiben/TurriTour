<?php

include '../domain/Red.php';
include '../domain/Bayes.php';

if (isset($_POST['calcular'])) {

        /*FIABILIDAD, ENLACES, CAPACIDAD Y COSTO*/

        $fiabilidad= $_POST['fiabilidad'];
        $enlaces = $_POST['enlaces'];
        $capacidad = $_POST['capacidad'];
        $costo = $_POST['costo'];

        $red = new Red($fiabilidad,$enlaces,$capacidad, $costo,'');
        $bayes = recepcionDatosBayes('RED',$red);
        
          
        $url ="";
        $claseResultado = "";
        $max = 0;
        foreach ($bayes as $bayesActual) {
            $url.=$bayesActual['clase'].'?'.$bayesActual['probabilidadFinal'].'?';

            if($bayesActual['probabilidadFinal'] > $max){
                $claseResultado = $bayesActual['clase'];
                $max = $bayesActual['probabilidadFinal'];
            }
            $url.= ';';
            
        }
        
        $resultado = 1;
        if ($resultado == 1) {
            header("location: ../view/redesView.php?success=$url");
        } else {
            header("location: ../view/redesView.php?error=$url");
        }//else "error"

}//if isset