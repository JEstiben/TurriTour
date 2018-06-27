<?php

include '../../data/restApiData/restApiData.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $restApiData = new restApiData();
    $restApiData = $restApiData->rutas($_POST['distancia'], $_POST['duracion'], $_POST['tipoCamino'], $_POST['latitudGPS'], $_POST['longitudGPS']);
}else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$restApiData = new restApiData();
    $restApiData = $restApiData->atractivos();
}//if-else
?>
