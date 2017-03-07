<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$nombre = $_POST['nombre'];

echo $nombre;

require_once('../../notas/clases/ObjectReader.php');
require_once('../../notas/clases/Request.php');

$nombre = Request::read('nombre');

echo $nombre;
echo '<hr>';

//<input type = "file" name = "archivo" />
//$_FILES['archivo'];

if(isset($_FILES['archivo'])){
    
    $error = $_FILES['archivo']['error'];

    if($error !== 0){
        echo 'error: ' . $error;
        echo '<hr>';
    }else {
        echo 'Todo bien.';
        echo '<hr>';
        echo 'nombre: ' . $_FILES['archivo']['name'] . '<br>';
        echo 'tipo mime: ' . $_FILES['archivo']['type'] . '<br>';
        echo 'tamaño: ' . $_FILES['archivo']['size'] . '<br>';
        echo 'nombre temporal: ' . $_FILES['archivo']['tmp_name'] . '<br>';
        if(is_uploaded_file($_FILES['archivo']['tmp_name'])){
            // Sube el archivo a la carpeta 'subido' con el nombre original.
            move_uploaded_file($_FILES["archivo"]["tmp_name"], 'subido/' . $_FILES['archivo']['name']);
        }
        $informacion = pathinfo($_FILES['archivo']['name']);
        echo $informacion['dirname']; // "C:\Users..."
        echo '<br>';
        echo $informacion['basename']; // "archivo.txt"
        echo '<br>';
        echo $informacion['extension']; // "txt"
        echo '<br>';
        echo $informacion['filename']; // "archivo"
    }
}


