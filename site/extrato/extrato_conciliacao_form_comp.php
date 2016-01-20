<!importação de folhas de estilo e script jquery/javascript para abas da janela modal>
<head>
    <link rel="stylesheet" type="text/css" href="../../bibliotecas/jquery/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" type="text/css" href="../../bibliotecas/css/estilo_formulario.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../../bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../../bibliotecas/jquery/DataTables-1.10.0/media/css/jquery.dataTables_themeroller.min.css">
    
    <script src="../../bibliotecas/jquery/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>

    <style type="text/css">
        #tabs{
            height: 98%;
        }
        table#tab_comp.tabelaEditavel{
            width: 100%;
        }
        tr#reg_comp{
            height: 24px;
            border: solid;
            border-color: black; 
            border-width: .1em;
        }
        #id_evt_ctb_chosen{
            margin-top: 10px;
        }
        .chosen-container {
            font-size: 12px;
            vertical-align: top;
        }
        
        .chosen-container-single .chosen-single {
            background: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(20%, #ffffff), color-stop(50%, #ffffff), color-stop(52%, #ffffff), color-stop(100%, #ffffff));
            background: -webkit-linear-gradient(top, #ffffff 20%, #ffffff 50%, #ffffff 52%, #ffffff 100%);
            background: -moz-linear-gradient(top, #ffffff 20%, #ffffff 50%, #ffffff 52%, #ffffff 100%);
            background: -o-linear-gradient(top, #ffffff 20%, #ffffff 50%, #ffffff 52%, #ffffff 100%);
            background: linear-gradient(top, #ffffff 20%, #ffffff 50%, #ffffff 52%, #ffffff 100%);
            box-shadow: 0 0 3px white inset, 0 1px 1px rgba(0, 0, 0, 0);
        }
        form#form_partidas_dobradas{
            float: left;
            margin-top: 40px;
            height: 295px;
            width: 900px;
        }
        input[name=inp_pdt_dbd]{
            text-align: right;
            height: 18px;
            margin: 4px;
            margin-top: 1px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){          
            //########################################################
            $("#tabs").tabs();
        
            //########################################################
            $('#botoes').on('click', '#btn_slv', function(){
                salvarEvento();
                return false;
            });
                 
            //########################################################
            $('#extrato').on('click', '.lnk_frm', function(){
                $("tr [rel=modalComplemento]").click( function(ev){
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
                return false;
            });
        
            //########################################################
            $('#tab_comp').on('click', '.lnk_exc', function(){
                var tr = $(this).closest('tr');
                var cnt_bd = $(this).closest('tr').attr('cnt_bd');
                        
                var qtd_reg_cmp = parseInt($("input#qtde_comp").val());
                var nro_reg_cmp = parseInt(tr.text());
            
                if((nro_reg_cmp == qtd_reg_cmp)||(cnt_bd=='true')){
                    if (cnt_bd=="false"){
                        tr.fadeOut(400, function(){
                            $("label#ctc_comp").prop('class','ctc_comp_exc');
                            tr.remove();
                            //voltarClasseNormal();
                        });
                        document.getElementById("ctc_comp").innerHTML = "Registro removido com sucesso!" 
                    }else if (cnt_bd=="true"){
                        var id_lanc = $("input#id_lanc").val();
                        var cnt_bd = $(this).closest('tr').attr('cnt_bd');
                        var id_seq = $(this).closest('tr').attr('id_seq');
                        var camp_alt = "";
                        var novoConteudo = "";
                        var id_ope = "DELETE";
                        
                        var dadosajax = {
                            'id_lanc' : id_lanc,
                            'id_seq' : id_seq,
                            'camp_alt' : camp_alt,
                            'txt_cont' : novoConteudo,
                            'id_ope' : id_ope
                        };
                        
                        $.ajax({
                            url: 'complemento_gravar.php',
                            data: dadosajax,
                            type: 'POST',
                            cache: false,
                            error: function(){
                                alert('Erro');
                            },
                            success: function(result){
                                resultado = parseInt($.trim(result));
                                //se foi inserido com sucesso
                                if($.trim(result) == '4'){
                                    tr.fadeOut(400, function(){
                                        $("label#ctc_comp").prop('class','ctc_comp_exc');
                                        tr.remove();
                                    });
                                    document.getElementById("ctc_comp").innerHTML = "Complemento '" + id_seq + "' do registro '" + id_lanc + "' excluído com sucesso!"
                                    //voltarClasseNormal();
                                }else if($.trim(result) == '5'){
                                    document.getElementById("ctc_comp").innerHTML = "Complemento '" + id_seq + "' do registro '" + id_lanc + "' não excluído com sucesso!"
                                    //voltarClasseNormal();
                                }
                            }
                        });
                    }            
                    document.getElementById('qtde_comp').value = qtd_reg_cmp - 1;
                }else{
                    $("label#ctc_comp").prop('class','ctc_comp_lmt');
                    document.getElementById("ctc_comp").innerHTML = "Excluir registro do maior ID para o menor ID!";
                    //voltarClasseNormal();
                };
                return false;
            });
        
            //########################################################
            $('#tab_comp').on('dblclick', 'td', function(){
                //Recuperar o ID da coluna que esta sofrendo alteração
                var conteudoOriginal = $(this).text();
                                    
                //recuperar todas as variaveis do registro para atualização no BD
                var id_lanc = $("input#id_lanc").val();
                var cnt_bd = $(this).closest('tr').attr('cnt_bd');
                var id_seq = $(this).closest('tr').attr('id_seq');
                var camp_alt = $(this).attr('nm_cmp');
                var id_ope = "";
            
                if (cnt_bd=='true') {
                    id_ope = "UPDATE";
                } else if (cnt_bd=='false') {
                    id_ope = "INSERT";
                }
               
                $(this).addClass("celulaEmEdicao");
                $(this).html("<input type='text' value='" + conteudoOriginal + "' />");
                $(this).children().first().focus();
                $(this).children().first().keypress(function (e) {
                    if (e.which == 13) {
                        var novoConteudo = $(this).val();
                        $(this).parent().text(novoConteudo);
                        $(this).parent().priceFormat({
                            prefix: '',
                            centsSeparator: ',',
                            thousandsSeparator: '.'
                        });
                        $(this).parent().removeClass("celulaEmEdicao");
                        
                        novoConteudo = novoConteudo.replace(",",".");

                        //dados a enviar, vai buscar os valores dos campos que queremos enviar para a BD
                        var dadosajax = {
                            'id_lanc' : id_lanc,
                            'id_seq' : id_seq,
                            'camp_alt' : camp_alt,
                            'txt_cont' : novoConteudo,
                            'id_ope' : id_ope
                        };
                                            
                        $.ajax({
                            url: 'complemento_gravar.php',
                            data: dadosajax,
                            type: 'POST',
                            cache: false,
                            error: function(){
                                alert('Erro');
                            },
                            success: function(result){
                                resultado = parseInt($.trim(result));
                                //alert("resultado : " + $.trim(result) + " // novoConteudo : " + novoConteudo + " // id_lanc : " + id_lanc + " // cnt_bd : " + cnt_bd + " // id_seq : " + id_seq + " // camp_alt : " + camp_alt + " // id_ope : " + id_ope);
                                //alert("resultado : " + $.trim(result));
                                //se foi inserido com sucesso
                                if($.trim(result) == '0'){
                                    document.getElementById("ctc_comp").innerHTML = "Campo '" + camp_alt + "' do registro '" + id_lanc + "' não atualizado!"
                                }else if($.trim(result) == '1'){
                                    document.getElementById("ctc_comp").innerHTML = "Campo '" + camp_alt + "' do registro '" + id_lanc + "' atualizado com sucesso!"
                                }else if($.trim(result) == '2'){
                                    $("tr[id_seq=" + id_seq + "]").attr({'cnt_bd':"true"});
                                    document.getElementById("ctc_comp").innerHTML = "Campo '" + camp_alt + "' do registro '" + id_lanc + "' inserido com sucesso!"
                                }else if($.trim(result) == '3'){
                                    document.getElementById("ctc_comp").innerHTML = "Campo '" + camp_alt + "' do registro '" + id_lanc + "' não inserido!"
                                }
                            }
                        });
                    }
                });
                $(this).children().first().blur(function(){
                    $(this).parent().text(conteudoOriginal);
                    $(this).parent().removeClass("celulaEmEdicao");
                });
                return false;
            });
    
            //########################################################
            $("#btn_ins").click(function(){
                var qtd_reg_cmp = parseInt($("input#qtde_comp").val());
                var qtd_reg_cmp_new = qtd_reg_cmp + 1;
            
                if (qtd_reg_cmp == 0){
                    removerLinhas();
                }

                if (qtd_reg_cmp >= 30){
                    document.getElementById("ctc_comp").innerHTML = "Quantidade máxima de complementos já atingida!";
                    $("label#ctc_comp").prop('class','ctc_comp_lmt');
                }else{
                    $("label#ctc_comp").prop('class','ctc_comp_ins');
                
                    document.getElementById('qtde_comp').value = qtd_reg_cmp_new;
                    document.getElementById("ctc_comp").innerHTML = "Insira os dados obrigatórios na tabela em clique em salvar!";
            
                    var tr_in = "<tr id=\"reg_comp\" cnt_bd=\"false\" id_seq=\"" + qtd_reg_cmp_new + "\" style=\"cursor:default\" onMouseOver=\"javascript:this.style.backgroundColor='#ECFDA4'\" onMouseOut=\"javascript:this.style.backgroundColor=''\">";
                    var td_00 = "<td nm_cmp=\"id_seq_cmp\">" + qtd_reg_cmp_new + "'</td>";
                    var td_01 = "<td nm_cmp=\"cod_cpf\"></td>";
                    var td_02 = "<td nm_cmp=\"cod_clt\"></td>";
                    var td_03 = "<td nm_cmp=\"nro_ctr\"></td>";
                    var td_04 = "<td nm_cmp=\"cod_cvn\"></td>";
                    var td_05 = "<td nm_cmp=\"vlr_comp\"></td>";
                    var td_06 = "<td nm_cmp=\"nro_pcl\"></td>";
                    var td_07 = "<td nm_cmp=\"nro_pcl_ini\"></td>";
                    var td_08 = "<td nm_cmp=\"nro_pcl_fin\"></td>";
                    var td_09 = "<td><a class=\"lnk_exc\" href=\"#\">Excluir</a></td>";
                    var tr_out = "</tr>";
            
                    var tr_end =    tr_in + td_00 + td_01 + td_02 + td_03 + td_04 + td_05 + td_06 + td_07 + td_08 + td_09 + tr_out;
                                        
                    $('#tab_comp').append(tr_end);
                }
                //voltarClasseNormal();
            });
            
            //########################################################
            $(".chosen-select_0").chosen({
                width: "102%",
                no_results_text: "Ops, nenhum evento encontrado!",
                placeholder_text_single: "Selecione um evento"
            });
            
            //########################################################
            $(".chosen-select_1").chosen({
                width: "15%",
                no_results_text: "Ops, nenhum lançamento encontrado!",
                placeholder_text_single: "DEB/CRED"
            });
            
            //########################################################
            $(".chosen-select_2").chosen({
                width: "65%",
                no_results_text: "Ops, nenhuma conta encontrada!",
                placeholder_text_single: "Selecione uma conta"
            });
            
        });
    </script>
</head>
<div id="tabs">
    <ul>
        <li id="tab_01"><a href="#tabs-1">Evento</a></li>
        <li id="tab_02"><a href="#tabs-2">Partidas</a></li>
        <li id="tab_03"><a href="#tabs-3">Complemento</a></li>
        <li id="tab_04"><a href="#tabs-4">Histórico</a></li>
        <li id="tab_05"><a href="#tabs-5">Autorização</a></li>
    </ul>
    <div id="tabs-1">
        <div id="critica">
            <label id="ctc"></label>
        </div>
        <div id="div_lnc">
            <div id="lbl_lnc">
                <label id="lbl">Número sequencial único (NSU) :</label>
            </div>
            <div id="inp_lnc">
                <?php
                $id_lanc = $_GET['id_lanc'];
                echo "<input type=\"text\" name=\"inp\" id=\"id_lanc\" value=\"$id_lanc\"></p>";
                ?>
            </div>
            <div id="div_load">
                <img src="../../imagens/ajax-loader (1).gif">
            </div>
        </div>
        <div id="conteudo">
            <div id="lbl_cnt">
                <label id="lbl">Identificador :</label>
                <label id="lbl">Conta corrente :</label>
                <label id="lbl">Data de valorização :</label>
                <label id="lbl">Documento :</label>
                <label id="lbl">Histórico :</label>
                <label id="lbl">Valor do lançamento :</label>
                <label id="lbl">Natureza Contábil:</label>
                <label id="lbl">Evento financeiro:</label>
                <label id="lbl">Complemento :</label>
            </div>
            <div id="inp_cnt">
                <?php
                global $id_evt_ctb_rec;
                $id_lanc = $_GET['id_lanc'];
                require "../ferramentas/conexao_banco_dados.php";

                echo "<form id=\"formComplemento\" action=\"extrato_conciliacao_form_comp.php?id_lanc=$id_lanc\" method=\"post\" autocomplete=\"off\">";

                $consulta = "SELECT tbl_lnc_fin.id_lanc, tbl_lnc_fin.id_seq_dt, tbl_lnc_fin.dt_vlz,
                            tbl_lnc_fin.nro_doc, tbl_lnc_fin.txt_hst, tbl_lnc_fin.vlr_lnc, 
                            tbl_lnc_fin.nat_fin_lnc, tbl_lnc_fin.nat_ctb_lnc, tbl_lnc_fin.id_cnc, 
                            tbl_lnc_fin.id_evt_ctb, tbl_lnc_fin.id_cta,
                            (SELECT tbl_cta.nro_cta FROM tbl_cta WHERE tbl_cta.id_cta = tbl_lnc_fin.id_cta)
                            FROM tbl_lnc_fin WHERE tbl_lnc_fin.id_lanc = $id_lanc";
                $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
                while (list ($id_lnc, $id_seq_dt, $dt_vlz, $nro_doc, $txt_hst, $vlr_lnc, $nat_fin_lnc, $nat_ctb_lnc, $id_cnc, $id_evt_rec, $id_cta, $id_nm_cta) = $resultado->fetch_row()) {

                    $vlr_lnc = number_format($vlr_lnc, 2, ',', '.');
                    $dt_vlz = date("d/m/Y", strtotime($dt_vlz));
                    $id_evt_ctb_rec = (int) $id_evt_rec;
                    if($nat_ctb_lnc == "C"){
                        $nat_ctb_lnc = "CRÉDITO";
                    }else{
                        $nat_ctb_lnc = "DÉBITO";
                    }

                    echo "<input type=\"text\" name=\"inp\" id=\"id_seq_dt\" value=\"$id_seq_dt\"></p>";
                    echo "<input type=\"text\" name=\"inp\" id=\"id_cta\" value=\"$id_nm_cta\"></p>";
                    echo "<input type=\"text\" name=\"inp\" id=\"dt_vlz\" value=\"$dt_vlz\"></p>";
                    echo "<input type=\"text\" name=\"inp\" id=\"nro_doc\" value=\"$nro_doc\"></p>";
                    echo "<input type=\"text\" name=\"inp\" id=\"txt_hst\" value=\"$txt_hst\"></p>";
                    echo "<input type=\"text\" name=\"inp\" id=\"vlr_lnc\" value=\"$vlr_lnc\"></p>";
                    echo "<input type=\"text\" name=\"inp\" id=\"nat_fin_lnc\" value=\"$nat_ctb_lnc\"></p>";
                    echo "<script>autorizacaoSelect('$id_cnc')</script>";
                }
                echo "<select class=\"chosen-select_0\" name=\"sel\" id=\"id_evt_ctb\" onkeydown=\"impede_enter();\">";
                echo "<option value=\"0\"></option>";
                $query = "SELECT id_evt_ctb, nm_evt_ctb FROM tbl_evt_ctb ORDER BY nm_evt_ctb";
                $resultado = $mysqli->query($query, MYSQLI_STORE_RESULT);
                while (list ($id_evt_ctb, $txt_evento) = $resultado->fetch_row()) {
                    $id_evt_ctb_rec_02 = (int) $id_evt_ctb;
                    if ($id_evt_ctb_rec_02 == $id_evt_ctb_rec) {
                        echo "<option selected=\"selected\" value=\"" . $id_evt_ctb . "\">" . $txt_evento . "</option>";
                    } else {
                        echo "<option value=\"" . $id_evt_ctb . "\">" . $txt_evento . "</option>";
                    }
                }
                echo "</select>";
                echo "</p>";

                echo "<select name=\"sel\" id=id_obr_evt onkeydown=\"impede_enter();\">";
                echo "<option value=\"0\" ></option>";
                echo "<option value=\"1\" selected=\"true\">OBRIGATÓRIO</option>";
                echo "<option value=\"2\" >OPCIONAL</option>";
                echo "</select>";

                $mysqli->close();
                ?>
            </div>
        </div>
        <div id="botoes">
            <button class="btn" id="btn_ant" disabled="disabled" value="ocultar" onclick="vetorId('anterior')">Anterior</button>
            <button class="btn" id="btn_prx" disabled="disabled" value="ocultar" onclick="vetorId('proximo')">Próximo</button>
            <button class="btn" id="btn_slv" value="ocultar" >Salvar</button>
            <button class="btn" id="btn_sir" value="ocultar" onclick="limparCampos();ativarIndice();fecharFormulario()">Sair</button>
        </div>
        </form>
    </div>
    <div id="tabs-2">
        <div id="critica">
            <label id="ctc_ptd_dbd" class="critica"></label>
        </div>
        <div id="div_lnc">
            <div id="lbl_lnc">
                <label id="lbl">Número sequencial único (NSU) :</label>
                <label id="lbl">Valor do lançamento :</label>
            </div>
            <div id="inp_lnc">
                <?php
                    $id_lanc = $_GET['id_lanc'];   
                    require "../ferramentas/conexao_banco_dados.php";

                    $consulta = "SELECT vlr_lnc FROM tbl_lnc_fin WHERE tbl_lnc_fin.id_lanc = $id_lanc";
                    $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
                    while (list ($vlr_lnc) = $resultado->fetch_row()) {
                        $vlr_lnc = number_format($vlr_lnc, 2, ',', '.');
                        echo "<input type=\"text\" name=\"inp\" id=\"id_lanc\" value=\"$id_lanc\"></p>";
                        echo "<input type=\"text\" name=\"inp\" id=\"vlr_lnc\" value=\"$vlr_lnc\"></p>";
                    }                
                    $mysqli->close();
                ?>
            </div>
            <div id="div_load">
                <img src="../../imagens/ajax-loader (1).gif">
            </div>
        </div>
        <div id="conteudo">
            <div id="inp_cnt">
                <?php
                $id_lanc = $_GET['id_lanc'];
                require "../ferramentas/conexao_banco_dados.php";
                
                echo "<form id=\"form_partidas_dobradas\">";
                    
                for($contador = 1; $contador <= 5; $contador++){
                    
                    /*Campo Select para seleção da NATUREZA do lançamento entre débito e crédito*/
                    echo "<select class=\"chosen-select_1\" id=\"id_nat_ctb_0" . $contador . "\" onkeydown=\"impede_enter();\">";
                    echo "<option value=\"NULL\" ></option>";
                    echo "<option value=\"NULL\"></option>";
                    echo "<option value=\"D\" >DÉBITO</option>";
                    echo "<option value=\"C\" >CRÉDITO</option>";
                    echo "</select>";
                    
                    /*Campo Select para seleção da FAIXA CONTÁBIL do lançamento carregado
                     da tabela do plano de contas*/
                    echo "<select class=\"chosen-select_2\" id=\"id_cta_ctb_0" . $contador . "\" onkeydown=\"impede_enter();\">";
                    echo "<option value=\"NULL\"></option>";
                    echo "<option value=\"NULL\"></option>";
                    $query = "SELECT id_pln_cta, cod_csf, nm_csf FROM tbl_pln_cta_csf ORDER BY cod_csf";
                    $resultado = $mysqli->query($query, MYSQLI_STORE_RESULT);
                    while (list ($id_pln_cta, $cod_csf, $nm_csf) = $resultado->fetch_row()) {
                        echo "<option value=\"" . $id_pln_cta . "\">" . $cod_csf . " - " . $nm_csf . "</option>";
                    }
                    echo "</select>";
                    
                    /*Campo input para inclusão do valor do lançamento por FAIXA CONTÁBIL*/
                    echo "<input type=\"text\" name=\"inp_pdt_dbd\" id=\"vlr_lnc_ctb_0" . $contador . "\" value=\"0,00\"></p>";
                }
                echo "</form>";
                $mysqli->close();
                ?>
            </div>
        </div>
        <div id="botoes">
            <button class="btn" id="btn_slv" value="ocultar" onclick="partidasUpdate()">Salvar</button>
            <button class="btn" id="btn_sir" value="ocultar" onclick="limparCampos();ativarIndice();fecharFormulario()">Sair</button>
        </div>
        </form>
    </div>
    <div id="tabs-3">
        <div id="critica">
            <label id="ctc_comp" class="normal"></label>
        </div>
        <div id="div_lnc">
            <div id="lbl_lnc">
                <label id="lbl">Número sequencial único (NSU) :</label>
            </div>
            <div id="inp_lnc">
                <?php
                $id_lanc = $_GET['id_lanc'];
                echo "<input type=\"text\" name=\"inp\" id=\"id_lanc\" value=\"$id_lanc\"></p>";
                ?>
            </div>
            <div id="div_load">
                <img src="../../imagens/ajax-loader (1).gif">
            </div>
        </div>
        <div id="conteudo_tbl">
            <?php
            $id_lanc = $_GET['id_lanc'];
            require "../ferramentas/conexao_banco_dados.php";

            $consulta = "SELECT COUNT(id_compl_lanc) AS id_seq_cmp
                         FROM tbl_compl_lanc 
                         WHERE id_lanc = $id_lanc";
            $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
            $qtde = $resultado->fetch_array();
            $qtde_r = $qtde["id_seq_cmp"];

            if ($qtde_r > 0) {
                $consulta = "SELECT * FROM tbl_compl_lanc WHERE id_lanc = $id_lanc ORDER BY id_seq_cmp";
                $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
            }

            echo "<input type=\"text\" style=\"display: none;\" id=\"qtde_comp\" value=\"$qtde_r\">";
            echo "<table class=\"tabelaEditavel\" id=\"tab_comp\">";
            echo "<thead>";
            echo "<tr id=\"th_reg_comp\">";
            echo "<th>Id</th>";
            echo "<th>CPF/CPNJ</th>";
            echo "<th>Cliente</th>";
            echo "<th>Contrato</th>";
            echo "<th>Convênio</th>";
            echo "<th>valor</th>";
            echo "<th>Parcela</th>";
            echo "<th>Pcl</th>";
            echo "<th>Pcl</th>";
            echo "<th>Observações</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody id=\"tbody_comp\">";
            if ($qtde_r == 0) {
                echo "<tr><td colspan=\"10\">Não existem complementos cadastrados para este registro.</td></tr>";
            } else if ($qtde_r > 0) {
                while (list ($id_comp_lanc, $id_seq_cmp, $cod_cvn_comp, $cod_clt, $nro_ctr, $vlr_comp, 
                        $nro_pcl, $nro_pcl_ini, $nro_pcl_fin, $id_lanc_cmp, 
                        $cod_cpf) = $resultado->fetch_row()) {

                    if ($id_seq_cmp % 2 == 0) {
                        $id_cor = "blue";
                    } else {
                        $id_cor = "white";
                    }

                    $vlr_comp = number_format($vlr_comp, 2, ',', '.');

                    echo "<tr id=\"reg_comp\" cnt_bd=\"true\" id_seq=\"$id_seq_cmp\" style=\"cursor:default\" onMouseOver=\"javascript:this.style.backgroundColor='#ECFDA4'\" onMouseOut=\"javascript:this.style.backgroundColor=''\">";
                    echo "<td nm_cmp=\"id_seq_cmp\">$id_seq_cmp</td>";
                    echo "<td nm_cmp=\"cod_cpf\">$cod_cpf</td>";
                    echo "<td nm_cmp=\"cod_clt\">$cod_clt</td>";
                    echo "<td nm_cmp=\"nro_ctr\">$nro_ctr</td>";
                    echo "<td nm_cmp=\"cod_cvn\">$cod_cvn_comp</td>";
                    echo "<td nm_cmp=\"vlr_comp\">$vlr_comp</td>";
                    echo "<td nm_cmp=\"nro_pcl\">$nro_pcl</td>";
                    echo "<td nm_cmp=\"nro_pcl_ini\">$nro_pcl_ini</td>";
                    echo "<td nm_cmp=\"nro_pcl_fin\">$nro_pcl_fin</td>";
                    echo "<td><a class=\"lnk_exc\" href=\"#\">Excluir</a></td>";
                    echo "</tr>";
                }
            }
            echo "</tbody> ";
            echo "</table>";
            $mysqli->close();
            ?>
        </div>
        <div id="botoes">
            <button class="btn" id="btn_ins" value="ocultar">Inserir</button>
            <button class="btn" id="btn_sir" value="ocultar" onclick="limparCampos();ativarIndice();fecharFormulario()">Sair</button>
        </div>
        </form>
    </div>
    <div id="tabs-4">
        <div id="critica">
            <label id="ctc_hst" class="critica"></label>
        </div>
        <div id="div_lnc">
            <div id="lbl_lnc">
                <label id="lbl">Número sequencial único (NSU) :</label>
            </div>
            <div id="inp_lnc">
                <?php
                echo "<input type=\"text\" name=\"inp\"  id=\"id_lanc\" value=\"$id_lanc\"></p>";
                ?>
            </div>
            <div id="div_load">
                <img src="../../imagens/ajax-loader (1).gif">
            </div>
        </div>
        <div id="conteudo">
            <div id="lbl_cnt">
                <label id="lbl">Observações :</label>
            </div>
            <div id="inp_cnt">
                <?php
                $id_lanc = $_GET['id_lanc'];
                require "../ferramentas/conexao_banco_dados.php";

                echo "<form id=\"form_historico\">";
                
                $consulta = "SELECT txt_obs FROM tbl_lnc_fin WHERE tbl_lnc_fin.id_lanc = $id_lanc";
                $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
                while (list ($txt_observacoes) = $resultado->fetch_row()) {
                    echo "<textarea id=\"txt_obs\" rows=\"10\" cols=\"25\" maxlength=\"500\">$txt_observacoes</textarea>";
                }
                echo "</form>";

                $mysqli->close();
                ?>
            </div>
        </div>
        <div id="botoes">
            <button class="btn" id="btn_slv" value="ocultar" onclick="historicoUpdate()">Salvar</button>
            <button class="btn" id="btn_sir" value="ocultar" onclick="limparCampos();ativarIndice();fecharFormulario()">Sair</button>
        </div>
        </form>
    </div>
    <div id="tabs-5">
        <div id="critica">
            <label id="ctc_aut" class="critica"></label>
        </div>
        <div id="div_lnc">
            <div id="lbl_lnc">
                <label id="lbl">Número sequencial único (NSU) :</label>
            </div>
            <div id="inp_lnc">
                <?php
                $id_lanc = $_GET['id_lanc'];
                echo "<input type=\"text\" name=\"inp\" id=\"id_lanc\" value=\"$id_lanc\"></p>";
                ?>
            </div>
            <div id="div_load">
                <img src="../../imagens/ajax-loader (1).gif">
            </div>
        </div>
        <div id="conteudo">
            <div id="inp_cnt">
                <?php
                $id_lanc = $_GET['id_lanc'];
                require "../ferramentas/conexao_banco_dados.php";

                echo "<form id=\"form_autorizacao\">";
                echo "<input id=\"rd_aut\" type=\"radio\" name=\"autorizacao\" value=\"S\">Autorizado";
                echo "<input id=\"rd_n_aut\" type=\"radio\" name=\"autorizacao\" value=\"N\" checked>Não autorizado";
                echo "</form>";

                $mysqli->close();
                ?>
            </div>
        </div>
        <div id="botoes">
            <button class="btn" id="btn_slv" value="ocultar" onclick="autorizacaoUpdate()">Salvar</button>
            <button class="btn" id="btn_sir" value="ocultar" onclick="limparCampos();ativarIndice();fecharFormulario()">Sair</button>
        </div>
        </form>
    </div>
</div>