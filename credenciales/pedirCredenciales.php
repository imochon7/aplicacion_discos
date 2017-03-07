<?php

session_start();
require_once 'vendor/autoload.php';
$cliente = new Google_Client();
$cliente->setApplicationName('enviarcorreoc9'); //nombre del proyecto
$cliente->setClientId('472368390447-t0a33f3vud66pn45i4l7ce9pl86djesa.apps.googleusercontent.com'); //id cliente
$cliente->setClientSecret('5qtie95oL893bSrciW6a2B4S'); //secreto cliente
$cliente->setRedirectUri('https://workspace3-imochon7.c9users.io/credenciales/guardarCredenciales.php'); //ruta guardarCredenciales.php 
$cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
$cliente->setAccessType('offline');
if (!$cliente->getAccessToken()) {
   $auth = $cliente->createAuthUrl();
   header("Location: $auth");
}
