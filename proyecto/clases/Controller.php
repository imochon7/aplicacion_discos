<?php

class Controller {

    private $modelo;

    function __construct(Model $modelo) {
        $this->modelo = $modelo;
    }

    function getModel() {
        return $this->modelo;
    }

    //ACCIONES
    //predeterminada
    function main() {
        $this->modelo->addData('contenido','Soy el metodo main del controlador.');
    }
    
    function otro(){
        $this->modelo->addData('contenido','Soy el metodo otro del controlador.');
    }
    
    function saludo(){
        $this->modelo->doSaludo();
        $this->modelo->addData('contenido','Hola, que tal.');
    }
}