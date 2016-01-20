/* 
 * To change th
 }is template, choose Tools | Templates
 * and open the template in the editor.
 */

function manutencaoDBO() {
    //novas variaveis
    var id_tab = $('#extrato').attr('nome');
    var id_ctr = $("input[type=radio]:checked").attr('value');
    var id_tr = 'tr#' + id_ctr;

    var dadosajax = {
        'id_ctr': id_ctr,
        'id_tab': id_tab
    };

    alert(id_ctr + " - " + id_tab);

    $.ajax({
        url: 'cadastro_objeto_banco_dados.php',
        data: dadosajax,
        type: 'POST',
        cache: false,
        error: function () {
            alert('Erro');
        },
        success: function (result) {
            resultado = parseInt($.trim(result));
            //se foi inserido com sucesso
            if (resultado == '1') {
                //removendo linha da tabela
                $(id_tr).fadeOut(400, function () {
                    $(id_tr).remove();
                });
            } else if (resultado == '0') {
                alert("erro com o banco de dados");
            }
        }
    });
}

function inserirManutencao() {
    //dados a enviar, vai buscar os valores dos campos que queremos enviar para a BD
    var dadosajax = {
        'id_lanc': id_lanc,
        'id_seq_cmp': id_seq,
        'camp_alt': camp_alt,
        'txt_cont': novoConteudo,
        'id_ope': id_ope
    };

    $.ajax({
        url: 'complemento_gravar.php',
        data: dadosajax,
        type: 'POST',
        cache: false,
        error: function () {
            alert('Erro');
        },
        success: function (result) {
            resultado = parseInt($.trim(result));
            //se foi inserido com sucesso
            if ($.trim(result) == '0') {
                document.getElementById("ctc_comp").innerHTML = "Campo '" + camp_alt + "' do registro '" + id_lanc + "' não atualizado!"
            }
        }
    });
}

function voltarClasseNormal() {
    //$("label#ctc_comp").fadeOut(8000, function(){
    $("label#ctc_comp").prop('class', 'normal');
    //});
    //$("label#ctc_comp").fadeIn(8000, function(){
    $("label#ctc_comp").prop('class', 'normal');
    //});
}

function removerLinhas() {
    $("#tbody_comp tr").each(function () {
        $(this).remove();
    });
    $("input#qtde_comp").val(0);
}

function complemento() {
    //dados a enviar, vai buscar os valores dos campos que queremos enviar para a BD
    var id_lanc = $("input#id_lanc").val();
    var cnt_bd = "";
    var id_seq = "";
    var camp_alt = "";
    var novoConteudo = "";
    var id_ope = "SELECT";

    var dadosajax = {
        'id_lanc': id_lanc,
        'id_seq_cmp': id_seq,
        'camp_alt': camp_alt,
        'txt_cont': novoConteudo,
        'id_ope': id_ope
    };

    $.ajax({
        url: '../../site/extrato/complemento_gravar.php',
        data: dadosajax,
        type: 'POST',
        cache: false,
        error: function () {
            alert('Erro');
        },
        success: function (result) {
            //se foi inserido com sucesso
            if ($.trim(result) != '99') {
                var myJSONObject = eval('(' + result + ')');
                var i = 0;
                var j = myJSONObject.length;
                var k = j;
                j = parseInt(j) - 1;

                while (i <= j) {


                    $('#tab_comp').append(" _\n\
                    <tr id=\"reg_comp\" cnt_bd=\"true\" id_seq=\"" + myJSONObject[i].id_compl_lanc + "\" style=\"cursor:default\" onMouseOver=\"javascript:this.style.backgroundColor='#ECFDA4'\" onMouseOut=\"javascript:this.style.backgroundColor=''\">\n\
                        <td nm_cmp=\"id_seq_cmp\">" + myJSONObject[i].id_compl_lanc + "</td>\n\
                        <td nm_cmp=\"cod_cpf\">" + myJSONObject[i].cod_cpf + "</td>\n\
                        <td nm_cmp=\"cod_clt\">" + myJSONObject[i].cod_clt + "</td>\n\
                        <td nm_cmp=\"nro_ctr\">" + myJSONObject[i].nro_ctr + "</td>\n\
                        <td nm_cmp=\"cod_cvn\">" + myJSONObject[i].cod_cvn + "</td>\n\
                        <td nm_cmp=\"vlr_lnc\">" + myJSONObject[i].vlr_lnc + "</td>\n\
                        <td nm_cmp=\"nro_pcl\">" + myJSONObject[i].nro_pcl + "</td>\n\
                        <td nm_cmp=\"nro_pcl_ini\">" + myJSONObject[i].nro_pcl_ini + "</td>\n\
                        <td nm_cmp=\"nro_pcl_fin\">" + myJSONObject[i].nro_pcl_fin + "</td>\n\
                        <td><a class=\"lnk_exc\" href=\"#\">Excluir</a></td>\n\
                    </tr>");

                    $("td[nm_cmp=vlr_lnc]").priceFormat({
                        prefix: '',
                        centsSeparator: ',',
                        thousandsSeparator: '.'
                    });

                    i++;
                }
                if (k == 0) {
                    $('#tab_comp').append("<tr><td colspan=\"10\">Não existem complementos cadastrados para este registro.</td></tr>");
                }
                $("input#qtde_comp").val(k);
            } else {
                document.getElementById("ctc_comp").innerHTML = "Complemento não carregado!"
            }
        }
    });
}

