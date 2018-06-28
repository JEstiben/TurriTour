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

    public function modificarAtractivo($atractivo) {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $queryUpdate = "UPDATE tb_atractivo SET nombre_atractivo = '".$atractivo->getNombreAtractivo().
        "', descripcion_atractivo = '".$atractivo->getDescripcionAtractivo().
        "', imagen_atractivo = '".$atractivo->getImagenAtractivo().
        "', video_atractivo = '".$atractivo->getVideoAtractivo().
        "', latitud_atractivo = '".$atractivo->getLatitudAtractivo().
        "', longitud_atractivo = '".$atractivo->getLongitudAtractivo().
        "', tipo_camino_atractivo = '".$atractivo->getTipoCaminoAtractivo()."' Where id_atractivo = '".$atractivo->getIdAtractivo()."';";

        $resultado = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        if($resultado){
            return ("true");
        }else{
            return ("false");
        }//if-else

    }//modificarAtractivo

    public function obtenerTiposTerreno() {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT DISTINCT tipo_camino_atractivo FROM tb_atractivo";
        $resultado = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $terreno = [];

        while ($row = mysqli_fetch_array($resultado)) {
            //tipo_camino_atractivo
            $terrenoActual = $row['tipo_camino_atractivo'];
            array_push($terreno, $terrenoActual);
        }//end while

        return $terreno;
    }//obtenerTipos de Camino

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

    public function obtenerAtractivoespe($tipo) {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT * FROM tb_atractivo where tipo_camino_atractivo = '".$tipo."' LIMIT 3;";
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

    public function registrarAtractivoBayes($atractivo, $distancia, $tiempo) {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT * FROM tb_atractivo Where id_atractivo = '".$atractivo->getIdAtractivo()."';";
        $resultadoSelect = mysqli_query($conn,$querySelect);

        while($row = mysqli_fetch_array($resultadoSelect)){
            $atractivo->setNombreAtractivo($row['nombre_atractivo']);
            $atractivo->setDescripcionAtractivo($row['descripcion_atractivo']);
            $atractivo->setImagenAtractivo($row['imagen_atractivo']);
            $atractivo->setVideoAtractivo($row['video_atractivo']);
            $atractivo->setLatitudAtractivo($row['latitud_atractivo']);
            $atractivo->setLongitudAtractivo($row['longitud_atractivo']);
            $atractivo->setTipoCaminoAtractivo($row['tipo_camino_atractivo']);
        }//end while

        $queryInsert = "INSERT INTO tb_atractivo_valles VALUES ('".$atractivo->getIdatractivo()."', " .
        "'".$atractivo->getNombreAtractivo()."'". "," .
        "'".$atractivo->getDescripcionAtractivo()."'". "," .
        "'".$atractivo->getImagenAtractivo()."'". "," .
        "'".$atractivo->getVideoAtractivo()."'". "," .
        "'".$atractivo->getLatitudAtractivo()."'". "," .
        "'".$atractivo->getLongitudAtractivo()."'". "," .
        "'".$atractivo->getTipoCaminoAtractivo()."'". "," .
        "'".$distancia."'". "," .
        "'".$tiempo."'". ");";

        $resultado = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);

        if($resultado){
            return ("true");
        }else{
            return ("false");
        }//if-else

    }//crear Atractivo

    public function obtenerAtractivoBayes() {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT * FROM tb_atractivo_valles;";
        $resultado = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $atrativos = [];

        while ($row = mysqli_fetch_array($resultado)) {
            $atractivo = new atractivo($row['id_atractivo'], $row['nombre_atractivo'], $row['descripcion_atractivo'],
            $row['imagen_atractivo'],$row['video_atractivo'], $row['longitud_atractivo'], $row['latitud_atractivo'],
            $row['tipo_camino_atractivo']);
            array_push($atrativos, $atractivo);
        }//end while

        return $atrativos;
    }//obteneratractivoBayes

    public function eliminarAtractivoBayes() {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $queryDelete = "DELETE FROM tb_atractivo_valles;";

        $resultado = mysqli_query($conn, $queryDelete);
        mysqli_close($conn);

        if($resultado){
            return ("true");
        }else{
            return ("false");
        }//if-else
    }//eliminarAtractivoBayes

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