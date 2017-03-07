<?php

class View {

    private $modelo;

    function __construct(Model $modelo) {
        $this->modelo = $modelo;
    }

    function getModel() {
        return $this->modelo;
    }

    function render() {
        $plantilla = './templates/materialize';+
        $this->getModel()->addData('plantilla', $plantilla);
        $archivos = $this->getModel()->getFiles();
        foreach($archivos as $placeholder => $archivo) {
            $this->getModel()->addData($placeholder, 
                Util::renderFile($plantilla . '/' . $archivo, $this->getModel()->getData()));
        }
        return Util::renderFile($plantilla . '/index.html', $this->getModel()->getData());
    }

}