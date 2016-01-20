<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <!importação de folhas de estilo>
    <link href="../../bibliotecas/css/estilo_leiaute.css" rel="stylesheet" type="text/css">
    <link href="../../bibliotecas/css/estilo_menu_horizontal.css" rel="stylesheet" type="text/css">
    <link href="../../bibliotecas/css/estilo_janela_modal.css" rel="stylesheet" type="text/css">
    <link href="../../bibliotecas/css/estilo_icones.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" media="screen" href="../../bibliotecas/jquery/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../../bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../../bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables_themeroller.min.css">

    <!importação de script jquery/javascript>
    <script src="../../bibliotecas/jquery/DataTables-1.10.0/media/js/jquery.js"></script>
    <script src="../../bibliotecas/jquery/DataTables-1.10.0/media/js/jquery.dataTables.min.js"></script>
    <script src="../../bibliotecas/jquery/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
    <script src="../../bibliotecas/js/login_ajax.js"></script>
    <script src="../../bibliotecas/js/priceFormat.js"></script>

    <style type="text/css">
        #exi_rec{
            text-align: right;
            padding-right: 10px;
        }
        #navegacao{
            float: left;
        }
        #exi_rec button{
            text-decoration: none;
            font: bold arial, helvetica, sans-aerif;	
            color:darkgrey;
        }
        #td{
            height: 50px;
            font: bold 12px verdana;
        }
        table#extrato{
            margin-top: 5px;
        }
        tbody{
            font: 12px verdana;
        }
        table.dataTable tbody tr{
            height: 50px;      
            max-height: 50px;
        }

        form{
            height: 400px;
            width: 700px;
            position: absolute;
            left: 35%;
            top: 22%;

            padding-top: 25px;

            border-top:1px solid #cfcfcf;
            border-left:1px solid #cfcfcf;	
            border-right:1px solid #696969;
            border-bottom:1px solid #696969;
            border-collapse:collapse;
            color:#ff9900;
        }
        label.form{
            display: block;
            height: 23px;
            width: 250px;
            float: left;
            margin-top: 15px;

            /*estilização da fonte*/
            font-weight: bold;
            font-family: verdana;
            font-size: 12px;
            color: #585858;
            text-align: right;
            line-height: 27px;
        }
        select.form{
            display: block;
            height: 27px;
            width: 229px;
            float: left;
            margin-top: 20px;
            margin-left: 10px;   
        }
        input.form{
            display: block;
            height: 23px;
            width: 225px;
            float: left;
            margin-top: 15px;
            margin-left: 10px;

        }
        input[type=submit]{
            display: block;
            height: 25px;
            width: 240px;
            margin-top: 35px;
            margin-left: 255px;  
            float: left;
        }

    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            //Controle do menu vertical deslizante
            $('#botao').click(function() {
                var slide = document.getElementById("botao").value;
                if (slide == 'ocultar'){
                    $(cnt_02_01).css('width','3%');
                    $(cnt_02_02).css('width','95.7%');
                    $(cnt_02_01_02).css('width','0%');
                    document.getElementById("botao").innerHTML = '>>';
                    document.getElementById("botao").value = 'mostrar';
                }else{
                    $(cnt_02_01).css('width','19%');
                    $(cnt_02_02).css('width','79.7%');
                    $(cnt_02_01_02).css('width','100%');
                    document.getElementById("botao").innerHTML = '<<';
                    document.getElementById("botao").value = 'ocultar';
                }
            });
                
            //script jquery para datatable
            $('#extrato').dataTable( {
                "language": {
                    "url": "../../bibliotecas/jquery/DataTables-1.10.0/media/portugues.txt"
                },
                "fnDrawCallback":function(){
                    $("#registros").val("");
                    var i = 0;
                    $("tbody#tbody_extrato").find("tr").each(function(){
                        var row_ant = $("#registros").val();
                        
                        var row_atl = $(this).attr('vlr');
                                                
                        if(row_ant==""){
                            var row_acm = row_atl;
                        }else{
                            var row_acm = row_ant + ";" + row_atl;
                        }
                        $("#registros").val(row_acm);
                    });
                }
            });
            
            //script para tratamento da janela modal de alteração do evento contábil
            $("td [rel=modalComplemento]").click( function(ev){
                ev.preventDefault();

                //alterado
                var id = '.windowComplemento';

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
                $('.windowComplemento').load(href);
                $(id).show();	
            });
            $(function() {
                $("input[name^=dt]").datepicker({
                    dateFormat: "dd/mm/yy",
                    altFormat: "yy-mm-dd"
                });
            });

        });
    </script>
    <title></title>
