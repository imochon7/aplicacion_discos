<?php

class Controller {

    private $modelo, $sesion, $user = null;

    function __construct(Model $modelo) {
        $this->modelo = $modelo;
        $this->modelo->addData('titulo','Notas');
        $this->modelo->addData('tituloLargo','Guarda tus Notas');
        $this->modelo->addFile('archivo-acceso', 'acceso-estoylogout.html');
        $this->modelo->addFile('archivo-titulo', 'titulo-estoylogout.html');
        $this->sesion = Session::getInstance('appNotas');
        if($this->sesion->isLogged()) {
            $this->modelo->addFile('archivo-acceso', 'acceso-estoylogin.html');
            $this->modelo->addFile('archivo-titulo', 'titulo-estoylogin.html');
        }
        /*$this->sesion = Session::getInstance('appNotas');
        $this->modelo->addData('titulo','Notas');
        $this->modelo->addData('tituloLargo','Guarda tus Notas');
        $this->modelo->addData('login','');
        $this->modelo->addData('mensaje','');
        $this->modelo->addData('modales','');
        $this->modelo->addData('titulomain','');
        if($this->sesion->isLogged()) {
            $this->user = $this->sesion->getUser();
            $this->modelo->addData('correo', $this->user->getEmail());
            $this->modelo->addFile('modales', 'modales-perfil.html');
            $this->modelo->addFile('menu', 'menu-logout.html');
        } else {
            $this->modelo->addFile('menu', 'menu-login.html');
            $this->modelo->addFile('modales', 'modales.html');
            $this->modelo->addFile('titulomain', 'titulomain.html');
        }*/
    }

    function getModel() {
        return $this->modelo;
    }
    
    function getSession() {
        return $this->sesion;
    }
    
    function getUser() {
        return $this->user;
    }

    /* acciones */

    function main() {
        $login = Request::read('op');
        $r = Request::read('r');
        if($login === 'login' && $r === '1'){
            //$texto = Util::renderFile('templates/materialize/login.html', $this->modelo->getData());
            $this->modelo->addFile('mensaje', 'mensaje-login.html');
        }
        $this->modelo->addData('contenido', 'Página principal');
    }
    
}