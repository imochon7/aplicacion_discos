<?php

class ControllerUsuario extends Controller {
    
    function dologin() {
        $usuarioWeb = new Usuario();
        $usuarioWeb->read();
        
        $usuarioBD = $this->getModel()->getUsuario($usuarioWeb->getLogin());
        
        if( ( $usuarioWeb->getLogin() === $usuarioBD->getLogin() ) && ($usuarioWeb->getPassword() === $usuarioBD->getPassword() ) ){
                $this->getSession()->setUser($usuarioBD);
                header('Location: index.php?ruta=disco&accion=view_lista_discos');
                exit();
        }
        $this->getSession()->destroy();
        $this->getModel()->addFile('menu', Util::renderFile('template/html/menu/menu-vacio.html'));
        $this->getModel()->addFile('paginacion', Util::renderFile('template/html/paginacion/pag-vacio.html'));
        return $this->getModel()->addFile('contenido', Util::renderFile('template/html/login.html'));
    }
    
    function dodelete(){
        $login = Request::get('login');
        
        $this->getModel()->deleteUsuario($login);
        
        header('Location: index.php?ruta=usuario&accion=view_lista_usuarios');
    }
    
    function logout(){
        $this->getSession()->destroy();
        header('Location: index.php');
        exit();
    }
    
    function doedit(){
        $usuario = new Usuario();
        $usuario->read();
        $loginpk = Request::get('loginpk');
        
        $this->getModel()->editUsuario($usuario, $loginpk);
        header('Location: index.php?ruta=usuario&accion=view_lista_usuarios');
    }
    
    function doinsert(){
        $usuario = new Usuario();
        $usuario->read();
        
        if( $usuario->isValid() ) {
            $this->getModel()->insertUsuario($usuario);
            header('Location: index.php?ruta=usuario&accion=view_lista_usuarios');
            exit();
        }
    }
    
    
    /*  ********************** VIEW ***************** */
    
    // function view_login(){
    //     return $this->getModel()->addFile('contenido', Util::renderFile('template/html/loguearse.html'));
    // }
    
    // function view_app(){
    //     return $this->getModel()->addFile('contenido', Util::renderFile('template/html/appdiscos.html'));
        
        
    // }
    
    // function view_alta(){
    //     $this->getModel()->addFile('contenido', Util::renderFile('template/html/appdiscos.html'));
    //     return $this->getModel()->addFile('desktop', Util::renderFile('template/html/altausuario.html'));
        
    // }
    
    // function view_usuarios(){
    //     $lista = $this->getModel()->getList();
    //     $this->getModel()->addFile('contenido', Util::renderFile('template/html/appdiscos.html'));
        
    //     $dato = '';
        
    //     $dato .= "<table class='tablaUsuarios'>
    //                 <tr>
		  //              <th>Loggin</th>
		  //              <th></th>
		  //              <th></th>
	   //             </tr>";
	    
    //     foreach($lista as $usuario){
            
    //         $dato .= "<tr>";
    //         $dato .= Util::renderFile( 'template/html/_usuarios.html', array( 'login' => $usuario->getLogin(), 'password' => $usuario->getPassword() ) );
    //         $dato .= "</tr>";
    //     }
        
    //     return $this->getModel()->addData('desktop', $dato);
        
        
    // }
    
    // function view_edit(){
    //     $login = Request::get('login');
    //     $password = Request::get('password');
        
        
    //     $this->getModel()->addFile('contenido', Util::renderFile('template/html/appdiscos.html'));
    //     return $this->getModel()->addFile('desktop', Util::renderFile('template/html/editarusuario.html', array('login' => $login, 'password' => $password ) ));
    // }
    
    function view_lista_usuarios(){
        $pc = $this->getUsuarioPageController();
        $lista = $this->getModel()->getUsuarioPage($pc->getPage());
        
        $dato = '';
        
        $dato .= "<div class='lista-de-usuarios'>";
        $dato .= '<div class="lista-content">';
	    $dato .= '<h1>Listado de usuarios</h1><hr>';
	    
        foreach($lista as $usuario){
            
            $dato .= Util::renderFile( 'template/html/_usuarios.html', array( 'login' => $usuario->getLogin(), 'password' => $usuario->getPassword() ) );
        }
        
        $dato .= '</div>';
        $dato .= "</div>";
        
        $this->getModel()->addFile('menu', Util::renderFile('template/html/menu/menu-logeado.html'));
        $this->getModel()->addData('contenido', $dato);
        $this->getModel()->addFile('paginacion', Util::renderFile('template/html/paginacion/pag-nav.html'), array('primera' => $pc->getFirst(), 'anterior' => $pc->getPrevious(), 'siguiente' => $pc->getNext(), 'ultima'=> $pc->getPages() ));
    }
    
    function view_add(){
        $this->getModel()->addFile('menu', Util::renderFile('template/html/menu/menu-logeado.html'));
        $this->getModel()->addFile('contenido', Util::renderFile('template/html/altausuario.html'));
        $this->getModel()->addFile('paginacion', Util::renderFile('template/html/paginacion/pag-vacio.html'));
    }
    
    function view_edit(){
        $login = Request::get('login');
        $password = Request::get('password');

        $this->getModel()->addFile('menu', Util::renderFile('template/html/menu/menu-logeado.html'));
        $this->getModel()->addFile('contenido', Util::renderFile('template/html/editarusuario.html', array('login' => $login, 'password' => $password ) ) );
        $this->getModel()->addFile('paginacion', Util::renderFile('template/html/paginacion/pag-nav.html'));
    }
    
}