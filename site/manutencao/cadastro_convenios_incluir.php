<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="../../bibliotecas/css/estilo_barra_ferramentas.css" rel="stylesheet" type="text/css">
        <link href="../../bibliotecas/css/estilo_leiaute.css" rel="stylesheet" type="text/css">
        <link href="../../bibliotecas/css/estilo_menu_horizontal.css" rel="stylesheet" type="text/css">

        <style type="text/css">
            #exi_rec{
                text-align: right;
                padding-right: 10px;
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
                margin-top: 4px;

                /*estilização da fonte*/
                font-weight: bold;
                font-family: verdana;
                font-size: 12px;
                color: #585858;
                text-align: right;
                line-height: 27px;
            }
            input[type=text]{
                display: block;
                height: 20px;
                width: 250px;
                margin-top: 4px;
                margin-left: 155px;
            }
            input[type=submit]{
                display: block;
                height: 20px;
                width: 150px;
                margin-top: 35px;
                margin-left: 40px;
                float: left;
            }
            button#btn{
                display: block;
                height: 20px;
                width: 150px;
                margin-top: 35px;
                margin-left: 230px;
            }

        </style>

        <script src="../../bibliotecas/js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
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
                
                $('form').on('click', '#btn', function(){
                    var novaURL = "cadastro_convenios.php";
                    $(window.document.location).attr('href',novaURL);
                    return false;
                });
            });
        </script>
    </head>
    <div id="cnt">
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
                <div id="cnt_02_02_01">Cadastro / Convênios / Incluir</div>
                <div id="cnt_02_02_02">
                    <form action="cadastro_convenios_incluir.php" method="post">
                        <label class="form">Código COSIF </label>
                        <input type="text" name="cod_csf" value="">
                        <label class="form">Nome da conta </label>
                        <input type="text" name="nm_csf" value="">
                        <label class="form">Item contábil débito </label>
                        <input type="text" name="nro_itm_deb" value="">
                        <label class="form">Item contábil crédito</label>
                        <input type="text" name="nro_itm_cre" value="">
                        <input type="submit" value="Cadastrar Convênio" />
                        <button id="btn"><a style="text-decoration: none;color:black;">Voltar</a></button>
                    </form>
                    <?php

                    if (isset($_POST['cod_csf'])){
                        $cod_csf = $_POST['cod_csf'];
                        $nm_csf = $_POST['nm_csf'];
                        $nro_itm_deb = $_POST['nro_itm_deb'];
                        $nro_itm_cre = $_POST['nro_itm_cre'];

                        if ($cod_csf != ""){
                            require "../ferramentas/conexao_banco_dados.php";

                            $consulta = "INSERT INTO tbl_evt_ptd_dbr (nat_cta_lnc, id_evt_ctb, id_pln_cta, nro_itm) 
                                                    VALUES ('$cod_csf', '$nm_csf', '$nro_itm_deb', '$nro_itm_cre')";
                            $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
                            echo "<script>window.location.href = 'cadastro_convenios.php';</script>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


