<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../../notas/clases/FileUpload.php');

$archivo = new FileUpload('archivo');
$archivo->setTarget('subido/');
$archivo->addType('pdf');
$archivo->removeType('jpeg');
$archivo->setName('nombredelusuario');
$archivo->setSize(1000);
$r = $archivo->upload();
if($r){
    echo 'resultado: ' . $r;
} else {
    echo 'error al subir';
}