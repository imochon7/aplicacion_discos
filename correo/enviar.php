<?php
session_start();

$origen = "imochon7@gmail.com"; //correo
$alias = ""; // 
$destino = ""; //correo destino
$asunto = "Prueba de correo";
$mensaje = "¿Llegará?";

require_once '../credenciales/vendor/autoload.php';
$cliente = new Google_Client();
$cliente->setApplicationName('enviarcorreoc9');
$cliente->setAccessToken(file_get_contents('../credenciales/token.conf'));
if ($cliente->getAccessToken()) {
    $service = new Google_Service_Gmail($cliente);
    try {
        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->From = $origen;
        $mail->FromName = $alias;
        $mail->AddAddress($destino);
        $mail->AddReplyTo($origen, $alias);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;
        $mail->preSend();
        $mime = $mail->getSentMIMEMessage();
        $mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
        $mensaje = new Google_Service_Gmail_Message();
        $mensaje->setRaw($mime);
        $service->users_messages->send('me', $mensaje);
        echo "Correo enviado correctamente";
    } catch (Exception $e) {
        echo ("Error en el envío del correo: ".$e->getMessage());
    }
} else {
    echo "no conectado con gmail";
}