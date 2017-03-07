<?php

class ControllerDisco extends Controller {
    
    function doinsert(){
        $disco = new Disco();
        $disco->readApelo();
        
        $autor = new Autor();
        $autor->readApelo();
        
        $discoAutor = new Disco_Autor();
        
        if( $disco->isValid() && $autor->isValid() ) {
            $d = $this->getModel()->insertDisco($disco);
            $a = $this->getModel()->insertAutor($autor);
            
            $discoAutor->setId_disco($d);
            $discoAutor->setId_autor($a);
            
            $this->getModel()->insertDiscoAutor($discoAutor);
            
            // header('Location: index.php?ruta=disco&accion=view_discos');
            // exit();
            
            $img = new FileUpload('path');
            $img->setDestino("covers/");
            $img->setTamano(9000000);
            $img->setNombre($d);
            
            $re = $img->upload();
            
            var_dump($img);
            
            
            header('Location: index.php?ruta=disco&accion=view_lista_discos');
        }
    }
    
    function doedit(){
        
        $disco = new Disco();
        $disco->readApelo();
        
        $autor = new Autor();
        $autor->readApelo();
        
        // var_dump($disco);
        // echo('<br>');
        // var_dump($autor);
        
        $this->getModel()->editDisco($disco);
        $this->getModel()->editAutor($autor);
        
        // echo('<hr>');
        // var_dump($this->getModel()->editDisco($disco));
        // echo('<br>');
        // var_dump($this->getModel()->editDisco($aautor));
        
        // exit();
        
        $img = new FileUpload('path');
        $img->setDestino("covers/");
        $img->setTamano(9000000);
        $img->setNombre( $disco->getId() );
        
        $nombreDisco = $img->getNombre();
        $ruta = 'covers/' . $nombreDisco . '.jpg';
        
        if(file_exists($ruta)){
            unlink($ruta);
        }
        $re = $img->upload();
        
        header('Location: index.php?ruta=disco&accion=view_lista_discos');
        exit(); 
    }
    
    function dodelete(){
        $idDisco = Request::get('idDisco');
        $idAutor = Request::get('idAutor');
        
        $this->getModel()->deleteDiscoAutor($idDisco, $idAutor);
        $this->getModel()->deleteDisco($idDisco);
        $this->getModel()->deleteAutor($idAutor);
        
        header('Location: index.php?ruta=disco&accion=view_lista_discos');
        exit(); 
    }
    
    // VISTAS
    
    function view_disco(){
    
        $idDisco = Request::get('idDisco');
        $idAutor = Request::get('idAutor');
        
        $disco = $this->getModel()->getDisco($idDisco);
        $autor = $this->getModel()->getAutor($idAutor);
        
        $coverUrl = 'covers/' . $disco->getId() . '.jpg';
            
        if( file_exists($coverUrl) ){
            $img = 'covers/' . $disco->getId();
        }else{
            $img = 'covers/default';
        }
        
        $dato = Util::renderFile( 'template/html/verdisco.html' , array( 'idDisco' => $disco->getId(), 'title' => $disco->getTitle(), 'autor' => $autor->getNombre(), 'cover' => $img ));
        
        if($this->getSession()->isLogged()){
            $this->getModel()->addFile('menu', Util::renderFile('template/html/menu/menu-logeado.html'));
        } else {
            $this->getModel()->addFile('menu', Util::renderFile('template/html/menu/menu-nologeado.html'));
        }
        $this->getModel()->addData('contenido', $dato);
        $this->getModel()->addFile('paginacion', Util::renderFile('template/html/paginacion/pag-vacio.html'));
    }
    
    function view_lista_discos(){
        
        $dato = '';
        $pc = $this->getDiscoPageController();
        $lista = $this->getModel()->getDiscos( $pc->getPage() );
        foreach($lista as $autordisco){
            $disco = $autordisco[0];
            $autor = $autordisco[1];
            $coverUrl = 'covers/' . $disco->getId() . '.jpg';
            if(file_exists($coverUrl) ){
                $img = 'covers/' . $disco->getId();
            }else{
                $img = 'covers/default';
            }
            if($this->getSession()->isLogged()){
                $dato .= Util::renderFile( 'template/html/_discos.html', array( 'idDisco' => $disco->getId(), 'idAutor' => $autor->getId(), 'title' => $disco->getTitle(), 'autor' => $autor->getNombre(), 'cover' => $img ) );    
            } else {
                $dato .= Util::renderFile( 'template/html/_discosnl.html', array( 'idDisco' => $disco->getId(), 'idAutor' => $autor->getId(), 'title' => $disco->getTitle(), 'autor' => $autor->getNombre(), 'cover' => $img ) );    
            }
        }
        if( $this->getSession()->isLogged() ){
            $this->getModel()->addFile( 'menu', Util::renderFile( 'template/html/menu/menu-logeado.html' ) );
        } else {
            $this->getModel()->addFile( 'menu', Util::renderFile( 'template/html/menu/menu-nologeado.html' ) );
        }
        
        $this->getModel()->addData('contenido', $dato);
        $this->getModel()->addFile('paginacion', Util::renderFile('template/html/paginacion/pag-nav-autor.html', array('primera' => $pc->getFirst(), 'anterior' => $pc->getPrevious(), 'siguiente' => $pc->getNext(), 'ultima'=> $pc->getPages() ) ));
    
        
    }

