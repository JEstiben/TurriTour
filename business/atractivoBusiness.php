<?php
if (isset($_POST['crearAtractivo']) || isset($_POST['actualizarAtractivo']) || isset($_POST['eliminarAtractivo'])) {
    include_once '../../data/atractivoData/atractivoData.php';
}else {
    include_once '../data/atractivoData/atractivoData.php';
}
class atractivoBusiness {

    private $atractivoData;

    public function atractivoBusiness() {
        $this->atractivoData = new atractivoData();
    }//constructor

    public function crearAtractivo($atractivo) {
        return $this->atractivoData->crearAtractivo($atractivo);
    }//crear Atractivo

    public function obtenerAtractivo() {
        return $this->atractivoData->obtenerAtractivo();
    }//obteneratractivo

    public function obtenerAtractivoId($idAtractivo) {
        return $this->atractivoData->obtenerAtractivoId($idAtractivo);
    }//obteneratractivoId

    public function eliminarAtractivo($idAtractivo) {
        return $this->atractivoData->eliminarAtractivo($idAtractivo);
    }//eliminarAtractivo
}//class

?>