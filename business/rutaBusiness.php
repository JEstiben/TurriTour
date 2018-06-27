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

    /*public function obtenerAtractivo() {
        return $this->atractivoData->obtenerAtractivo();
    }//obteneratractivo

    public function obtenerAtractivoId($idAtractivo) {
        return $this->atractivoData->obtenerAtractivoId($idAtractivo);
    }//obteneratractivoId
    */
    public function eliminarRutas() {
        return $this->rutaData->eliminarRutas();
    }//eliminar
}//class

?>