<?php

include_once 'data.php';

class sesionData extends Data {
    public function iniciarSesion($correo, $contrasena) {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');
        
        $querySelect = "SELECT * FROM tb_adm WHERE correo = '".$correo."' AND contrasena = '".$contrasena."';";
        $resultadoSelect = mysqli_query($conn,$querySelect);
        mysqli_close($conn);

        $resultado = "false";

        while($row = mysqli_fetch_row($resultadoSelect)){
            $resultado = "true";
        }//end while

        return $resultado;

    }//iniciarSesion

}//end class

?>