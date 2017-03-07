<?php

class Autor {
    
    private $id, $nombre;
    
    function __construct($id = null, $nombre = null) {
        $this->id = $id;
        $this->nombre = $nombre;
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function __toString() {
        $r = '';
        foreach($this as $key => $valor) {
            $r .= "$key => $valor - ";
        }
        return $r;
    }
    
    function read(ObjectReader $reader = null){
        if($reader===null){
            $reader = 'Request';
        }
        foreach($this as $key => $valor) {
            $this->$key = $reader::read($key);
        }
    }
    
    function readApelo(ObjectReader $reader = null){
        if($reader===null){
            $reader = 'Request';
        }
        $this->id = $reader::read('idAutor');
        $this->nombre = $reader::read('nombre');
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
    }
    
    function isValid() {
        if($this->nombre === null ) {
            return false;
        }
        return true;
    }

}