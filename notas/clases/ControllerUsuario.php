<?php

class ControllerUsuario extends Controller {

    function doactivar() {
        $email = Request::read('email');
        $iduser = Request::read('iduser');
        $r = $this->getModel()->activarUsuario($email, $iduser);
        if($r>0){
            $this->getModel()->addData('contenido', 'activación realizada correctamente, ya se puede autentificar');
        } else {
            $this->getModel()->addData('contenido', 'activación incorrecta, posiblemente ya estuviera activado');
        }
    }

    function doinsert() {
        $usuario = new Usuario();
        $usuario->read();
        $clave2 = Request::read('password2');
        $r = 0;
        if($usuario->isValid() && $usuario->getPassword() === $clave2) {
            $enlace = 'https://dwes-izvdamdaw.c9users.io/notas/index.php?ruta=usuario&accion=doactivar&email='
                . $usuario->getEmail() . '&iduser='. sha1($usuario->getEmail() . Constantes::SECRET);
            $enviado = Util::enviarCorreo($usuario->getEmail(), 'Correo de activación', $enlace);
            //como sé que no funciona, porque no tengo el token
            file_put_contents('correosactivacion/correos.txt', $enlace . "\n\r", FILE_APPEND);
            $enviado = true;
            if($enviado) {
                $r = $this->getModel()->insertUsuario($usuario);
            }
        }
        header('Location: index.php?op=insert&r=' . $r);
        exit();
    }
    
    function dologin() {
        $usuarioWeb = new Usuario();
        $usuarioWeb->read();
        $usuarioBD = $this->getModel()->getUsuario($usuarioWeb->getEmail());
        if($usuarioWeb->getEmail() === $usuarioBD->getEmail()){
            if(Util::verificarClave($usuarioWeb->getPassword(), $usuarioBD->getPassword()) &&
               $usuarioBD->getEstado()=='1') {
                $this->getSession()->setUser($usuarioBD);
                header('Location: index.php?op=login&r=1');
                exit();
            }
        }
        $this->getSession()->destroy();
        header('Location: index.php?op=login&r=0');
        exit();
    }

    function dologout() {
        $this->getSession()->destroy();
        header('Location: index.php');
        exit();
    }

    /*function dodelete() {
        $email = Request::read('email');
        $r = $this->getModel()->deleteUsuario($email);
        header('Location: index.php?ruta=usuario&accion=viewlist&op=delete&r=' . $r);
        exit();
    }
    
    function doedit() {
        $usuario = new Usuario();
        $usuario->read();
        $emailpk = Request::read('emailpk');
        $r = $this->getModel()->editUsuario($usuario, $emailpk);
        header('Location: index.php?ruta=usuario&accion=viewlist&op=edit&r=' . $r);
        exit();
    }
    
    function doinsert() {
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
    
    function viewedit() {
        $id = Request::read('email');
        $usuario = $this->getModel()->getUsuario($id);
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
        $error = "";
        if($usuario == null){
            $usuario = new Usuario();
        }else{
            $error = "Ha habido un error";
        }
        $email = $usuario->getEmail();
        
        $form = <<<ABC
        $error<br>
        <form action="index.php">
            <input type='email' name='email' value='$email' required placeholder='correo electrónico' /><br/>
            <input type='password' name='password' placeholder='clave de acceso' /><br/>
            <input type='hidden' name='ruta' value='usuario' />
            <input type='hidden' name='accion' value='doinsert' />
            <input type='submit' value='alta' /><br/>
        </form>
ABC;
        $this->getModel()->addData('form', $form);
    }
    
    function viewlist() {
        $lista = $this->getModel()->getList();
        $datoFinal = <<<DEF
        <script>
        var confirmarBorrar = function(evento) {
            var objeto = evento.target;
            var r = confirm('Borrar?');
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
        $dato = '';
        foreach($lista as $usuario) {
            $dato .= $usuario;
            $dato .= '<a class="borrar" href="index.php?ruta=usuario&accion=dodelete&email=' . $usuario->getEmail() . '">borrar este Usuario</a> ';
            $dato .= '<a href="index.php?ruta=usuario&accion=viewedit&email=' . $usuario->getEmail() . '">editar este Usuario</a>';
            $dato .= '<br>';
        }
        $dato .= $datoFinal;
        $dato .= '<a href="index.php?ruta=usuario&accion=viewinsert" > Insertar</a>';
        $this->getModel()->addData('lista', $dato);
    }*/
}