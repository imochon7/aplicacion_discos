<?php

class Disco_Autor {
    
    private $id_disco, $id_autor;
    
    function __construct($id_disco = null, $id_autor = null) {
        $this->id_disco = $id_disco;
        $this->id_autor = $id_autor;
    }

    function getId_disco() {
        return $this->id_disco;
    }

    function getId_autor() {
        return $this->id_autor;
    }

    function setId_disco($id_disco) {
        $this->id_disco = $id_disco;
    }

    function setId_autor($id_autor) {
        $this->id_autor = $id_autor;
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
    
    function get(){
        $nuevoArray = array();
        foreach($this as $key => $valor) {
            $nuevoArray[$key] = $valor;
        }
        return $nuevoArray;
    }
    
    function set(array $array, $inicio = 0) {
        $this->id_disco = $array[0 + $inicio];
        $this->id_autor = $array[1 + $inicio];
    }
    
    function isValid() {
        if($this->id_disco === null || $this->id_autor === null ) {
            return false;
        }
        return true;
    }
    
}