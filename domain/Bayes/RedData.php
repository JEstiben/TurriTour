<?php

include_once 'data.php';

class RedData extends Data{

    public function obtenerRed() {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT * FROM tb_red";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $redes = [];
        /*Red(confiabilidad, enlaces, capacidad, costo, clase)*/
        while ($row = mysqli_fetch_array($result)) {
            $redActual = new Red($row['confiabilidad'], $row['numero_conexiones'], strtoupper($row['capacidad']), strtoupper($row['costo']), strtoupper($row['clase']));
            /*se convierte la capacidad de texto HIGH, MEDIUM o LOW a valores numéricos 10, 5 y 1. Esto es para poder calcularlos mejor*/
            switch ($redActual->getCapacidad()) {
                case 'HIGH':
                        $redActual->setCapacidad(3);
                    break;
                case 'MEDIUM':
                        $redActual->setCapacidad(2);
                    break;
                case 'LOW':
                        $redActual->setCapacidad(1);
                    break;
                default:
                    $redActual->setCapacidad(1);
                break;
            }//switch capacidad
            /*se convierte el costo de texto HIGH, MEDIUM o LOW a valores numéricos 10, 5 y 1. Esto es para poder calcularlos mejor*/
            switch ($redActual->getCosto()) {
                case 'HIGH':
                        $redActual->setCosto(3);
                    break;
                case 'MEDIUM':
                        $redActual->setCosto(2);
                    break;
                case 'LOW':
                        $redActual->setCosto(1);
                    break;
                default:
                    $redActual->setCosto(1);
                break;
            }//switch costo
                
            array_push($redes, $redActual);
        }//while
        return $redes;
    }//function  

    public function obtenerClases() {

        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT DISTINCT clase FROM tb_red";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $clases = [];
        while ($row = mysqli_fetch_array($result)) {
            $claseActual = strtoupper($row['clase']);

            array_push($clases, $claseActual);
        }//while
        return $clases;

    }//obtenerClases 

}//class