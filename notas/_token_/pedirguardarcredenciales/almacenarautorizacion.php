<?php
session_start();
require_once '../clases/vendor/autoload.php';
$cliente = new Google_Client();

$cliente->setApplicationName('TU_PROYECTO');
$cliente->setClientId('TU_ID');
$cliente->setClientSecret('TU_SECRET');
$cliente->setRedirectUri('TU_PAGINA_PARA_GUARDAR_LA_AUTORIZACION');

$cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
$cliente->setAccessType('offline');
if (isset($_GET['code'])) {
   $cliente->authenticate($_GET['code']);
   $_SESSION['token'] = $cliente->getAccessToken();
   $archivo = "token/token.conf";
   $fh = fopen($archivo, 'w') or die("error");
   fwrite($fh, json_encode($cliente->getAccessToken()));
   fclose($fh);
}