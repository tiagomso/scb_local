<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link href="bibliotecas/css/estilo_leiaute.css" rel="stylesheet" type="text/css">
        <link href="bibliotecas/css/estilo_menu_horizontal.css" rel="stylesheet" type="text/css">
        <link href="bibliotecas/css/estilo_janela_modal.css" rel="stylesheet" type="text/css">
        <link href="bibliotecas/css/estilo_icones.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" media="screen" href="bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables_themeroller.min.css">

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
        </style>

        <script src="bibliotecas/jquery/DataTables-1.10.0/media/js/jquery.js"></script>
        <script src="bibliotecas/jquery/DataTables-1.10.0/media/js/jquery.dataTables.min.js"></script>
        <script src="bibliotecas/js/login_ajax.js"></script>
        <script src="bibliotecas/js/priceFormat.js"></script>

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
                    $id_nvl = '';
                    include('menu_horizontal.php');
                    ?>
                </div>
            </div>        
            <div id="cnt_02_02">
                <div id="cnt_02_02_01">
                    <div id="navegacao">
                        Início
                    </div>

                </div>
                <div id="cnt_02_02_02">
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>