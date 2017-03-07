<?php

session_start();
require_once 'vendor/autoload.php';
$cliente = new Google_Client();
$cliente->setApplicationName('enviarcorreoc9');
$cliente->setClientId('472368390447-t0a33f3vud66pn45i4l7ce9pl86djesa.apps.googleusercontent.com');
$cliente->setClientSecret('5qtie95oL893bSrciW6a2B4S');
$cliente->setRedirectUri('https://workspace3-imochon7.c9users.io/credenciales/guardarCredenciales.php');
$cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
$cliente->setAccessType('offline');
if (isset($_GET['code'])) {
   $cliente->authenticate($_GET['code']);
   $_SESSION['token'] = $cliente->getAccessToken();
   $archivo = "token.conf";
   $fh = fopen($archivo, 'w') or die("error");
   fwrite($fh, json_encode($cliente->getAccessToken()));
   fclose($fh);
}
//472368390447-t0a33f3vud66pn45i4l7ce9pl86djesa.apps.googleusercontent.com >> id cliente
//5qtie95oL893bSrciW6a2B4S >> secreto cliente
//enviarcorreoc9 >> nombre del proyecto

//composer require google/apiclient:^2.0
//composer requiere phpmailer/phpmailer
