<?php

// Conex�o com o banco de dados
require "../ferramentas/conexao_banco_dados_02.php";

// Recupera o login
$id_lanc = isset($_POST["id_lanc"]) ? addslashes(trim($_POST["id_lanc"])) : FALSE;

/**
 * Executa a consulta no banco de dados.
 * Caso o n�mero de linhas retornadas seja 1 o login � v�lido,
 * caso 0, inv�lido.
 */

//referencia JSON
//0 - tbl_lnc_fin.id_lanc, 
//1 - tbl_lnc_fin.id_seq_dt, 
//2 - tbl_lnc_fin.dt_vlz,                
//3 - tbl_lnc_fin.nro_doc, 
//4 - tbl_lnc_fin.txt_hst, 
//5 - tbl_lnc_fin.vlr_lnc, 
//6 - tbl_lnc_fin.nat_fin_lnc, 
//7 - tbl_lnc_fin.nat_ctb_lnc, 
//8 - tbl_lnc_fin.id_cnc, 
//9 - tbl_lnc_fin.id_evt_ctb,
//10 - tbl_lnc_fin.id_cta

$SQL = "SELECT tbl_lnc_fin.id_lanc, tbl_lnc_fin.id_seq_dt, tbl_lnc_fin.dt_vlz,
                tbl_lnc_fin.nro_doc, tbl_lnc_fin.txt_hst, tbl_lnc_fin.vlr_lnc, 
                tbl_lnc_fin.nat_fin_lnc, tbl_lnc_fin.nat_ctb_lnc, tbl_lnc_fin.id_cnc, 
                tbl_lnc_fin.id_evt_ctb,
                (SELECT tbl_cta.nro_cta FROM tbl_cta WHERE tbl_cta.id_cta = tbl_lnc_fin.id_cta)
                FROM tbl_lnc_fin WHERE tbl_lnc_fin.id_lanc = $id_lanc";

$result_SEL = @mysql_query($SQL) or die("Erro no banco de dados!");
$total = @mysql_num_rows($result_SEL);

if ($total) {
    $dados = @mysql_fetch_array($result_SEL);

    $dt_vlz = $dados["dt_vlz"];
    $dt_vlz = date("d/m/Y", strtotime($dt_vlz));

    $dados["dt_vlz"] = $dt_vlz;
    $dados[2] = $dt_vlz;

    $return = json_encode($dados);
    echo $return;
    exit;
}
?>