<?php

include_once 'data.php';
include_once 'euclides.php';

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

}//end class

?>