<?php

class ModelGato extends Model {

    function insertGato(Gato $gato){
        $gestor = new GestorGato();
        return $gestor->add($gato);
    }
    
    function getList(){
        $gestor = new Gestor();
        return $gestor->getList();
    }
    
    function deleteGato($id){
        $gestor = new GestorGato();
        return $gestor->delete($id);
    }
    
    function getGato($id){
        $gestor = new GestorGato();
        return $gestor->get('id');
    }
    
    function editGato(Gato $gato){
        $gestor = new GestorGato();
        return $gestor->save($gato);
    }
}