function autorizacaoSelect(id_aut) {
    var id_aut_r = id_aut;
    if (id_aut_r == 'S') {
        $("input#rd_aut").prop('checked', true);
        $("input#rd_n_aut").removeAttr('checked');
    } else if (id_aut_r == 'N') {
        $("input#rd_n_aut").prop('checked', true);
        $("input#rd_aut").removeAttr('checked');
    }
}

function autorizacaoUpdate() {
    var id_aut = 'N';
    if ($("input#rd_aut").is(":checked")) {
        id_aut = 'S';
    }

    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (id_aut == 'S') {
                document.getElementById("tbl_cln_12_" + id_lanc).innerHTML = '<a class="lnk_frm" href="extrato_conciliacao_form_comp.php?id_lanc=' + id_lanc + '" rel="modalComplemento">' + "CONFERIDO";
                document.getElementById("tbl_cln_11_" + id_lanc).innerHTML = '<a style="display: block" class="lnk_frm" href="extrato_conciliacao_form_comp.php?id_lanc=' + id_lanc + '" rel="modalComplemento">' + "S";
            } else {
                document.getElementById("tbl_cln_12_" + id_lanc).innerHTML = '<a class="lnk_frm" href="extrato_conciliacao_form_comp.php?id_lanc=' + id_lanc + '" rel="modalComplemento">' + "PENDENTE";
                document.getElementById("tbl_cln_11_" + id_lanc).innerHTML = '<a style="display: block" class="lnk_frm" href="extrato_conciliacao_form_comp.php?id_lanc=' + id_lanc + '" rel="modalComplemento">' + "N";
            }
            document.getElementById("ctc_aut").innerHTML = "Autorizaçao do registro realizada com sucesso!"
        }
    }

    var id_lanc = document.getElementById("id_lanc").value;
    var campos = "id_lanc=" + id_lanc + "&id_aut=" + id_aut;

    xmlhttp.open("POST", "../../site/extrato/extrato_conciliacao_ajax_evento_aut.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	// Setando Content-type
    xmlhttp.setRequestHeader("Content-length", campos.length); // Comprimento do conteúdo=comprimento dos dados a enviar
    xmlhttp.send(campos);
}

function historicoUpdate() {
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("ctc_hst").innerHTML = "Histórico do registro atualizado com sucesso!"
        }
    }

    var id_lanc = document.getElementById("id_lanc").value;
    var txt_obs = document.getElementById("txt_obs").value;
    var campos = "id_lanc=" + id_lanc + "&txt_obs=" + txt_obs;

    xmlhttp.open("POST", "../../site/extrato/extrato_conciliacao_ajax_evento_hst.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	// Setando Content-type
    xmlhttp.setRequestHeader("Content-length", campos.length); // Comprimento do conteúdo=comprimento dos dados a enviar
    xmlhttp.send(campos);
}