</head>
<div id="cnt">
    <!-- janela modal -->
    <div class="windowEvento" id="janela1"></div>
    <div class="windowComplemento" id="janela1"></div>
    <!-- mascara para cobrir o site -->	
    <div id="mascara"></div>
    <div id="cnt_01">
        <div id="cnt_01_01">
            <p class="imagem" id="logo">
                <a href="#" title="Meu Link"></a>
            </p>
        </div>
        <div id="cnt_01_02">
            <p>
                Financeira BRB</br>
                SCB - Sistema de Apoio à Conciliação Bancária</br>
            </p>
        </div>
        <div id="cnt_01_03">
            <p>
                Usuário: GERFI</br>
                Perfil: Contábil</br>
            </p>
        </div>
        <div id="cnt_01_04">
            <p class="imagem" id="logoff">
                <a href="#" title="Meu Link"></a>
            </p>
        </div>
    </div>
    <div id="cnt_02">
        <div id="cnt_02_01">
            <div id="cnt_02_01_01">
                <p id="exi_rec">
                    <button id="botao" value="ocultar"><<</button>
                </p>
            </div>
            <div id="cnt_02_01_02">
                <?php
                $id_nvl = '../../';
                include('../../menu_horizontal.php');
                ?>
            </div>
        </div>        
        <div id="cnt_02_02">
            <div id="cnt_02_02_01">
                <div id="navegacao">
                    Conciliação do Extrato Bancário - Filtro de Pesquisa
                </div>
            </div>
            <div id="cnt_02_02_02">
                <form id="consultaForm" action="extrato_conciliacao_filtro_02.php" method="post">
                    <label class="form">Conta Corrente : </label>
                    <select id="nro_cta" class="form" name="nro_cta">
                        <option value=""></option>
                        <option value="0270058303">027.005830-3</option>
                        <option value="0279200412">027.920041-2</option>
                        <option value="0279250169">027.925016-9</option>
                    </select>
                    <label class="form">Status : </label>
                    <select id="nro_cta" class="form" name="nro_cta">
                        <option value=""></option>
                        <option value="PENDENTE">PENDENTE</option>
                        <option value="CONCILIADO">CONCILIADO</option>
                    </select>
                    <label class="form">Natureza : </label>
                    <select id="nro_cta" class="form" name="nro_cta">
                        <option value=""></option>
                        <option value="RECEBIMENTO">RECEBIMENTO</option>
                        <option value="PAGAMENTO">PAGAMENTO</option>
                    </select>
                    <label class="form">Data Efetiva Inicial : </label>
                    <input class="form" id="datepicker1" type="date" name="dt_inc_in" value="" onkeydown="impede_enter();"/>
                    <label class="form">Data Efetiva Final : </label>
                    <input class="form" id="datepicker2" type="date" name="dt_inc_fi" value="" onkeydown="impede_enter();"/>
                    <label class="form">Data Valorização Inicial : </label>
                    <input class="form" id="datepicker3" type="date" name="dt_venc_in" value="" onkeydown="impede_enter();"/>
                    <label class="form">Data Valorização Final : </label>
                    <input class="form" id="datepicker4" type="date" name="dt_venc_fi" value="" onkeydown="impede_enter();"/>
                    <input id="acessar" type="submit" name="btn_localizar" value="Pesquisar"/>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
