<?php

class ControllerUsuario extends Controller{
    
     function dodelete(){
        $email = Request::read('email');
        $r = $this->getModel()->deleteUsuario($email);
        header('Location: index.php?ruta=usuario&accion=viewList&op=delete&r=' .r);
        exit();
    }
    
    function doedit(){
        $usuario = new Usuario();
        $usuario->read();
        $emailpk = Request::read('emailpk');
        $r = $this->getModel()->editUsuario($usuario, $emailpk);
        header('Location: index.php?ruta=usuario&accion=viewlist&op=edit&r=' . $r);
        exit();
    }
    
    function doinsert(){
        $usuario = new Usuario();
        $usuario->read();
        if($usuario->isValid()){
            $r = $this->getModel()->insertUsuario($usuario);
            header('Location: index.php?ruta=usuario&accion=viewlist&op=insert&r=' . $r);
            exit();
        }else{
            $this->viewinsert($usuario);
        }
    }
    
    function viewedit(){
        $email = Request::read('email');
        $usuario = $this->getModel()->getUsuario('id');
        $email = $usuario->getEmail();
        
        $form = <<<ABC
        $error<br>
        <form action="index.php">
            <input type='text' value="$email" name='email' required placeholder='email' /><br/>
            <input type='password' name='password' placeholder='clave de acceso' /><br/>
            <input type='hidden' value="$email" name='emailpk'/><br/>
            <input type='hidden' name='ruta' value='usuario' />
            <input type='hidden' name='accion' value='doedit' />
            <input type='submit' value='edicion' /><br/>
        </form>
ABC;
        $this->getModel()->addData('form', $form);
    }
    
    function viewinsert(Usuario $usuario = null) {
        $error="";
        
        if($usuario === null){
            $usuario = new Usuario();
        }else{
            $error = "Se ha producido un error";
        }
        
        $email = $usuario->getEmail();
        $password = $usuario->getPassword();
        $falta = $usuario->getFalta();
        $tipo = $usuario->getTipo();
        $estado = $usuario->getEstado();
        
        $form = <<<ABC
        $error<br>
        <form action="index.php">
            <input type='email' name='email' value="$email" required placeholder='correo electrónico' /><br/>
            <input type='password' name='password' placeholder='clave de acceso' /><br/>
            <input type='hidden' name='ruta' value='usuario' />
            <input type='hidden' name='accion' value='doinsert' />
            <input type='submit' value='alta' /><br/>
        </form>
ABC;
        $this->getModel()->addData('form',$form);
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
        foreach($lista as $usuario){
            $dato .= $usuario;
            $dato .= '<a class="borrar" href="index.php?ruta=usuario&accion=dodelete&id=' . $usuario->getEmail() . '">borrar este usuario</a> ';
            $dato .= '<a href="index.php?ruta=usuario&accion=viewedit&id=' . $usuario->getEmail() . '">editar este usuario</a>';
            $dato .= '<br>';
        }
        
        $dato .= $datoFinal;
        $dato .= '<a href="index.php?ruta=usuario&accion=viewinsert">Insertar</a>';
        $this->getModel()->addData('lista', $dato);
    }
    
    
}