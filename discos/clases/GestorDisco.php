<?php

class GestorDisco {
    
    const TABLA = 'disco';
    private $db;

    function __construct() {
        $this->db = new DataBase();
    }
    
    private static function _getCampos(Disco $objeto) {
        $campos = $objeto->get();
        return $campos;
    }
    
    function add(Disco $objeto){
        return $this->db->insertParameters(self::TABLA, $objeto->get(), true);
    }
    
    function count( $parametros = array() ){
        return $this->db->countParameters( self::TABLA, $parametros );
    }
    
    function delete( $idDisco ){
        return $this->db->deleteParameters( self::TABLA, array( 'id' => $idDisco ) );
    }
    
    function get( $idDisco ) {
        $this->db->getCursorParameters( self::TABLA, '*', array( 'id' => $idDisco ) );
        
        $objeto = new Disco();
        if ($fila = $this->db->getRow()) {
            
            $objeto->set($fila);
            return $objeto;
        }
    }
    
    function getList($pagina = 1, $parametros = array(), $rpp = 10){
        $inicio = ($pagina - 1) * $rpp;
        $limit = 'limit ' . $inicio . ', ' . $rpp;
        $sql = "select a.*, d.*, da.*
                from disco d
                join disco_autor da
                on d.id = da.id_disco
                join autor a
                on a.id = da.id_autor
                
                $limit";
        $r = $this->db->send($sql);
        $array = array();
        if($r){
            while($fila = $this->db->getRow()) {
                $arrayDA = array();
                $autor = new Disco();
                $autor->set($fila);
                $arrayDA[] = $autor;
                $disco = new Autor();
                $disco->set($fila, 2);
                $arrayDA[] = $disco;
                $array[] = $arrayDA;
            }
        }
        return $array;
    }
    
    // function getListTitulo($parametros = array(), $orderby = 'title', $limit = ''){
    //     $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
    //     $respuesta = array();
    //     while ($fila = $this->db->getRow()) {
    //         $objeto = new Disco();
    //         $objeto->set($fila);
    //         $respuesta[] = $objeto;
    //     }
    //     return $respuesta;
    // }
    
    // function getListSearch($parametros, $orderby = "title", $limit = ''){
    //     $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
    //     $respuesta = array();
    //     while ($fila = $this->db->getRow()) {
    //         $objeto = new Disco();
    //         $objeto->set($fila);
    //         $respuesta[] = $objeto;
    //     }
    //     return $respuesta;
    // }
    
    // function getPage( $pagina = 1, $parametros = array(), $orderby = '1',  $rpp = 10 ){
    //     $inicio = ( $pagina - 1 ) * $rpp;
    //     $limit = 'limit ' . $inicio . ', ' . $rpp;
    //     $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
    //     return $this->getSelect();
    // }
    
    // function getPageAutor( $pagina = 1, $parametros = array(), $orderby = '2',  $rpp = 10 ){
    //     $inicio = ( $pagina - 1 ) * $rpp;
    //     $limit = 'limit ' . $inicio . ', ' . $rpp;
    //     $this->db->getCursorParameters(self::TABLA, '*', $parametros, $orderby, $limit);
    //     return $this->getSelect();
    // }
    
    // private function getSelect(){
    //     $resultado = array();

    //     while ($fila = $this->db->getRow()) {
    //         $objeto = new Disco();
    //         $objeto->set($fila);
    //         $resultado[] = $objeto;
    //     }
    //     return $resultado;
    // }
    
    function getPage($pagina = 1, $parametros = array(), $rpp = 10){
        $inicio = ($pagina - 1) * $rpp;
        $limit = 'limit ' . $inicio . ', ' . $rpp;
        $sql = "select a.*, d.*, da.*
                from disco d
                join disco_autor da
                on d.id = da.id_disco
                join autor a
                on a.id = da.id_autor
                order by d.title, a.nombre, d.id
                $limit";
        $r = $this->db->send($sql);
        $array = array();
        if($r){
            while($fila = $this->db->getRow()) {
                $arrayDA = array();
                $autor = new Disco();
                $autor->set($fila);
                $arrayDA[] = $autor;
                $disco = new Autor();
                $disco->set($fila, 2);
                $arrayDA[] = $disco;
                $array[] = $arrayDA;
            }
        }
        return $array;
    }
    
    function save( Disco $objeto ){
        $campos = self::_getCampos( $objeto );
        return $this->db->updateParameters( self::TABLA, $campos, array( 'id' => $objeto->getId()) );
    }
    
}