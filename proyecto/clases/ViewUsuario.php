<?php

class ViewUsuario extends View{
    
    function render() {
        $r = $this->getModel()->getData();
        $h = '<html><body><h1 style="color: #abcdef;">';
        foreach($r as $dato){
            $h .= $dato . '<br>';
        }
        $h .= '</h1></body></html>';
        return $h;
    }
}