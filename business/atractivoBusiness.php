<?php

include_once '../data/atractivoData.php';

class atractivoBusiness {

    private $atractivoData;

    public function atractivoBusiness() {
        $this->atractivoData = new atractivoData();
    }//constructor

    public function crearAtractivo($atractivo) {
        return $this->atractivoData->crearAtractivo($atractivo);
    }//crear Atractivo

    public function modificarAtractivo($atractivo) {
        return $this->atractivoData->modificarAtractivo($atractivo);
    }//modificar Atractivo

    public function obtenerAtractivo() {
        return $this->atractivoData->obtenerAtractivo();
    }//obteneratractivo

    public function obtenerAtractivoespe($tipo) {
        return $this->atractivoData->obtenerAtractivoespe($tipo);
    }//obtenerAtractivoespe

    public function obtenerAtractivoId($idAtractivo) {
        return $this->atractivoData->obtenerAtractivoId($idAtractivo);
    }//obteneratractivoId

    public function registrarAtractivoBayes($atractivo, $distancia, $tiempo) {
        return $this->atractivoData->registrarAtractivoBayes($atractivo, $distancia, $tiempo);
    }//crear Atractivo

    public function obtenerAtractivoBayes() {
        return $this->atractivoData->obtenerAtractivoBayes();
    }//obteneratractivoBayes

    public function eliminarAtractivoBayes() {
        return $this->atractivoData->eliminarAtractivoBayes();
    }//eliminarAtractivoBayes

    public function eliminarAtractivo($idAtractivo) {
        return $this->atractivoData->eliminarAtractivo($idAtractivo);
    }//eliminarAtractivo

    public function obtenerTiposTerreno(){
        return $this->atractivoData->obtenerTiposTerreno();
    }//obtenerTiposTerreno

}//class

?>