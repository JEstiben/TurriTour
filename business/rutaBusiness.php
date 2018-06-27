<?php

include_once '../data/rutaData.php';

class rutaBusiness {

    private $rutaData;

    public function rutaBusiness() {
        $this->rutaData = new rutaData();
    }//constructor

    public function registrarRuta($ruta) {
        return $this->rutaData->registrarRuta($ruta);
    }//crear

    public function obtenerRutaEuclides() {
        return $this->rutaData->obtenerRutaEuclides();
    }//obtenerRutaEuclides

    public function eliminarRutas() {
        return $this->rutaData->eliminarRutas();
    }//eliminar
}//class

?>