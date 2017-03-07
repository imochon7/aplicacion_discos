<?php
require 'NombreCompleto.php';

$nc1 = new NombreCompleto('Juan', 'López');
$nc2 = new NombreCompleto('Pepe', 'Pérez');

$array = array();
$array[] = $nc1->get();
$array[] = $nc2->get();

echo json_encode($array);
echo '<br>';
echo json_encode($array, JSON_FORCE_OBJECT);

echo '<hr>';
$arrytest = array(array('a'=>1, 'b'=>2),array('c'=>3),array('d'=>4));
echo json_encode($arrytest);
echo '<br>';
echo json_encode($arrytest, JSON_FORCE_OBJECT);