function partidasUpdate() {
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("ctc_ptd_dbd").innerHTML = "Partidas Dobradas do registro atualizadas com sucesso!"
        }
    }

    var id_lanc = document.getElementById("id_lanc").value;

    var id_nat_ctb_01 = document.getElementById("id_nat_ctb_01").value;
    var id_cta_ctb_01 = document.getElementById("id_cta_ctb_01").value;
    var vlr_lnc_ctb_01 = document.getElementById("vlr_lnc_ctb_01").value;
    var id_ctrl_lnc_01 = "";
    if(id_nat_ctb_01 !== "NULL" && id_cta_ctb_01 !== "NULL" && vlr_lnc_ctb_01 !== 0){
        id_ctrl_lnc_01 = "&nat_cta_lnc_01=" + id_nat_ctb_01 + "&id_cta_ctb_01=" + id_cta_ctb_01 + "&vlr_lnc_ctb_01=" + vlr_lnc_ctb_01;
    }

    var id_nat_ctb_02 = document.getElementById("id_nat_ctb_02").value;
    var id_cta_ctb_02 = document.getElementById("id_cta_ctb_02").value;
    var vlr_lnc_ctb_02 = document.getElementById("vlr_lnc_ctb_02").value;
    var id_ctrl_lnc_02 = "";                
    if(id_nat_ctb_02 !== "NULL" && id_cta_ctb_02 !== "NULL" && vlr_lnc_ctb_02 !== 0){
        id_ctrl_lnc_02 = "&nat_cta_lnc_02=" + id_nat_ctb_02 + "&id_cta_ctb_02=" + id_cta_ctb_02 + "&vlr_lnc_ctb_02=" + vlr_lnc_ctb_02;
    }

    var id_nat_ctb_03 = document.getElementById("id_nat_ctb_03").value;
    var id_cta_ctb_03 = document.getElementById("id_cta_ctb_03").value;
    var vlr_lnc_ctb_03 = document.getElementById("vlr_lnc_ctb_03").value;
    var id_ctrl_lnc_03 = "";
    if(id_nat_ctb_03 !== "NULL" && id_cta_ctb_03 !== "NULL" && vlr_lnc_ctb_03 !== 0){
        id_ctrl_lnc_03 = "&nat_cta_lnc_03=" + id_nat_ctb_03 + "&id_cta_ctb_03=" + id_cta_ctb_03 + "&vlr_lnc_ctb_03=" + vlr_lnc_ctb_03;
    }

    var id_nat_ctb_04 = document.getElementById("id_nat_ctb_04").value;
    var id_cta_ctb_04 = document.getElementById("id_cta_ctb_04").value;
    var vlr_lnc_ctb_04 = document.getElementById("vlr_lnc_ctb_04").value;
    var id_ctrl_lnc_04 = "";
    if(id_nat_ctb_04 !== "NULL" && id_cta_ctb_04 !== "NULL" && vlr_lnc_ctb_04 !== 0){
        id_ctrl_lnc_04 = "&nat_cta_lnc_04=" + id_nat_ctb_04 + "&id_cta_ctb_04=" + id_cta_ctb_04 + "&vlr_lnc_ctb_04=" + vlr_lnc_ctb_04;
    }

    var id_nat_ctb_05 = document.getElementById("id_nat_ctb_05").value;
    var id_cta_ctb_05 = document.getElementById("id_cta_ctb_05").value;
    var vlr_lnc_ctb_05 = document.getElementById("vlr_lnc_ctb_05").value;
    var id_ctrl_lnc_05 = "";
    if(id_nat_ctb_05 !== "NULL" && id_cta_ctb_05 !== "NULL" && vlr_lnc_ctb_05 !== 0){
        id_ctrl_lnc_05 = "&nat_cta_lnc_05=" + id_nat_ctb_05 + "&id_cta_ctb_05=" + id_cta_ctb_05 + "&vlr_lnc_ctb_05=" + vlr_lnc_ctb_05;
    }

    var campos = "id_lanc=" + id_lanc + id_ctrl_lnc_01 + id_ctrl_lnc_02 + id_ctrl_lnc_03 + id_ctrl_lnc_04 + id_ctrl_lnc_05;
    
    xmlhttp.open("POST", "../../site/extrato/extrato_conciliacao_ajax_evento_ptd_dbd.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	// Setando Content-type
    xmlhttp.setRequestHeader("Content-length", campos.length); // Comprimento do conteúdo=comprimento dos dados a enviar
    xmlhttp.send(campos);
}

