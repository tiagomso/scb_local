<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link href="../../bibliotecas/css/estilo_leiaute.css" rel="stylesheet" type="text/css">
        <link href="../../bibliotecas/css/estilo_menu_horizontal.css" rel="stylesheet" type="text/css">
        <link href="../../bibliotecas/css/estilo_janela_modal.css" rel="stylesheet" type="text/css">
        <link href="../../bibliotecas/css/estilo_icones.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" media="screen" href="../../bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="../../bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables_themeroller.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="../../bibliotecas/jquery/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.min.css">

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
                font: bold 12px/24px arial, helvetica, sans-aerif;
            }
            form{
                height: 250px;
                width: 450px;
                position: absolute;
                left: 45%;
                top: 35%;
                
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
                width: 150px;
                float: left;
                margin-top: 20px;

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
                margin-top: 20px;
                margin-left: 10px;
                
            }
            
            input[type=submit]{
                display: block;
                height: 25px;
                width: 150px;
                margin-top: 35px;
                margin-left: 50px;  
                float: left;
            }

            button#btn{
                display: block;
                height: 25px;
                width: 150px;
                margin-top: 175px;
                margin-left: 250px;
            }

        </style>

        <script src="../../bibliotecas/jquery/DataTables-1.10.0/media/js/jquery.js"></script>
        <script src="../../bibliotecas/jquery/DataTables-1.10.0/media/js/jquery.dataTables.min.js"></script>
        <script src="../../bibliotecas/jquery/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
        <script src="../../bibliotecas/js/login_ajax.js"></script>
        <script src="../../bibliotecas/js/priceFormat.js"></script>

        <script type="text/javascript">

            function validateForm(){
                var x=document.forms["importar_extrato"]["nro_cta"].value; //nome do form e nome do campo são case sensitive (a <> A)
                if (x==null || x==""){
                    alert("O campo NUMERO DA CONTA é obrigatório!");
                    return false;
                }
                var y=document.forms["importar_extrato"]["datepicker"].value; //nome do form e nome do campo são case sensitive (a <> A)
                if (y==null || y==""){
                    alert("O campo DATA EFETIVA é obrigatório!");
                    return false;
                }
            }


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
                $(function() {
                    $( "#datepicker" ).datepicker({
                        dateFormat: "dd/mm/yy",
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
                        Início
                    </div>

                </div>
                <div id="cnt_02_02_02">
                    <form id="importar_extrato" enctype="multipart/form-data" action="importar_extrato_mover_arquivo.php" onsubmit="return validateForm()" method="post">
                        <label class="form">Número da Conta </label>
                        <select id="nro_cta" class="form" name="nro_cta">
                            <option value=""></option>
                            <option value="0270058303">027.005830-3</option>
                            <option value="0279200412">027.920041-2</option>
                            <option value="0279250169">027.925016-9</option>
                        </select>
                        
                        <label class="form">Data Efetiva </label>
                        <input class="form" type="date" name="dt_eft" value="" id="datepicker">
                        
                        <label class="form">Arquivo </label>
                        <input class="form" type="file" name="arquivo" value="">
                        
                        <input type="submit" value="Importar Arquivo" />
                        <button id="btn"><a style="text-decoration: none;color:black; " href="extrato_menu.php?excluir=0">Voltar</a></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