    function view_lista_discos_titulo(){
        
        $dato = '';
        $pc = $this->getDiscoPageController();
        $lista = $this->getModel()->getDiscosPorTitulo( $pc->getPage() );
        foreach($lista as $autordisco){
            $disco = $autordisco[0];
            $autor = $autordisco[1];
            $coverUrl = 'covers/' . $disco->getId() . '.jpg';
            if(file_exists($coverUrl) ){
                $img = 'covers/' . $disco->getId();
            }else{
                $img = 'covers/default';
            }
            if($this->getSession()->isLogged()){
                $dato .= Util::renderFile( 'template/html/_discos.html', array( 'idDisco' => $disco->getId(), 'idAutor' => $autor->getId(), 'title' => $disco->getTitle(), 'autor' => $autor->getNombre(), 'cover' => $img ) );    
            } else {
                $dato .= Util::renderFile( 'template/html/_discosnl.html', array( 'idDisco' => $disco->getId(), 'idAutor' => $autor->getId(), 'title' => $disco->getTitle(), 'autor' => $autor->getNombre(), 'cover' => $img ) );    
            }
        }
        if( $this->getSession()->isLogged() ){
            $this->getModel()->addFile( 'menu', Util::renderFile( 'template/html/menu/menu-logeado.html' ) );
        } else {
            $this->getModel()->addFile( 'menu', Util::renderFile( 'template/html/menu/menu-nologeado.html' ) );
        }
        
        $this->getModel()->addData('contenido', $dato);
        $this->getModel()->addFile('paginacion', Util::renderFile('template/html/paginacion/pag-nav-autor.html', array('primera' => $pc->getFirst(), 'anterior' => $pc->getPrevious(), 'siguiente' => $pc->getNext(), 'ultima'=> $pc->getPages() ) ));
    
        
        
    }
    
    /*
    select a.*, d.*, da.*
    from autor a
    join disco_autor da
    on a.id = da.id_autor
    join disco d
    on d.id = da.id_disco
    order by d.title, a.nombre, d.id
    
    select a.*, d.*, da.*
    from autor a, disco d, disco_autor da
    where a.id = da.id_autor
    and d.id = da.id_disco
    order by a.nombre, d.title, d.id
    
    select a.*, d.*, da.*
    from autor a
    join disco_autor da
    on a.id = da.id_autor
    join disco d
    on d.id = da.id_disco
    order by a.nombre, d.title, d.id
    */
    
    function view_lista_discos_autor(){
        $dato = '';
        $pc = $this->getDiscoPageController();
        $lista = $this->getModel()->getDiscosPorAutor( $pc->getPage() );
        foreach($lista as $autordisco){
            $autor = $autordisco[0];
            $disco = $autordisco[1];
            $coverUrl = 'covers/' . $disco->getId() . '.jpg';
            if(file_exists($coverUrl) ){
                $img = 'covers/' . $disco->getId();
            }else{
                $img = 'covers/default';
            }
            if($this->getSession()->isLogged()){
                $dato .= Util::renderFile( 'template/html/_discos.html', array( 'idDisco' => $disco->getId(), 'idAutor' => $autor->getId(), 'title' => $disco->getTitle(), 'autor' => $autor->getNombre(), 'cover' => $img ) );    
            } else {
                $dato .= Util::renderFile( 'template/html/_discosnl.html', array( 'idDisco' => $disco->getId(), 'idAutor' => $autor->getId(), 'title' => $disco->getTitle(), 'autor' => $autor->getNombre(), 'cover' => $img ) );    
            }
        }
        if( $this->getSession()->isLogged() ){
            $this->getModel()->addFile( 'menu', Util::renderFile( 'template/html/menu/menu-logeado.html' ) );
        } else {
            $this->getModel()->addFile( 'menu', Util::renderFile( 'template/html/menu/menu-nologeado.html' ) );
        }
        
        $this->getModel()->addData('contenido', $dato);
        $this->getModel()->addFile('paginacion', Util::renderFile('template/html/paginacion/pag-nav-autor.html', array('primera' => $pc->getFirst(), 'anterior' => $pc->getPrevious(), 'siguiente' => $pc->getNext(), 'ultima'=> $pc->getPages() ) ));
    }
    
