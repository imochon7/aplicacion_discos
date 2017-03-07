/* global $ */

$(document).ready(function(){
    
    $('.eliminar-btn').click(function(event) {
        if( !confirm('¿Eliminar este elemento?') ){
            event.preventDefault();
        } else {
            
        }
    });
});