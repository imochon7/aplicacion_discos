<?php

class Model {

    private $data = array();

    function __construct() {
    }

    function addData($name, $data) {
        $this->data[$name] = $data;
    }

    function getData() {
        return $this->data;
    }
    
    function doSaludo(){
        $this->addData('otro', 'Soy do saludo');
    }

}