    function view_add(){
        $this->getModel()->addFile('menu', Util::renderFile('template/html/menu/menu-logeado.html'));
        $this->getModel()->addFile('contenido', Util::renderFile('template/html/altadisco.html'));
        $this->getModel()->addFile('paginacion', Util::renderFile('template/html/paginacion/pag-vacio.html'));
    }
    
    function view_edit(){
        $idDisco = Request::get('idDisco');
        $idAutor = Request::get('idAutor');
        $title = Request::get('title');
        $autor = Request::get('autor');

        $this->getModel()->addFile('menu', Util::renderFile('template/html/menu/menu-logeado.html'));
        $this->getModel()->addFile('contenido', Util::renderFile('template/html/editardisco.html', array('idDisco' => $idDisco, 'idAutor' => $idAutor, 'title' => $title, 'autor' => $autor ) ) );
        $this->getModel()->addFile('paginacion', Util::renderFile('template/html/paginacion/pag-vacio.html'));
    }
    
    function view_search(){
        $campo = Request::get('search');
        $radio = Request::get('radio');
        
        
        $campo = str_replace("+", " ", $campo);
        // var_dump($campo);
        // var_dump($radio);
        // exit();
        
        if($radio == 'titulo'){
            $pc = $this->getDiscoPageController();
            $lista = $this->getModel()->searchTitulo($pc->getPage(), $campo);
            
            // var_dump($lista);
            // exit();
        } else {
            $pc = $this->getDiscoPageController();
            $lista = $this->getModel()->searchAutor($pc->getPage(), $campo); 
            
            // var_dump($lista);
            // exit();
        }
        
        $dato = '';
	    
        if($radio == 'titulo'){
            
            foreach ($lista as $disco) {
            // code...
            $disco_autor = $this->getModel()->getDisco_DiscoAutor( $disco->getId() );
            
                foreach ($disco_autor as $dis) {
                    // code...
                    $autor = $this->getModel()->getAutor( $dis->getId_autor() );
                }
                
                $coverUrl = 'covers/' . $disco->getId() . '.jpg';
                
                if( file_exists($coverUrl) ){
                    $img = 'covers/' . $disco->getId();
                }else{
                    $img = 'covers/default';
                }
                
                if($this->getSession()->isLogged()){
                    $dato .= Util::renderFile( 'template/html/_discos.html', array( 'idDisco' => $disco->getId(), 'idAutor' => $autor->getId(), 'title' => $disco->getTitle(), 'autor' => $autor->getNombre(), 'cover' => $img ) );    
                } else {
                    $dato .= Util::renderFile( 'template/html/_discosnl.html', array( 'idDisco' => $disco->getId(), 'idAutor' => $autor->getId(), 'title' => $disco->getTitle(), 'autor' => $autor->getNombre(), 'cover' => $img ) );    
                }
            }

        }else{
            foreach ($lista as $autor) {
                // code...
                $disco_autor = $this->getModel()->getAutor_DiscoAutor( $autor->getId() );
                
                foreach ($disco_autor as $dis) {
                    // code...
                    $disco = $this->getModel()->getDisco( $dis->getId_disco() );
                }
                
                $coverUrl = 'covers/' . $disco->getId() . '.jpg';
                
                if( file_exists($coverUrl) ){
                    $img = 'covers/' . $disco->getId();
                }else{
                    $img = 'covers/default';
                }
                
                if($this->getSession()->isLogged()){
                    $dato .= Util::renderFile( 'template/html/_discos.html', array( 'idDisco' => $disco->getId(), 'idAutor' => $autor->getId(), 'title' => $disco->getTitle(), 'autor' => $autor->getNombre(), 'cover' => $img ) );    
                } else {
                    $dato .= Util::renderFile( 'template/html/_discosnl.html', array( 'idDisco' => $disco->getId(), 'idAutor' => $autor->getId(), 'title' => $disco->getTitle(), 'autor' => $autor->getNombre(), 'cover' => $img ) );    
                }
            }
        }
        
        if($this->getSession()->isLogged()){
            $this->getModel()->addFile('menu', Util::renderFile('template/html/menu/menu-logeado.html'));
        } else {
            $this->getModel()->addFile('menu', Util::renderFile('template/html/menu/menu-nologeado.html'));
        }
        $this->getModel()->addData('contenido', $dato);
        $this->getModel()->addFile('paginacion', Util::renderFile('template/html/paginacion/pag-nav.html', array('primera' => $pc->getFirst(), 'anterior' => $pc->getPrevious(), 'siguiente' => $pc->getNext(), 'ultima'=> $pc->getPages() ) ));
        
    }
    
    
}