function vetorId(sentido) {
    var registros = $("#registros").val();
    var vetor = new Array();
    var string = registros;
    vetor = string.split(";");

    var tmh = vetor.length;
    var tamanho = parseInt(tmh) - 1
    var sqUnico = $("input#id_lanc").val();
    var indice = vetor.indexOf(sqUnico);
    var direcao = sentido;

    if (direcao == "proximo") {
        if (indice == tamanho) {
            document.getElementById("ctc").innerHTML = "Limite máximo da página alcançado. Avance a página ou altere os parâmetros do filtro";
        } else if (indice < tamanho) {
            for (var i in vetor) {
                if (vetor[i] == sqUnico) {
                    var j = parseInt(i) + 1;
                    moverReg("proximo", vetor[j]);
                }
            }
        }
    } else if (direcao == "anterior") {
        if (indice == 0) {
            document.getElementById("ctc").innerHTML = "Limite mínimo da página alcançado. Volte a página ou altere os parâmetros do filtro";
        } else if (indice <= tamanho) {
            for (var a in vetor) {
                if (vetor[a] == sqUnico) {
                    var b = parseInt(a) - 1;
                    moverReg("anterior", vetor[b]);
                }
            }
        }
    }
}
function salvarEvento() {
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("tbl_cln_10_" + id_lanc).innerHTML = '<a style=\"display: block\" class="lnk_frm" href="extrato_conciliacao_form_comp.php?id_lanc=' + id_lanc + '" rel="modalComplemento">' + xmlhttp.responseText;
            document.getElementById("ctc").innerHTML = "Registro atualizado com sucesso!"
            //window.location = 'extrato_conciliacao.php#tbl_lnh_' + id_lanc;
        }
    }

    var id_lanc = document.getElementById("id_lanc").value;
    var id_evt_ctb = document.getElementById("id_evt_ctb").value;
    var campos = "id_lanc=" + id_lanc + "&id_evt_ctb=" + id_evt_ctb;

    xmlhttp.open("POST", "../../site/extrato/extrato_conciliacao_ajax_evento.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	// Setando Content-type
    xmlhttp.setRequestHeader("Content-length", campos.length); // Comprimento do conteúdo=comprimento dos dados a enviar
    xmlhttp.send(campos);
}

function fecharFormulario() {
    $("#mascara").hide();
    $(".windowComplemento").hide();
    var href = $(this).attr('href');
    $("#Conteudo").load(href + " #Conteudo");
}

function limparCampos() {
    $("input#id_lanc").val("");
    $("input#id_lanc").val("");
    $("input#id_seq_dt").val("");
    $("input#id_cta").val("");
    $("input#dt_vlz").val("");
    $("input#nro_doc").val("");
    $("input#txt_hst").val("");
    $("input#vlr_lnc").val("");
    $("input#nat_fin_lnc").val("");
    $("input#id_evt_ctb").val("");
    $("input#id_obr_evt").val("");
    $("select#id_evt_ctb").find("option[value=\"0\"]").attr("selected", true);
    $("select#id_obr_evt").find("option[value=\"0\"]").attr("selected", true);
}

