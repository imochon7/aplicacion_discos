<?php

class ViewUser {

    private $modelo;

    function __construct(Model $modelo) {
        $this->modelo = $modelo;
    }

    function getModel() {
        return $this->modelo;
    }

    function render(){
        $plantilla = './template/html';
        $this->getModel()->addData('plantilla', $plantilla);
        return Util::renderFile($plantilla . '/admin.html', $this->getModel()->getData());
    }

}