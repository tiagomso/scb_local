<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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
        </style>
        <title></title>
        <link href="../../bibliotecas/css/estilo_barra_ferramentas.css" rel="stylesheet" type="text/css">
        <link href="../../bibliotecas/css/estilo_leiaute.css" rel="stylesheet" type="text/css">
        <link href="../../bibliotecas/css/estilo_menu_horizontal.css" rel="stylesheet" type="text/css">
        <script src="../../bibliotecas/js/jquery-1.8.2.min.js"></script>
        <script src="../../bibliotecas/js/login_ajax.js"></script>
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
                
                //########################################################
                $('#barra_ferramentas').on('click', '#exc', function(){
                    manutencaoDBO();
                    return false;
                });
            });

        </script>

        <!importação de folhas de estilo e script jquery para datatable>
    <link rel="stylesheet" type="text/css" media="screen" href="../../bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../../bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables_themeroller.min.css">
    <script src="../../bibliotecas/jquery/DataTables-1.10.0/media/js/jquery.js"></script>
    <script src="../../bibliotecas/jquery/DataTables-1.10.0/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#extrato').dataTable( {
                "language": {
                    "url": "../../bibliotecas/jquery/DataTables-1.10.0/media/portugues.txt"
                }
            } );
        } )
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
            <div id="cnt_02_02_01">Cadastro / Partidas Dobradas</div>
            <div id="cnt_02_02_02">
                <div id="barra_ferramentas">
                    <div id="esp" class="btn_div"></div>
                    <div id="inc" class="btn_div"><a class="btn" href="cadastro_partidas_incluir.php">Incluir</a></div>
                    <div id="alt" class="btn_div"><a class="btn" href="" id="url_u">Alterar</a></div>
                    <div id="exc" class="btn_div"><a class="btn" href="" id="url_d">Excluir</a></div>
                </div>
                <form action="" method="post">
                    <table id="extrato" class="display" nome="PARTIDAS" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Identificador</th>
                                <th>Natureza do lançamento</th>
                                <th>Evento</th>
                                <th>Nome da conta</th>
                                <th>Item contábil</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            require "../ferramentas/conexao_banco_dados.php";

                            $consulta = "SELECT * FROM tbl_evt_ptd_dbr";
                            $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
                            while (list ($id_ptd_res, $nat_cta_res, $id_evt_res, $id_csf_res, $nro_itm_res) = $resultado->fetch_row()) {
                                $id_ptd = $id_ptd_res;
                                $nat_cta = $nat_cta_res;
                                $id_evt = $id_evt_res;
                                $id_csf = $id_csf_res;
                                $nro_itm = $nro_itm_res;

                                echo "<tr id=\"$id_ptd\">";
                                echo "<td><input type=\"radio\" id=\"radio_$id_ptd\" onClick=\"radio('radio_$id_ptd')\" name=\"excluir[]\" value=\"$id_ptd\"></td>";
                                echo "<td>$id_ptd</td>";
                                echo "<td>$nat_cta</td>";
                                echo "<td>$id_evt</td>";
                                echo "<td>$id_csf</td>";
                                echo "<td>$nro_itm</td>";
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