function ativarIndice() {
    $("li#tab_01").addClass("ui-state-default ui-corner-top ui-tabs-active ui-state-active");
    $("li#tab_01").attr({
        'tabindex': "0"
    });
    $("li#tab_01").attr({
        'aria-selected': "true"
    });
    $("div#tabs-1").attr({
        'aria-expanded': "true"
    });
    $("div#tabs-1").attr({
        'aria-hidden': "false"
    });
    $("div#tabs-1").attr({
        'style': "display: block;"
    });

    $("li#tab_02").attr({
        'class': "ui-state-default ui-corner-top"
    });
    $("li#tab_02").attr({
        'tabindex': "-1"
    });
    $("li#tab_02").attr({
        'aria-selected': "false"
    });
    $("div#tabs-2").attr({
        'aria-expanded': "false"
    });
    $("div#tabs-2").attr({
        'aria-hidden': "true"
    });
    $("div#tabs-2").attr({
        'style': "display: none;"
    });

    $("li#tab_03").attr({
        'class': "ui-state-default ui-corner-top"
    });
    $("li#tab_03").attr({
        'tabindex': "-1"
    });
    $("li#tab_03").attr({
        'aria-selected': "false"
    });
    $("div#tabs-3").attr({
        'aria-expanded': "false"
    });
    $("div#tabs-3").attr({
        'aria-hidden': "true"
    });
    $("div#tabs-3").attr({
        'style': "display: none;"
    });

    $("li#tab_04").attr({
        'class': "ui-state-default ui-corner-top"
    });
    $("li#tab_04").attr({
        'tabindex': "-1"
    });
    $("li#tab_04").attr({
        'aria-selected': "false"
    });
    $("div#tabs-4").attr({
        'aria-expanded': "false"
    });
    $("div#tabs-4").attr({
        'aria-hidden': "true"
    });
    $("div#tabs-4").attr({
        'style': "display: none;"
    });
    
    $("li#tab_05").attr({
        'class': "ui-state-default ui-corner-top"
    });
    $("li#tab_05").attr({
        'tabindex': "-1"
    });
    $("li#tab_05").attr({
        'aria-selected': "false"
    });
    $("div#tabs-5").attr({
        'aria-expanded': "false"
    });
    $("div#tabs-5").attr({
        'aria-hidden': "true"
    });
    $("div#tabs-5").attr({
        'style': "display: none;"
    });
}

function reload() {
    var href = $(this).attr('href');
    $("#Conteudo").load(href + " #Conteudo");
}

function moverReg(sentido, registro) {
    var direcao = sentido;
    var registro_r = registro;
    var direcao_txt = "";

    if (direcao == "proximo") {
        direcao_txt = "Registro " + registro_r + "  carregado!";
    } else {
        direcao_txt = "Registro " + registro_r + "  carregado!";
    }

    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.responseText = "";

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("ctc").innerHTML = direcao_txt;
            var myJSONObject = eval('(' + xmlhttp.responseText + ')');
            $("input#id_lanc").val(myJSONObject["0"]);
            $("input#id_seq_dt").val(myJSONObject["1"]);
            $("input#id_cta").val(myJSONObject["10"]);
            $("input#dt_vlz").val(myJSONObject["2"]);
            $("input#nro_doc").val(myJSONObject["3"]);
            $("input#txt_hst").val(myJSONObject["4"]);
            $("input#vlr_lnc").val(myJSONObject["5"]);
            $("input#vlr_lnc").priceFormat({
                prefix: '',
                centsSeparator: ',',
                thousandsSeparator: '.'
            });
            $("input#nat_fin_lnc").val(myJSONObject["6"]);
            
            //script que varre todos os valores do select e retira a variavel selectd
            
            for (var opn = 0; opn <= 20; opn++){
                $("#id_evt_ctb").find("option[value=\"" + opn + "\"]").removeAttr("selected");
            }
                
            
            $("#id_evt_ctb").find("option[value=\"" + myJSONObject["9"] + "\"]").attr("selected", true);
            //var comboLancamentos = document.getElementById("id_evt_ctb");
            //comboLancamentos.selectedIndex = myJSONObject["9"];
            
            //$("#id_evt_ctb").selectedIndex = myJSONObject["9"];
            
            $("#id_obr_evt").find("option[value=\"" + myJSONObject["7"] + "\"]").attr("selected", true);
            var id_aut = myJSONObject["7"];

            //Carregar as informações do formulario de complemento e autorização
            removerLinhas();
            complemento();
            autorizacaoSelect(id_aut);
        }
    }

    var id_lanc = document.getElementById("id_lanc").value;
    var id_evt_ctb = document.getElementById("id_evt_ctb").value;

    var campos = "id_lanc=" + registro_r + "&id_evt_ctb=" + id_evt_ctb + "&direcao=" + direcao;

    xmlhttp.open("POST", "../../site/extrato/extrato_conciliacao_ajax_evento_set.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	// Setando Content-type
    xmlhttp.setRequestHeader("Content-length", campos.length); // Comprimento do conteúdo=comprimento dos dados a enviar
    xmlhttp.send(campos);

}
function Direita(str, n) {
    if (n <= 0)
        return "";
    else if (n > String(str).length)
        return str;
    else {
        var iLen = String(str).length;
        return String(str).substring(iLen, iLen - n);
    }
}