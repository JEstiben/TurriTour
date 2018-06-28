<?php

include_once '../data/recomendacionesData.php';

class recomendacionesBusiness {

    private $recomendacionesData;

    public function recomendacionesBusiness() {
        $this->recomendacionesData = new recomendacionesData();
    }//constructor

    public function recomendacionesEuclides($distancia, $duracion, $tipoCamino) {
        return $this->recomendacionesData->recomendacionesEuclides($distancia, $duracion, $tipoCamino);
    }//recomendacionesEuclides

    public function recomendacionesBayes($distancia, $duracion, $tipoCamino) {
        return $this->recomendacionesData->recomendacionesBayes($distancia, $duracion, $tipoCamino);
    }//recomendacionesBayes
}//class

?>