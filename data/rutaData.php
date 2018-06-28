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

        $queryInsert = "INSERT INTO tb_ruta VALUES ("
        .$ruta->getIdRuta()."". "," .
        "'".$ruta->getDistancia()."'". "," .
        "'".$ruta->getTiempo()."'". "," .
        "'".$ruta->getPuntoInicial()."'". "," .
        "'".$ruta->getPuntoFinal()."'". "," .
        "'".$ruta->getTipoCamino()."'". ");";

        $resultado = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);

        /*if($resultado){
            return ("true");
        }else{
            return ("false");
        }//if-else*/
        return $queryInsert;

    }//crear Atractivo

    public function registrarRutaEuclides($ruta) {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');
        
        $queryContador = "SELECT COUNT(*) + 1 FROM tb_ruta_euclides;";
        $resultadoContador = mysqli_query($conn,$queryContador);
        $id_ruta = 0;

        while($row=mysqli_fetch_row($resultadoContador)){
            $id_ruta = $row[0];
        }//end while

        $queryInsert = "INSERT INTO tb_ruta_euclides VALUES ('".$ruta->getIdRuta()."', " .
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

    public function obtenerRutaEuclides() {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT id_ruta,distancia_ruta,duracion_ruta,punto_partida_ruta,punto_llegada_ruta,tipo_camino_atractivo FROM tb_ruta_euclides ORDER BY id_ruta DESC LIMIT 5;";
        $resultado = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $rutas = [];

        while ($row = mysqli_fetch_array($resultado)) {
            $ruta = new ruta($row['id_ruta'], $row['punto_partida_ruta'], $row['punto_llegada_ruta'],
            $row['duracion_ruta'],$row['distancia_ruta'], $row['tipo_camino_atractivo']);
            array_push($rutas, $ruta);
        }//end while

        return $rutas;
    }//obteneratractivo

    public function obtenerRuta() {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT * FROM tb_ruta;";
        $resultado = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $atrativo = [];

        while ($row = mysqli_fetch_array($resultado)) {
            $atractivo = new ruta($row['id_ruta'], $row['punto_partida_ruta'], $row['punto_llegada_ruta'],
            $row['duracion_ruta'],$row['distancia_ruta'], $row['tipo_camino_atractivo']);
            array_push($atrativo, $atractivo);
        }//end while

        return $atrativo;
    }//obteneratractivo

    public function obtenerRutaId($idRuta) {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT * FROM tb_ruta_euclides Where id_ruta = '".$idRuta."';";
        $resultado = mysqli_query($conn, $querySelect);
        mysqli_close($conn);

        while ($row = mysqli_fetch_array($resultado)) {
            $ruta = new ruta($row['id_ruta'], $row['punto_partida_ruta'], $row['punto_llegada_ruta'],
            $row['duracion_ruta'],$row['distancia_ruta'], $row['tipo_camino_atractivo']);
        }//end while

        return $ruta;
    }//obteneratractivoId

    public function eliminarRutas() {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $queryDelete = "DELETE FROM tb_ruta;";

        $resultado = mysqli_query($conn, $queryDelete);
        mysqli_close($conn);

        if($resultado){
            return ("true");
        }else{
            return ("false");
        }//if-else
    }//eliminarAtractivo

    public function eliminarRutasEuclides() {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $queryDelete = "DELETE FROM tb_ruta_euclides;";

        $resultado = mysqli_query($conn, $queryDelete);
        mysqli_close($conn);

        if($resultado){
            return ("true");
        }else{
            return ("false");
        }//if-else
    }//eliminarAtractivo

}//end class

?>