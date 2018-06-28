<?php

include 'recomendacionesBusiness.php';

if (isset($_POST['recomendaciones'])) {
    $recomendacionesBusiness = new recomendacionesBusiness();
    $resultado = $recomendacionesBusiness->recomendaciones($_POST['distancia'], $_POST['duracion'], $_POST['tipoCamino']);
    echo $resultado;
}//if
?>
