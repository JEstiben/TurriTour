<?php

include_once 'data.php';
include_once 'euclides.php';

class recomendacionesData extends Data {

    private $respuesta = Array();

    private $atributos = ['distancia', 'duracion', 'tipoCamino'];

	public function recomendaciones($distancia, $duracion, $tipoCamino){
        $datosUsuario = array('distancia' => $distancia, 'duracion' => $duracion, 'tipoCamino' => $this->tipoCamino($tipoCamino));

        $conexion = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conexion->set_charset('utf8');

        $consulta = "SELECT * FROM tb_ruta;";

        $resultado = mysqli_query($conexion, $consulta);
        mysqli_close($conexion);

        $registrosBaseDatos = [];
        //$atractivos = $this->atractivos($tipoCamino);

        while ($registro = mysqli_fetch_array($resultado)) {
            $registrosBaseDatosActual = array(
                'id' => $registro['id_ruta'],
                'distancia' => $registro['distancia_ruta'],
                'duracion' => $registro['duracion_ruta'],
                'origen' => $registro['punto_partida_ruta'],
                'destino' => $registro['punto_llegada_ruta'],
                'tipoCamino' => $registro['tipo_camino_atractivo']);
            //$registrosBaseDatosActual["atractivos"] = $atractivos;
            array_push($registrosBaseDatos, $registrosBaseDatosActual);
        }//end while

        $rutas = euclides($datosUsuario, $registrosBaseDatos, $this->atributos);
        if(count($rutas) > 0){
            return ("true");
        }else{
            return ("false");
        }
    }//recomendaciones

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

    /*public function atractivos($tipoCamino) {
        $conexion = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conexion->set_charset('utf8');

        $consulta = "SELECT * FROM tb_atractivo Where tipo_camino_atractivo = '".$tipoCamino."';";
        
        $resultado = mysqli_query($conexion, $consulta);
        mysqli_close($conexion);

        $atractivos = Array();

        $contador = 1;
        while ($registro = mysqli_fetch_array($resultado)) {
            if($contador != 4 && ($registro['id_atractivo'] % 2)==0){
                $data = Array();
                $data['id'] = $registro['id_atractivo'];
                $data['nombre'] = $registro['nombre_atractivo'];
                $data['descripcion'] = $registro['descripcion_atractivo'];
                $data['imagen'] = $registro['imagen_atractivo'];
                $data['video'] = $registro['video_atractivo'];
                $data['latitud'] = $registro['latitud_atractivo'];
                $data['longitud'] = $registro['longitud_atractivo'];
                $data['tipoCamino'] = $registro['tipo_camino_atractivo'];
                $atractivos[] = $data;
                $contador = $contador + 1;
            }
        }//end while

        return $atractivos;
    }//atractivos*/

}//end class

?>