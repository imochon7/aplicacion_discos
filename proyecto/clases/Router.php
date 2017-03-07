<?php

class Router {

    private $rutas = array();

    function __construct() {
        $this->rutas['index'] = new Route('Model', 'View', 'Controller');
        $this->rutas['otra'] = new Route('Model', 'View', 'ControllerOtra');
        $this->rutas['index2'] = new Route('Model', 'ViewDiferente', 'Controller');
        $this->rutas['gato'] = new Route('ModelGato', 'ViewGato', 'ControllerGato');
        $this->rutas['usuario'] = new Route('ModelUsuario', 'ViewUsuario', 'ControllerUsuario');
        //...
    }

    function getRoute($ruta) {
        if (!isset($this->rutas[$ruta])) {
            return $this->rutas['index'];
        }
        return $this->rutas[$ruta];
    }

}