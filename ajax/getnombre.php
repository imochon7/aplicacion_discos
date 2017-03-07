<?php
//header('Content-Type: application/json');

$nombres = array(
    'juan',
    'pepe',
    'ana',
    'carmen'
);
$apellidos = array(
    'lópez',
    'pérez',
    'gómez',
    'fernández'
);
$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$cadenaNombre = "sin nombre";
if(isset($nombres[$nombre])) {
    $cadenaNombre = $nombres[$nombre];
}
$cadenaApellido = "sin apellido";
if(isset($apellidos[$apellido])) {
    $cadenaApellido = $apellidos[$apellido];
}
require 'NombreCompleto.php';
$nombreCompleto = new NombreCompleto($cadenaNombre, $cadenaApellido);
echo $nombreCompleto->json();
//echo '{ "nombre" : "' . $cadenaNombre . '", "apellido" : "' . $cadenaApellido . '" } ';