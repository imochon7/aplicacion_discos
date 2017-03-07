<?php

class ModelUsuario extends Model {
    
    function deleteUsuario($login){
        $gestor = new GestorUsuario();
        return $gestor->delete($login);
    }
    
    function editUsuario($usuario, $loginpk){
        $gestor = new GestorUsuario();
        return $gestor->save($usuario, $loginpk);
    }
    
    function insertUsuario($usuario){
        $gestor = new GestorUsuario();
        return $gestor->add($usuario);
    }
    
    function getUsuario($login){
        $gestor = new GestorUsuario();
        return $gestor->getUsuario($login);
    }
    
    function getList(){
        $gestor = new GestorUsuario();
        return $gestor->getList();
    }
    
    function getUsuarioPageController($pagina){
        $gestor = new GestorUsuario();
        $total = $gestor->count();
        return new PageController($total, $pagina);
    }
    
    function getUsuarioPage($pagina){
        $gestor = new GestorUsuario();
        return $gestor->getPage($pagina);
    }
    
}