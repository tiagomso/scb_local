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
            #th{
            height: 50px;
            font: bold 12px verdana;
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

        <!importação de folhas de estilo e script jquery para datatable>
        <link rel="stylesheet" type="text/css" media="screen" href="bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables_themeroller.min.css">
        <script src="bibliotecas/jquery/DataTables-1.10.0/media/js/jquery.js"></script>
        <script src="bibliotecas/jquery/DataTables-1.10.0/media/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#extrato').dataTable( {
                    "language": {
                        "url": "bibliotecas/jquery/DataTables-1.10.0/media/portugues.txt"
                    },
                    "searching": false,
                    "ordering": false,
                    "paging": false,
                    "lengthChange": false,
                    "info": false,
                    "pageLength": 50
                } );
            } )
        </script>
        
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
                    <form action="" method="post">
                        <table id="extrato" class="display" nome="CONTAS" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Identificador</th>
                                    <th>Movimento</th>
                                    <th>Total D MOV.</th>
                                    <th>Total D CNC.</th>
                                    <th>Total C MOV.</th>
                                    <th>Total C CNC.</th>
                                    <th>Conciliação</th>
                                    <th>Conferência</th>
                                    <th>Encerramento</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                require "site/ferramentas/conexao_banco_dados.php";

                                $consulta = "SELECT * FROM `tbl_ctl_dt` 
                                            WHERE (`id_ctl_dt` - 7) < (SELECT `id_ctl_dt` FROM `tbl_ctl_dt` WHERE `dt_mov` LIKE CURDATE()) 
                                            AND (`id_ctl_dt` + 7) > (SELECT `id_ctl_dt` FROM `tbl_ctl_dt` WHERE `dt_mov` LIKE CURDATE())";
                                $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
                                while (list ($id_ctl_dt_res, $dt_mov_res, $sit_sts_res, $vlr_deb_ins_res, $vlr_deb_cnc_res, $vlr_cre_ins_res, $vlr_cre_cnc_res, $sit_cnc_res, $sit_cmp_res) = $resultado->fetch_row()) {
                                    $id_ctl_dt = $id_ctl_dt_res;
                                    $dt_mov = date("d/m/Y", strtotime($dt_mov_res));
                                    $dt_mov_res_02 = date("Y-m-d", strtotime($dt_mov_res));
                                    $sit_sts = $sit_sts_res;
                                    $vlr_deb_ins = number_format($vlr_deb_ins_res, 2, ',', '.');
                                    $vlr_deb_cnc = number_format($vlr_deb_cnc_res, 2, ',', '.');
                                    $vlr_cre_ins = number_format($vlr_cre_ins_res, 2, ',', '.');
                                    $vlr_cre_cnc = number_format($vlr_cre_cnc_res, 2, ',', '.');
                                    $sit_cnc = $sit_cnc_res;
                                    $sit_cmp = $sit_cmp_res;
                                    
                                    $link = "<a style=\"display: block\" class=\"lnk_frm\" href=\"site/extrato/extrato_conciliacao_filtro_02.php?dt_eft_req=$dt_mov_res_02\" rel=\"modalComplemento\">";

                                    echo "<tr id=\"$id_ctl_dt\" style=\"cursor:hand\" onMouseOver=\"javascript:this.style.backgroundColor='#ECFDA4'\" onMouseOut=\"javascript:this.style.backgroundColor=''\">";
                                    echo "<td align=center>$id_ctl_dt</td>";
                                    echo "<td align=center>$link$dt_mov</a></td>";
                                    echo "<td align=right>$vlr_deb_ins</td>";
                                    echo "<td align=right>$vlr_deb_cnc</td>";
                                    echo "<td align=right>$vlr_cre_ins</td>";
                                    echo "<td align=right>$vlr_cre_cnc</td>";
                                    echo "<td>$sit_sts</td>"; //estado do movimento (ENCERRADO / PENDENTE)
                                    echo "<td>$sit_cnc</td>"; //estado da conciliação dos valores (CONCLUIDO / PENDENTE)
                                    echo "<td>$sit_cmp</td>"; //estado da conferencia pelo gerente ou analista ( CONCLUIDO / PENDENTE)
                                    echo "</tr>";
                                }
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