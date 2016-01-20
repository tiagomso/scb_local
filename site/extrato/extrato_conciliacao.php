<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <link href="../../bibliotecas/css/estilo_leiaute.css" rel="stylesheet" type="text/css">
        <link href="../../bibliotecas/css/estilo_menu_horizontal.css" rel="stylesheet" type="text/css">
        <link href="../../bibliotecas/css/estilo_janela_modal.css" rel="stylesheet" type="text/css">
        <link href="../../bibliotecas/css/estilo_icones.css" rel="stylesheet" type="text/css">

        <!importação de folhas de estilo e script jquery para datatable>
    <link rel="stylesheet" type="text/css" media="screen" href="../../bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../../bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables_themeroller.min.css">
    <script src="../../bibliotecas/jquery/DataTables-1.10.0/media/js/jquery.js"></script>
    <script src="../../bibliotecas/jquery/DataTables-1.10.0/media/js/jquery.dataTables.min.js"></script>
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
        .lnk_frm:link{
            text-decoration: none;
            font: 12px verdana;
            color: black;
            max-height: 50px;
        }
        .lnk_frm:visited{
            text-decoration: none;
            font: 12px verdana;
            color: black;
            max-height: 50px;
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
                    Conciliação do Extrato Bancário
                </div>

            </div>
            <div id="cnt_02_02_02">
                <input id="registros" style="display:none" type="text" value="0">
                <form action="" method="post">
                    <table id="extrato" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="display: none">Id</th>
                                <th>Seq.</th>
                                <th>Conta corrente</th>
                                <th>Data valorização</th>
                                <th>Documento</th>
                                <th>Histórico</th>
                                <th>Valor lançamento</th>
                                <th>D/C</th>
                                <th>Evento</th>
                                <th>Complemento</th>
                                <th>Checagem</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_extrato">
                            <?php
                            require "../ferramentas/conexao_banco_dados.php";
                            $consulta = "SELECT tbl_lnc_fin.id_lanc, tbl_lnc_fin.id_seq_dt, tbl_lnc_fin.dt_vlz,
                                                        tbl_lnc_fin.nro_doc, tbl_lnc_fin.txt_hst, tbl_lnc_fin.vlr_lnc, 
                                                        tbl_lnc_fin.nat_fin_lnc,tbl_lnc_fin.nat_ctb_lnc, tbl_lnc_fin.id_cnc, 
                                                        (SELECT tbl_evt_ctb.nm_evt_ctb FROM tbl_evt_ctb WHERE tbl_lnc_fin.id_evt_ctb = tbl_evt_ctb.id_evt_ctb), 
                                                        (SELECT tbl_cta.nro_cta FROM tbl_cta WHERE tbl_cta.id_cta = tbl_lnc_fin.id_cta)
                                                        FROM tbl_lnc_fin";
                            $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
                            while (list ($id_lanc, $id_seq_dt, $dt_vlz, $nro_doc, $txt_hst, $vlr_lnc, $nat_fin_lnc, $nat_ctb_lnc, $id_cnc, $id_evt_ctb, $id_cta) = $resultado->fetch_row()) {


                                $vlr_lnc = number_format($vlr_lnc, 2, ',', '.');
                                $dt_vlz = date("d/m/Y", strtotime($dt_vlz));

                                $link = "<a style=\"display: block\" class=\"lnk_frm\" href=\"extrato_conciliacao_form_comp.php?id_lanc=$id_lanc\" rel=\"modalComplemento\">";

                                echo "<tr id=\"tbl_lnh_$id_lanc\" vlr=\"$id_lanc\" style=\"cursor:hand\" onMouseOver=\"javascript:this.style.backgroundColor='#ECFDA4'\" onMouseOut=\"javascript:this.style.backgroundColor=''\">";
                                echo "<td id=\"tbl_cln_01_$id_lanc\"><input type=\"radio\" id=\"radio_$id_lanc\" onClick=\"radio('radio_$id_lanc')\" name=\"excluir[]\" value=\"$id_lanc\"></td>";
                                echo "<td id=\"tbl_cln_02_$id_lanc\" style=\"display: none\">$id_lanc</td>";
                                echo "<td id=\"tbl_cln_03_$id_lanc\">$link$id_seq_dt</a></td>";
                                echo "<td id=\"tbl_cln_04_$id_lanc\">$link$id_cta</a></td>";
                                echo "<td id=\"tbl_cln_05_$id_lanc\">$link$dt_vlz</a></td>";
                                echo "<td id=\"tbl_cln_06_$id_lanc\">$link$nro_doc</a></td>";
                                echo "<td id=\"tbl_cln_07_$id_lanc\">$link$txt_hst</a></td>";
                                echo "<td id=\"tbl_cln_08_$id_lanc\" align=right>$link$vlr_lnc</a></td>";
                                echo "<td id=\"tbl_cln_09_$id_lanc\">$link$nat_fin_lnc</a></td>";
                                echo "<td id=\"tbl_cln_10_$id_lanc\">$link$id_evt_ctb</a></td>";
                                echo "<td id=\"tbl_cln_11_$id_lanc\">$link$id_cnc</a></td>";
                                echo "<td id=\"tbl_cln_12_$id_lanc\">$link PENDENTE</a></td>";
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
    </div>
</div>
</body>
</html>
