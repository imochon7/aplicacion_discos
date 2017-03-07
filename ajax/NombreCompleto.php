<?php

class NombreCompleto {
    
    private $nombre, $apellido;
    
    function __construct($nombre = null, $apellido = null) {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }
    
    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
        return $this;
    }

    public function __toString() {
        $r = '';
        foreach($this as $key => $valor) {
            $r .= "$key => $valor - ";
        }
        return $r;
    }
    
    /*function read(ObjectReader $reader = null){
        if($reader===null){
            $reader = 'Request';
        }
        foreach($this as $key => $valor) {
            $this->$key = $reader::read($key);
        }
    }*/
    
    function get(){
        $nuevoArray = array();
        foreach($this as $key => $valor) {
            $nuevoArray[$key] = $valor;
        }
        return $nuevoArray;
    }
    
    function set(array $array, $inicio = 0) {
        $this->nombre = $array[0 + $inicio];
        $this->apellido = $array[1 + $inicio];
    }
    
    function json() {
        return json_encode($this->get());
    }

}