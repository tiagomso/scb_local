<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <!importação de folhas de estilo para configuração de leiautes>
        <link href="../../bibliotecas/css/estilo_modelo_div.css" rel="stylesheet" type="text/css">
        <link href="../../bibliotecas/css/css_botoes.css" rel="stylesheet" type="text/css">
        
        
        <!importação de folhas de estilo e script jquery para datatable>
        <link rel="stylesheet" type="text/css" media="screen" href="../../bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="../../bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables_themeroller.min.css">
        <script src="../../bibliotecas/jquery/DataTables-1.10.0/media/js/jquery.js"></script>
        <script src="../../bibliotecas/jquery/DataTables-1.10.0/media/js/jquery.dataTables.min.js"></script>
        
        <!importação de scripts>
        <script src="../../bibliotecas/js/jquery-1.8.2.min.js"></script>
        <script src="../../bibliotecas/js/modal_formulario.js"></script>
        <script src="../../bibliotecas/js/login_ajax.js"></script>
        
        <script src="../../bibliotecas/jquery/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
        <script src="../../bibliotecas/jquery/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css">
        
        <script language="javascript">
            $(function() {
                $( "#tabs" ).tabs();
            });
            $(document).ready(function() {
                $('#extrato').dataTable();
            } );    
        </script>
       
        <!estilização especifica da página>
        <style type="text/css">
            #critica{
                display: inline-block;
                color: red;
                background-color: yellow;
                width:400px;
                height:20px;
                text-align: center;
                border: 5px;
                border-color: yellowgreen;
            }
            .windowEvento{
                display:none;
                width:550px;
                height:450px;
                position:fixed;
                left:0;
                top:0;
                background:#FFF;
                z-index:3;
                padding:5px;
                border-radius:1px;
                
                /* Cantos arredondados */
                -webkit-border-radius: 10px;
                -moz-border-radius: 10px;

                /* Sombra do texto */
                text-shadow: -1px -1px 1px rgba(0,0,0,.3);

                /* Sombra do botão */
                -webkit-box-shadow: 2px 2px 4px rgba(0,0,0,.3);
                -moz-box-shadow: 2px 2px 4px rgba(0,0,0,.3);
            }
            .windowComplemento{
                display:none;
                width:1050px;
                height:550px;
                position:fixed;
                left:0;
                top:0;
                background:#FFF;
                z-index:4;
                padding:5px;
                border-radius:1px;
                
                /* Cantos arredondados */
                -webkit-border-radius: 10px;
                -moz-border-radius: 10px;

                /* Sombra do texto */
                text-shadow: -1px -1px 1px rgba(0,0,0,.3);

                /* Sombra do botão */
                -webkit-box-shadow: 2px 2px 4px rgba(0,0,0,.3);
                -moz-box-shadow: 2px 2px 4px rgba(0,0,0,.3);
            }
            #mascara{
                position:absolute;
                z-index:2;
                background-color:#000;
                display:none;
            }
            #formComplemento {
                margin-top: 30px;
            }
            #formComplemento .label{
                float: left;
                width: 100px;
                margin-right: 2px;
                text-align: right;
                font-family: verdana;
                clear: left;
                display: block;
            	padding: 10px;
                color: #666;
                font-weight: bold;
            }
            #formEvento {
                margin-top: 30px;
            }
            #formEvento .label{
                float: left;
                width: 100px;
                margin-right: 2px;
                text-align: right;
                font-family: verdana;
                clear: left;
                display: block;
            	padding: 10px;
                color: #666;
                font-weight: bold;
            }
            #salvar {
                float: left;
                width: 100px;
                margin-left: 30px;
                margin-top: 30px;
            }
            #sair {
                float: left;
                width: 100px;
                margin-left: 30px;
                margin-top: 30px;
            }
            #voltar {
                float: left;
                width: 100px;
                margin-left: 30px;
                margin-top: 30px;
            }
            #avancar {
                float: left;
                width: 100px;
                margin-left: 30px;
                margin-top: 30px;
            }
            .text{
                float: left;
                width: 400px;
                margin-left: 2px;
                text-align: left;
                font-family: verdana;
                display: block;
            	padding: 5px;
                color: #666;
                font-weight: bold;
            }
        </style>
        <title>SCB</title>
    </head>
    <body>
        <!-- janela modal -->
        <div class="windowEvento" id="janela1"></div>
        <div class="windowComplemento" id="janela1"></div>
        <!-- mascara para cobrir o site -->	
        <div id="mascara"></div>
        <div id="cnt_principal">
            <div id="cnt_container_01">
                <div id="cnt_logotipo">
                    <p>SCB - Sistema de Conciliação Bancária</p>
                </div>
                <div id="cnt_usuario">
                    <?php
                        //include('usuario_verifica.php');
                    ?>
                </div>
            </div>
            <div id="cnt_navegacao">
                <p>Você esta em > Início</p>
            </div>
            <div id="cnt_container_02">
                <div id="cnt_menu">
                    <?php
                       $id_nvl = '../../';
                include('../../menu_horizontal.php');
                    ?>
                </div>
                <div id="cnt_conteudo_principal">
                    <form action="" method="post">
                        <table id="extrato" class="display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="display:none">Id</th>
                                    <th>Id</th>
                                    <th>Conta corrente</th>
                                    <th>Data valorização</th>
                                    <th>Histórico</th>
                                    <th>Valor lançamento</th>
                                    <th>Natureza</th>
                                    <th>Evento</th>
                                    <th>Complemento</th>
                                    <th>Checagem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require "../ferramentas/conexao_banco_dados.php";
                                    $consulta = "SELECT tbl_lnc_fin.id_lanc, tbl_lnc_fin.id_seq_dt, tbl_lnc_fin.dt_vlz,
                                                        tbl_lnc_fin.txt_hst, tbl_lnc_fin.vlr_lnc, 
                                                        tbl_lnc_fin.nat_fin_lnc,tbl_lnc_fin.nat_ctb_lnc, tbl_lnc_fin.id_cnc, 
                                                        (SELECT tbl_evt_ctb.nm_evt_ctb FROM tbl_evt_ctb WHERE tbl_lnc_fin.id_evt_ctb = tbl_evt_ctb.id_evt_ctb), 
                                                        (SELECT tbl_cta.nro_cta FROM tbl_cta WHERE tbl_cta.id_cta = tbl_lnc_fin.id_cta)
                                                        FROM tbl_lnc_fin";
                                    $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
                                    while(list ($id_lanc, $id_seq_dt, $dt_vlz, $txt_hst, $vlr_lnc, $nat_fin_lnc, $nat_ctb_lnc, $id_cnc, $id_evt_ctb, $id_cta) = $resultado->fetch_row()){

                                        $vlr_lnc = number_format($vlr_lnc, 2, ',', '.');

                                        echo "<tr id=\"tbl_lnh_$id_lanc\" style=\"cursor:default\" onMouseOver=\"javascript:this.style.backgroundColor='#ECFDA4'\" onMouseOut=\"javascript:this.style.backgroundColor=''\">";
                                        echo "<td id=\"tbl_cln_01_$id_lanc\"><input type=\"checkbox\" id=\"radio_$id_lanc\" onClick=\"radio('radio_$id_lanc')\" name=\"excluir[]\" value=\"$id_lanc\"></td>";
                                        echo "<td id=\"tbl_cln_02_$id_lanc\" style=\"display:none\">$id_lanc</td>";
                                        echo "<td id=\"tbl_cln_03_$id_lanc\">$id_seq_dt</td>";
                                        echo "<td id=\"tbl_cln_04_$id_lanc\">$id_cta</td>";
                                        echo "<td id=\"tbl_cln_05_$id_lanc\">$dt_vlz</td>";
                                        echo "<td id=\"tbl_cln_06_$id_lanc\">$txt_hst</td>";
                                        echo "<td id=\"tbl_cln_07_$id_lanc\" align=right>$vlr_lnc</td>";
                                        echo "<td id=\"tbl_cln_08_$id_lanc\">$nat_fin_lnc</td>";
                                        echo "<td id=\"tbl_cln_09_$id_lanc\"><a href=\"extrato_conciliacao_form_evento.php?id_lanc=$id_lanc\" rel=\"modalEvento\">$id_evt_ctb</a></td>";
                                        echo "<td id=\"tbl_cln_10_$id_lanc\"><a href=\"extrato_conciliacao_form_comp.php?id_lanc=$id_lanc\" rel=\"modalComplemento\">$id_cnc</td>";
                                        echo "<td id=\"tbl_cln_11_$id_lanc\">PENDENTE</td>";
                                        echo "</tr>";
                                    }
                                    //fecha a conexão com o banco de dados
                                    $mysqli->close();
                                ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
            <div id="footer">
                <p>Financeira BRB DIFAD / SUFAD / GERFI</p>
            </div>
        </div>
    </body>
</html>
