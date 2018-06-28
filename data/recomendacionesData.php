<?php

include_once 'data.php';
include_once 'atractivoData.php';
include_once 'euclides.php';
include_once 'Bayes.php';
include '../domain/atractivoBayes.php';

class recomendacionesData extends Data {

    private $respuesta = Array();

    private $atributos = ['distancia', 'duracion', 'tipoCamino'];

	public function recomendacionesEuclides($distancia, $duracion, $tipoCamino){
        $datosUsuario = array('distancia' => $distancia, 'duracion' => $duracion, 'tipoCamino' => $this->tipoCamino($tipoCamino));

        $conexion = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conexion->set_charset('utf8');

        $consulta = "SELECT * FROM tb_ruta;";

        $resultado = mysqli_query($conexion, $consulta);
        mysqli_close($conexion);

        $registrosBaseDatos = [];

        while ($registro = mysqli_fetch_array($resultado)) {
            $registrosBaseDatosActual = array(
                'id' => $registro['id_ruta'],
                'distancia' => $registro['distancia_ruta'],
                'duracion' => $registro['duracion_ruta'],
                'origen' => $registro['punto_partida_ruta'],
                'destino' => $registro['punto_llegada_ruta'],
                'tipoCamino' => $registro['tipo_camino_atractivo']);
            array_push($registrosBaseDatos, $registrosBaseDatosActual);
        }//end while

        $rutas = euclides($datosUsuario, $registrosBaseDatos, $this->atributos);
        if(count($rutas) > 0){
            return ("true");
        }else{
            return ("false");
        }
    }//recomendacionesEuclides

    public function recomendacionesBayes($distancia, $duracion, $tipoCamino){
        $atractivoBayes = new atractivoBayes(0, 0, 0, 0, 0, 0, 0, $this->tipoCamino($tipoCamino), $distancia, $duracion);
        
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT * FROM tb_ruta";

        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);

        $atractivos = [];
        
        while ($registro = mysqli_fetch_array($result)) {
            $atractivoActual = new atractivoBayes($registro['id_ruta'], $registro['punto_llegada_ruta'], 0, 0, 0, 0, 0, $this->tipoCamino($registro['tipo_camino_atractivo']), $registro['distancia_ruta'], $registro['duracion_ruta']);
            array_push($atractivos, $atractivoActual);
        }//while

        //tengo dudas
        $clases = $this->obtenerClases();//clases posibles de la clase
        
        $bayes = calcularBayes($atractivoBayes, $atractivos, $clases,4);
          
        $claseResultado = "";
        $max = 0;

        $atractivoData = new atractivoData();
        $atractivoData->eliminarAtractivoBayes();

        $contador = 0;

        foreach ($bayes as $bayesActual) {
            if($bayesActual['probabilidadFinal'] > $max){
                $contador++;
                foreach ($atractivos as $atractivoActual) {
                    if($atractivoActual->getIdAtractivo() == $bayesActual['clase']){
                        $atractivo = new atractivo($bayesActual['clase'], $atractivoActual->getNombreAtractivo(), 0, 0, 0, 0, 0, 0);
                        $atractivoData->registrarAtractivoBayes($atractivo, $atractivoActual->getDistancia(), $atractivoActual->getDuracion());
                    }
                }
                $claseResultado = $bayesActual['clase'];
                $max = $bayesActual['probabilidadFinal'];
            }
        }
        
        if($contador = 0){
            return ("false");
        }else{
            return ("true");
        }
    }//recomendacionesBayes

    public function tipoCamino($tipoCamino){
        switch ($tipoCamino) {
            case 'Asfalto':
                return 1;
            case 'Piedra':
                return 2;
            case 'Tierra':
                return 3;
            default:
                return 2;
        }//switch
    }//tipoCamino

    public function obtenerClases() {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT DISTINCT id_ruta FROM tb_ruta";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $clases = [];
        while ($row = mysqli_fetch_array($result)) {
            $claseActual = $row['id_ruta'];

            array_push($clases, $claseActual);
        }//while
        return $clases;

    }//obtenerClases

}//end class

?>