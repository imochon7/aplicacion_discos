<?php

class Controller {

    private $modelo, $sesion, $usuario;

    function __construct(Model $modelo) {
        $this->modelo = $modelo;
        $this->sesion = Session::getInstance(Constants::SESSIONNAME);
    }

    function getModel() {
        return $this->modelo;
    }
    
    function getSession() {
        return $this->sesion;
    }

    function getUser(){
        return $this->usuario;
    }
    
    function getDiscoPageController(){
        return $this->getModel()->getDiscosPageController( Request::get( 'pagina' ) );
    }
    
    function getUsuarioPageController(){
        return $this->getModel()->getUsuarioPageController( Request::get( 'pagina' ) );
    }

    /* acciones */
    
    function main(){
        header('Location: index.php?ruta=disco&accion=view_lista_discos');
    }
    
    function login(){
        $this->modelo->addFile( 'menu', Util::renderFile( 'template/html/menu/menu-vacio.html' ) );
        $this->modelo->addFile( 'contenido', Util::renderFile( 'template/html/login.html' ) );
        $this->modelo->addFile( 'paginacion', Util::renderFile( 'template/html/paginacion/pag-vacio.html' ) );
    }

    // function main() {
    //     $this->modelo->addData('contenido','bienvenido visitante');
    // }
    
    // function login() {
    //     header('Location: index.php?ruta=usuario&accion=view_login');
    // }
    
    // function app(){
    //     header('Location: index.php?ruta=usuario&accion=view_app');
    // }
    
    // function alta(){
    //     header('Location: index.php?ruta=usuario&accion=view_alta');
    // }
    
    // function altaDisco(){
    //     header('Location: index.php?ruta=disco&accion=view_altaDisco');
    // }
    
    // /*
    // function heverflever(){
    //     $this->modelo->addData('contenido','hever flever');
    // }
    // */
    
}