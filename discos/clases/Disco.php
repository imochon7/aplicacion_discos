<?php

class Disco{
    private $id, $title;
    
    function __construct($id=null, $title=null) {
        $this->id = $id;
        $this->title = $title;
    }

    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
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
        $this->id = $reader::read('idDisco');
        $this->title = $reader::read('title');
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
        $this->title = $array[1 + $inicio];
    }
    
    function isValid() {
        if( $this->title === null ) {
            return false;
        }
        return true;
    }

}