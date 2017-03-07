<?php

class Usuario {
    
    private $email, $password, $falta, $tipo, $estado;
    
    function __construct($email = null, $password = null, $falta = null, $tipo = null, $estado = null) {
        $this->email = $email;
        $this->password = $password;
        $this->falta = $falta;
        $this->tipo = $tipo;
        $this->estado = $estado;
    }
    
    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getFalta() {
        return $this->falta;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getEstado() {
        return $this->estado;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setFalta($falta) {
        $this->falta = $falta;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
    
    function isValid() {
        if($this->email === null || $this->password === null){
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
        $this->email = $array[0 + $inicio];
        $this->password = $array[1 + $inicio];
        $this->falta = $array[2 + $inicio];
        $this->tipo = $array[3 + $inicio];
        $this->estado = $array[4 + $inicio];
    }

}