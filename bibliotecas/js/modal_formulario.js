/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//Formulario modal para inclusão de providências
$(document).ready(function(){
    $("td [rel=modalEvento]").click( function(ev){
        ev.preventDefault();

        //alterado
        var id = '.windowEvento';

        var alturaTela = $(document).height();
        var larguraTela = $(window).width();                

        //colocando o fundo preto
        $('#mascara').css({
            'width':larguraTela,
            'height':alturaTela
        });
        $('#mascara').fadeIn(250);	
        $('#mascara').fadeTo("slow",0.8);

        var left = ($(window).width() /2) - ( $(id).width() / 2 );
        var top = ($(window).height() / 2) - ( $(id).height() / 2 );

        $(id).css({
            'top':top,
            'left':left
        });

        //inserido 
        href = $(this).attr("href");
        $('.windowEvento').load(href);

        $(id).show();	
    });
    


//$("#mascara").click( function(){
//   $(this).hide();
//   $(".window").hide();
//});
});


