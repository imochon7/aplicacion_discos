<?php

class GestorAutor{
    
    const TABLA = 'autor';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }
    
    private static function _getCampos(Autor $objeto){
        $campos = $objeto->get();
        return $campos;
    }
    
    function add(Autor $objeto) {
        return $this->db->insertParameters(self::TABLA, self::_getCampos($objeto), true);
    }
    
    function delete($idAutor) {
        return $this->db->deleteParameters(self::TABLA, array('id' => $idAutor));
    }
    
    function get($id_autor){
        $this->db->getCursorParameters(self::TABLA, '*', array('id' => $id_autor));
        $objeto = new Autor();
        if($fila = $this->db->getRow()){
            $objeto->set($fila);
        }
        return $objeto;
    }
    
    // function getListAutor($parametros = array(), $orderby = 'nombre', $limit = ''){
    //     $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
    //     $respuesta = array();
    //     while ($fila = $this->db->getRow()) {
    //         $objeto = new Autor();
    //         $objeto->set($fila);
    //         $respuesta[] = $objeto;
    //     }
    //     return $respuesta;
    // }
    
    // function getListSearch($parametros, $orderby = "nombre", $limit = ''){
    //     $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
    //     $respuesta = array();
    //     while ($fila = $this->db->getRow()) {
    //         $objeto = new Autor();
    //         $objeto->set($fila);
    //         $respuesta[] = $objeto;
    //     }
    //     return $respuesta;
    // }
    
    // function getPage($pagina = 1, $parametros = array(), $orderby = '1', $rpp = 10){
    //     $inicio = ($pagina - 1) * $rpp;
    //     $limit = 'limit ' . $inicio . ', ' . $rpp;
    //     $this->db->getCursorParameters( self::TABLA, '*', $parametros, $orderby, $limit );
    //     return $this->getSelect();
    // }
    
    function getPage($pagina = 1, $parametros = array(), $rpp = 10){
        $inicio = ($pagina - 1) * $rpp;
        $limit = 'limit ' . $inicio . ', ' . $rpp;
        $sql = "select a.*, d.*, da.*
                from autor a
                join disco_autor da
                on a.id = da.id_autor
                join disco d
                on d.id = da.id_disco
                order by a.nombre, d.title, d.id
                $limit";
        $r = $this->db->send($sql);
        $array = array();
        if($r){
            while($fila = $this->db->getRow()) {
                $arrayDA = array();
                $autor = new Autor();
                $autor->set($fila);
                $arrayDA[] = $autor;
                $disco = new Disco();
                $disco->set($fila, 2);
                $arrayDA[] = $disco;
                $array[] = $arrayDA;
            }
        }
        return $array;
    }
    
    
    // private function getSelect(){
    //     $resultado = array();
    //     while ( $fila = $this->db->getRow() ){
    //         $objeto = new Autor();
    //         $objeto->set( $fila );
    //         $resultado[] = $objeto;
    //     }
    //     return $resultado;
    // }
    
    function save(Autor $objeto) {
        $campos = self::_getCampos($objeto);
        return $this->db->updateParameters(self::TABLA, $campos, array('id' => $objeto->getId() ) );
    }
    

    
    
 
}