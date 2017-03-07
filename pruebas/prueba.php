<?php

$texto = "hola {nombre}, ¿de verdad, que eres {nombre} de {edad} años? expresión: {f(n) = f(n - 1) * 2;}<br>";
$textoBusco = "nombre";
$textoReemplaza = "Pepe";

$text = str_replace('{' . $textoBusco . '}', $textoReemplaza, $texto);

echo $text;

$array = array('nombre'=>'Juan' , 'edad' => '12');

$text = $texto;
foreach($array as $indice => $valor ){
    $text = str_replace('{' . $indice . '}', $valor, $text);
}

echo $text;