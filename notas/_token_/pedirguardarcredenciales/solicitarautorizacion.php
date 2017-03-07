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
if (!$cliente->getAccessToken()) {
   $auth = $cliente->createAuthUrl();
   header("Location: $auth");
}