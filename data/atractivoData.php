<?php

include_once 'data.php';
include '../domain/atractivo.php';

class atractivoData extends Data {
    public function crearAtractivo($atractivo) {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');
        
        $queryContador = "SELECT COUNT(*) + 1 FROM tb_atractivo;";
        $resultadoContador = mysqli_query($conn,$queryContador);
        $id_atractivo = 0;

        while($row=mysqli_fetch_row($resultadoContador)){
            $id_atractivo = $row[0];
        }//end while

        $queryInsert = "INSERT INTO tb_atractivo VALUES (" . $id_atractivo . ", " .
        "'".$atractivo->getNombreAtractivo()."'". "," .
        "'".$atractivo->getDescripcionAtractivo()."'". "," .
        "'".$atractivo->getImagenAtractivo()."'". "," .
        "'".$atractivo->getVideoAtractivo()."'". "," .
        "'".$atractivo->getLatitudAtractivo()."'". "," .
        "'".$atractivo->getLongitudAtractivo()."'". "," .
        "'".$atractivo->getTipoCaminoAtractivo()."'". ");";

        $resultado = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);

        if($resultado){
            return ("true");
        }else{
            return ("false");
        }//if-else

    }//crear Atractivo

    public function obtenerAtractivo() {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT * FROM tb_atractivo;";
        $resultado = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $atrativo = [];

        while ($row = mysqli_fetch_array($resultado)) {
            $atractivo = new atractivo($row['id_atractivo'], $row['nombre_atractivo'], $row['descripcion_atractivo'],
            $row['imagen_atractivo'],$row['video_atractivo'], $row['longitud_atractivo'], $row['latitud_atractivo'],
            $row['tipo_camino_atractivo']);
            array_push($atrativo, $atractivo);
        }//end while

        return $atrativo;
    }//obteneratractivo

    public function obtenerAtractivoId($idAtractivo) {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT * FROM tb_atractivo Where id_atractivo = '".$idAtractivo."';";
        $resultado = mysqli_query($conn, $querySelect);
        mysqli_close($conn);

        while ($row = mysqli_fetch_array($resultado)) {
            $atractivo = new atractivo($row['id_atractivo'], $row['nombre_atractivo'], $row['descripcion_atractivo'],
            $row['imagen_atractivo'],$row['video_atractivo'], $row['longitud_atractivo'], $row['latitud_atractivo'],
            $row['tipo_camino_atractivo']);
        }//end while

        return $atractivo;
    }//obteneratractivoId

    public function eliminarAtractivo($idAtractivo) {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $queryInsert = "DELETE FROM tb_atractivo WHERE id_atractivo = '".$idAtractivo."';";

        $resultado = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);

        if($resultado){
            return ("true");
        }else{
            return ("false");
        }//if-else
    }//eliminarAtractivo

}//end class

?>