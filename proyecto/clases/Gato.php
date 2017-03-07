<?php

class Gato {

    private $id, $nombre, $raza, $color;
    
    function __construct($id = null, $nombre = null, $raza = null, $color = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->raza = $raza;
        $this->color = $color;
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getRaza() {
        return $this->raza;
    }

    function getColor() {
        return $this->color;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setRaza($raza) {
        $this->raza = $raza;
    }

    function setColor($color) {
        $this->color = $color;
    }
    
    function isValid() {
        if($this->nombre === null && ($this->color === null || $this->raza === null)){
            return false;
        }
        return true;
    }

    function __toString() {
        $r = '';
        foreach($this as $key => $valor) {
            $r .= "$key => $valor - ";
        }
        return $r;
    }
    
    /*function read($clase = 'Request', $metodo = 'read'){
        foreach($this as $key => $valor) {
            $this->$key = $clase::$metodo($key);
        }
    }*/
    function read(ObjectReader $reader = null){
        if($reader===null){
            $reader = 'Request';
        }
        foreach($this as $key => $valor) {
            $this->$key = $reader::read($key);
        }
    }
    
    function get(){
        $nuevoArray = array();
        foreach($this as $key => $valor) {
            $nuevoArray[$key] = $valor;
        }
        return $nuevoArray;
    }
    
    function set(array $array, $inicio = 0) {
        $this->id = $array[0 + $inicio];
        $this->nombre = $array[1 + $inicio];
        $this->raza = $array[2 + $inicio];
        $this->color = $array[3 + $inicio];
    }
}