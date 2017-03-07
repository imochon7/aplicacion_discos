<?php

class View {

    private $modelo;

    function __construct(Model $modelo) {
        $this->modelo = $modelo;
    }

    function getModel() {
        return $this->modelo;
    }

    function render() {
        // $r = $this->modelo->getData();
        // $h = '<html><body><h1>';
        // foreach($r as $dato){
        //     $h .= $dato . '<br>';
        // }
        // $h .= '</h1></body></html>';
        // return $h;
        
        $datos = array(
            'plantilla' => './templates/materialize',
            'contenido' => '<h1>gatos</h1>',
            'titulo1' => 'persa',
            'texto1' => 'los gatos persas...',
            'titulo2' => 'europeo',
            'texto2' => 'los gatos europeos...',
            'titulo3' => 'egipcio',
            'texto3' => 'los gatos egipcios...',
            );
            
        Util::renderFile($datos['plantilla'] . '/index.html', $datos);    
    }

}