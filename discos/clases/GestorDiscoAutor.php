<?php

class GestorDiscoAutor{
    
    const TABLA = 'disco_autor';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }
    
    private static function _getCampos(Disco_Autor $objeto){
        $campos = $objeto->get();
        return $campos;
    }
    
    function add(Disco_Autor $objeto) {
        return $this->db->insertParameters(self::TABLA, $objeto->get(), true);
    }
    
    function delete($idDisco, $idAutor) {
        return $this->db->deleteParameters(self::TABLA, array('id_disco' => $idDisco, 'id_autor' => $idAutor));
    }
    
    function getDiscoAutores( $idDisco ) {
        $this->db->getCursorParameters(self::TABLA, '*', array('id_disco' => $idDisco));
        $resultado = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Disco_Autor();
            $objeto->set($fila);
            $resultado[] = $objeto;
        }
        return $resultado;
    }
    
    function getAutoresDisco( $idAutor ) {
        $this->db->getCursorParameters(self::TABLA, '*', array('id_autor' => $idAutor));
        $resultado = array();
        while ($fila = $this->db->getRow()) {
            $objeto = new Disco_Autor();
            $objeto->set($fila);
            $resultado[] = $objeto;
        }
        return $resultado;
    }
    
}