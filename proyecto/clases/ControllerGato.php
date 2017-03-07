<?php

class ControllerGato extends Controller {
    
    function viewinsert(Gato $gato = null) {
        $error="";
        
        if($gato === null){
            $gato = new Gato();
        }else{
            $error="Se ha producido un error";
        }
        
        $nombre = $gato->getNombre();
        $raza = $gato->getRaza();
        $color = $gato->getColor();
        
        $form = <<<ABC
        $error<br>
        <form action="index.php">
            <input type='text' value="$nombre" name='nombre' required placeholder='nombre' /><br/>
            <input type='text' value="$raza" name='raza' placeholder='raza' /><br/>
            <input type='text' value="$color" name='color' placeholder='color' /><br/>
            <input type='hidden' name='ruta' value='gato' />
            <input type='hidden' name='accion' value='doinsert' />
            <input type='submit' value='alta' /><br/>
        </form>
ABC;
        $this->getModel()->addData('form',$form);
    }
    
    function doinsert(){
        $gato = new Gato();
        $gato->read();
        if($gato->isValid()){
            $r = $this->getModel()->insertGato($gato);
            header('Location: index.php?ruta=gato&accion=viewList&op=insert&r=' .r);
            exit();
        }else{
            $this->viewinsert($gato);
        }
    }
    
    function viewlist(){
        $lista=$this->getModel()->getList();
        $datoFinal = <<<DEF
        <script>
        var confirmarBorrar = function(evento) {
            var objeto = evento.target;
            var r = confirm('¿Borrar?');
            if (r) {
            } else {
                evento.preventDefault();
            }
        }
        var a = document.getElementsByClassName('borrar');
        for (var i = 0; i < a.length; i++) {
            a[i].addEventListener('click', confirmarBorrar, false);
        }
        </script>
DEF;
        $dato ='';
        foreach($lista as $gato){
            $dato .= $gato;
            $dato .= '<a class="borrar" href="index.php?ruta=gato&accion=delete&id=' . $gato->getId() . '">borrar este gato</a> ';
            $dato .= '<a href="index.php?ruta=gato&accion=viewedit&id=' . $gato->getId() . '">editar este gato</a>';
            $dato .= '<br>';
        }
        
        $dato .= $datoFinal;
        $dato .= '<a href="index.php?ruta=gato&accion=viewinsert">Insertar</a>';
        $this->getModel()->addData('lista', $dato);
    }
    
    function dodelete(){
        $id = Request::read('id');
        $r = $this->getModel()->deleteGato($id);
        header('Location: index.php?ruta=gato&accion=viewList&op=delete&r=' .r);
        exit();
    }
    
    function viewedit(){
        $id = Request::read('id');
        $gato = $this->getModel()->getGato('id');
        $nombre = $gato->getNombre();
        $raza = $gato->getRaza();
        $color = $gato->getColor();
        
        $form = <<<ABC
        $error<br>
        <form action="index.php">
            <input type='text' value='$nombre' name='nombre' required placeholder='nombre' /><br/>
            <input type='text' value='$raza' name='raza' placeholder='raza' /><br/>
            <input type='text' value='$color' name='color' placeholder='color' /><br/>
            <input type='hidden' value='$id' name='id'/><br/>
            <input type='hidden' name='ruta' value='gato' />
            <input type='hidden' name='accion' value='doedit' />
            <input type='submit' value='edicion' /><br/>
        </form>
ABC;
        $this->getModel()->addData('form', $form);
    }
    
    function doedit(){
        $gato = new Gato();
        $gato->read();
        //$gato->setId(Request::read('id'));
        $r = $this->getModel()->editGato($gato);
        header('Location: index.php?ruta=gato&accion=viewlist&op=edit&r=' . $r);
        exit();
    }
}