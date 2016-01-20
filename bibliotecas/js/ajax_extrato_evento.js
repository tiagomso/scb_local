/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function(){
        jQuery('#formEvento').submit(function(){
                var dados = jQuery( this ).serialize();

                jQuery.ajax({
                        type: "POST",
                        url: "../../site/extrato/extrato_conciliacao_ajax_evento.php",
                        data: dados,
                        success: function( data )
                        {
                                alert( data );
                        }
                });

                return false;
        });
});

