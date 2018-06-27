<?php

include_once '../data/sesionData.php';

class sesionBusiness {

    private $sesionData;

    public function sesionBusiness() {
        $this->sesionData = new sesionData();
    }//constructor

    public function iniciarSesion($correo, $contraseña) {
        return $this->sesionData->iniciarSesion($correo, $contraseña);
    }//iniciarSesion
}//class

?>