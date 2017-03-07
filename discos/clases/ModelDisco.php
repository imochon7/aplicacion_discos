<?php

class ModelDisco extends Model {
    
    function getList(){
        $gestor = new GestorDisco();
        return $gestor->getList();
    }
    
    // function getListTitulo(){
    //     $gestor = new GestorDisco();
    //     return $gestor->getListTitulo();
    // }
    
    // function getListAutor(){
    //     $gestor = new GestorAutor();
    //     return $gestor->getListAutor();
    // }
    
    function getDisco( $idDisco ){
        $gestor = new GestorDisco();
        return $gestor->get( $idDisco );
    }
    
    function getDisco_DiscoAutor( $idDisco ){
        $gestor = new GestorDiscoAutor();
        return $gestor->getDiscoAutores( $idDisco );
    }
    
    function getAutor_DiscoAutor( $idAutor ){
        $gestor = new GestorDiscoAutor();
        return $gestor->getAutoresDisco( $idAutor );
    }
    
    function getAutor( $idAutor ){
        $gestor = new GestorAutor();
        return $gestor->get( $idAutor );
    }
    
    function insertDisco($title){
        $gestor = new GestorDisco();
        return $gestor->add($title);
    }
    
    function insertAutor($nombre){
        $gestor = new GestorAutor();
        return $gestor->add($nombre);
    }
    
    function insertDiscoAutor($discoAutor){
        $gestor = new GestorDiscoAutor();
        return $gestor->add($discoAutor);
    }
    
    //  function searchTitulo($campo){
    //     $gestor = new GestorDisco();
    //     return $gestor->getListSearch( array('title' => $campo) );
    // }
    
    // function searchAutor($campo){
    //     $gestor = new GestorAutor();
    //     return $gestor->getListSearch( array('nombre' => $campo) );
    // }
    
    function editDisco($disco){
        $gestor = new GestorDisco();
        return $gestor->save($disco);
    }
    
    function editAutor($autor){
        $gestor = new GestorAutor();
        return $gestor->save($autor);
    }
    
    function deleteDisco($idDisco){
        $gestor = new GestorDisco();
        return $gestor->delete($idDisco);
    }
    
    function deleteAutor($idAutor){
        $gestor = new GestorAutor();
        return $gestor->delete($idAutor);
    }
    
    function deleteDiscoAutor($idDisco, $idAutor){
        $gestor = new GestorDiscoAutor();
        return $gestor->delete($idDisco, $idAutor);
    }
    
    function getDiscosPageController( $pagina ){
        $gestor = new GestorDisco();
        $total = $gestor->count();
        return new PageController( $total, $pagina );
    }
    
    function getDiscos( $pagina ){
        $gestor = new GestorDisco();
        return $gestor->getList( $pagina );
    }
    
    function getDiscosPorTitulo( $pagina ){
        $gestor = new GestorDisco();
        return $gestor->getPage( $pagina );
    }
    
    // function getDiscosPorAutor( $pagina ){
    //     $gestor = new GestorAutor();
    //     return $gestor->getPage( $pagina, array(), '2' );
    // }
    
    function getDiscosPorAutor( $pagina ){
        $gestor = new GestorAutor();
        return $gestor->getPage( $pagina );
    }
    
    function searchTitulo( $pagina, $campo ){
        $gestor = new GestorDisco();
        return $gestor->getPage( $pagina, array('title' => $campo) );
    }
    
    function searchAutor( $pagina, $campo ){
        $gestor = new GestorAutor();
        return $gestor->getPage( $pagina, array('nombre' => $campo) );
    }
    
}