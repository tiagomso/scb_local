<?php

$dt_eft_req = $_GET['dt_eft_req'];

require "../ferramentas/conexao_banco_dados.php";
$consulta = "SELECT tbl_lnc_fin.id_lanc, tbl_lnc_fin.id_seq_dt, tbl_lnc_fin.dt_eft, tbl_lnc_fin.dt_vlz,
                    tbl_lnc_fin.nro_doc, tbl_lnc_fin.txt_hst, tbl_lnc_fin.vlr_lnc, 
                    tbl_lnc_fin.nat_fin_lnc,tbl_lnc_fin.nat_ctb_lnc, tbl_lnc_fin.id_cnc, 
                    (SELECT tbl_evt_ctb.nm_evt_ctb FROM tbl_evt_ctb WHERE tbl_lnc_fin.id_evt_ctb = tbl_evt_ctb.id_evt_ctb), 
                    (SELECT tbl_cta.nro_cta FROM tbl_cta WHERE tbl_cta.id_cta = tbl_lnc_fin.id_cta)
                    FROM tbl_lnc_fin
                    WHERE tbl_lnc_fin.dt_eft like '$dt_eft_req'";
$resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
while (list ($id_lanc, $id_seq_dt, $dt_eft, $dt_vlz, $nro_doc, $txt_hst, $vlr_lnc, $nat_fin_lnc, $nat_ctb_lnc, $id_cnc, $id_evt_ctb, $id_cta) = $resultado->fetch_row()) {


    $vlr_lnc = number_format($vlr_lnc, 2, ',', '.');
    $dt_vlz = date("d/m/Y", strtotime($dt_vlz));
    if ($id_cnc=='S'){
        $id_chk = 'CONFERIDO';
    }else{
        $id_chk = 'PENDENTE';
    }

    $link = "<a style=\"display: block\" class=\"lnk_frm\" href=\"extrato_conciliacao_form_comp.php?id_lanc=$id_lanc\" rel=\"modalComplemento\">";
    $link_ficha = "<a style=\"display: block\" class=\"lnk_frm\" href=\"../relatorios/relatorio_gerador.php?id_lanc=$id_lanc\" target=\"_blanck\">";
    $id_ficha = "GERAR";

    echo "<tr id=\"tbl_lnh_$id_lanc\" vlr=\"$id_lanc\" style=\"cursor:hand\" onMouseOver=\"javascript:this.style.backgroundColor='#ECFDA4'\" onMouseOut=\"javascript:this.style.backgroundColor=''\">";
    echo "<td id=\"tbl_cln_01_$id_lanc\"><input type=\"radio\" id=\"radio_$id_lanc\" onClick=\"radio('radio_$id_lanc')\" name=\"excluir[]\" value=\"$id_lanc\"></td>";
    echo "<td id=\"tbl_cln_02_$id_lanc\">$id_lanc</td>";
    echo "<td id=\"tbl_cln_03_$id_lanc\">$link$id_seq_dt</a></td>";
    echo "<td id=\"tbl_cln_04_$id_lanc\">$link$id_cta</a></td>";
    echo "<td id=\"tbl_cln_05_$id_lanc\">$link$dt_vlz</a></td>";
    echo "<td id=\"tbl_cln_06_$id_lanc\">$link$nro_doc</a></td>";
    echo "<td id=\"tbl_cln_07_$id_lanc\">$link$txt_hst</a></td>";
    echo "<td id=\"tbl_cln_08_$id_lanc\" align=right>$link$vlr_lnc</a></td>";
    echo "<td id=\"tbl_cln_09_$id_lanc\">$link$nat_fin_lnc</a></td>";
    echo "<td id=\"tbl_cln_10_$id_lanc\">$link$id_evt_ctb</a></td>";
    echo "<td id=\"tbl_cln_11_$id_lanc\">$link$id_cnc</a></td>";
    echo "<td id=\"tbl_cln_12_$id_lanc\">$link$id_chk</a></td>";
    echo "<td id=\"tbl_cln_13_$id_lanc\">$link_ficha$id_ficha</a></td>";
    echo "</tr>";
}
//fecha a conexão com o banco de dados
$mysqli->close();
?>
