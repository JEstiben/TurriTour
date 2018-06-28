<?php

include 'recomendacionesBusiness.php';

if (isset($_POST['recomendacionesEuclides'])) {
    $recomendacionesBusiness = new recomendacionesBusiness();
    $resultado = $recomendacionesBusiness->recomendacionesEuclides($_POST['distancia'], $_POST['duracion'], $_POST['tipoCamino']);
    echo $resultado;
}else if (isset($_POST['recomendacionesBayes'])) {
    $recomendacionesBusiness = new recomendacionesBusiness();
    $resultado = $recomendacionesBusiness->recomendacionesBayes($_POST['distancia'], $_POST['duracion'], $_POST['tipoCamino']);
    echo $resultado;
}//if-else
?>
