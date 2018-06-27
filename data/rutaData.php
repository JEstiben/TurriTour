<?php

include_once 'data.php';
include '../domain/ruta.php';

class rutaData extends Data {

    public function registrarRuta($ruta) {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');
        
        $queryContador = "SELECT COUNT(*) + 1 FROM tb_ruta;";
        $resultadoContador = mysqli_query($conn,$queryContador);
        $id_ruta = 0;

        while($row=mysqli_fetch_row($resultadoContador)){
            $id_ruta = $row[0];
        }//end while

        $queryInsert = "INSERT INTO tb_ruta VALUES (" . $id_ruta . ", " .
        "".$ruta->getIdRuta()."". "," .
        "'".$ruta->getDistancia()."'". "," .
        "'".$ruta->getTiempo()."'". "," .
        "'".$ruta->getPuntoInicial()."'". "," .
        "'".$ruta->getPuntoFinal()."'". "," .
        "'".$ruta->getTipoCamino()."'". ");";

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

    public function eliminarRutas() {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $queryInsert = "DELETE FROM tb_ruta;";

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