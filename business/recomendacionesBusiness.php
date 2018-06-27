<?php

include_once '../data/recomendacionesData.php';

class recomendacionesBusiness {

    private $recomendacionesData;

    public function recomendacionesBusiness() {
        $this->recomendacionesData = new recomendacionesData();
    }//constructor

    public function recomendaciones($distancia, $duracion, $tipoCamino) {
        return $this->recomendacionesData->recomendaciones($distancia, $duracion, $tipoCamino);
    }//recomendaciones
}//class

?>