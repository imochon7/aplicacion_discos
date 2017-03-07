<?php

class Gestorusuario {
    
    const TABLA = 'usuario';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }

    private static function _getCampos(Usuario $objeto) {
        $campos = $objeto->get();
        return $campos;
    }

    function add(Usuario $objeto) {
        return $this->db->insertParameters(self::TABLA, self::_getCampos($objeto), false);
    }
    
    function activarUsuario($email, $iduser) {
        $sql = 'update usuario '.
               'set estado = 1 '.
               'where email = :email '.
               'and sha1(concat(email, "' . Constantes::SECRET .'")) = :iduser';
        $parametros = array('email' => $email, 'iduser' => $iduser);
        if ($this->db->send($sql, $parametros)){
            return $this->db->getCount();
        }
        return -1;
    }
    
    function delete($id) {
        return $this->db->deleteParameters(self::TABLA, array('email' => $id));
    }

    function get($id) {
        $this->db->getCursorParameters(self::TABLA, '*', array('email' => $id));
        if ($fila = $this->db->getRow()) {
            $objeto = new Usuario();
            $objeto->set($fila);
            return $objeto;
        }
        return new Usuario();
    }

    function getList() {
        $this->db->getCursorParameters(self::TABLA);
        $respuesta = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Usuario();
            $objeto->set($fila);
            $respuesta[] = $objeto;
        }
        return $respuesta;
    }

    function save(Usuario $objeto, $correopk) {
        $campos = $this->_getCampos($objeto);
        unset($campos['falta']);
        if($objeto->getPassword() === null || $objeto->getPassword() === ''){
            unset($campos['password']);
        }
        return $this->db->updateParameters(self::TABLA, $campos, array('email' => $correopk));
        //return $this->db->updateParameters(self::TABLA, $this->_getCampos($objeto), array('email' => $correopk));
    }
    
    function saveUsuario(Usuario $objeto, $correopk) {
        $campos = $this->_getCampos($objeto);
        unset($campos['tipo']);
        unset($campos['estado']);
        unset($campos['falta']);
        if($objeto->getPassword() === null || $objeto->getPassword() === ''){
            unset($campos['password']);
        }
        return $this->db->updateParameters(self::TABLA, $campos, array('email' => $correopk));
    }

}