<?php

class ModelUsuario extends Model{
    
 function insertUsuario(Usuario $usuario){
        date_default_timezone_set('Europe/Madrid');
        $usuario->setFalta(date('Y-m-d'));
        $usuario->setTipo('usuario');
        $usuario->setEstado(0);
        $gestor = new GestorUsuario();
        return $gestor->add($usuario);
    }
    
    function getList(){
        $gestor = new GestorUsuario();
        return $gestor->getList();
    }
    
    function deleteUsuario($email){
        $gestor=new GestorUsuario();
        return $gestor->delete($email);
    }
    
    function getUsuario($id){
        $gestor = new GestorUsuario();
        return $gestor->get($id);
    }
    
  function editUsuario(Usuario $usuario, $emailpk){
        $gestor = new GestorUsuario();
        return $gestor->saveUsuario($usuario, $emailpk);
    }
}