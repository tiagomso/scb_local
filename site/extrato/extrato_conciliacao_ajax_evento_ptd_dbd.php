<?php

// Conex�o com o banco de dados
require "../ferramentas/conexao_banco_dados_02.php";

// Recupera o valor da variavel id_lanc
$id_lanc = isset($_POST["id_lanc"]) ? addslashes(trim($_POST["id_lanc"])) : FALSE;

$sql = "DELETE FROM `tbl_evt_ptd_dbr` WHERE `id_lanc` = $id_lanc";
$result_SEL = @mysql_query($sql) or die("Erro no banco de dados!");

$sql = "SELECT `id_evt_ctb` FROM `tbl_lnc_fin` WHERE `id_lanc` = $id_lanc ";
$result_SEL = @mysql_query($sql) or die("Erro no banco de dados!");
$total = @mysql_num_rows($result_SEL);

if ($total) {
    $dados = @mysql_fetch_array($result_SEL);
    $id_evt_ctb = $dados['id_evt_ctb'];
}

if (isset($_POST["nat_cta_lnc_01"])) {   
    $nat_cta_lnc = addslashes(trim($_POST["nat_cta_lnc_01"]));
    $id_cta_ctb = addslashes(trim($_POST["id_cta_ctb_01"]));
    $vlr_lnc_ctb = addslashes(trim($_POST["vlr_lnc_ctb_01"]));
    $vlr_lnc_ctb = str_replace(",", ".", $vlr_lnc_ctb);
    
    $sql = "INSERT INTO `bd_scb`.`tbl_evt_ptd_dbr` (`id_evt_ptd_dbr`, `id_lanc`, "
            . "`nat_cta_lnc`, `id_evt_ctb`, `id_pln_cta`, `nro_itm`, `vlr_lnc_ptd_dbd`)"
            . " VALUES (NULL, $id_lanc, '$nat_cta_lnc', $id_evt_ctb, $id_cta_ctb , 000, '$vlr_lnc_ctb');";
  
    $result_UPDT = @mysql_query($sql) or die("Erro no banco de dados!");
}

if (isset($_POST["nat_cta_lnc_02"])) {
    $nat_cta_lnc = addslashes(trim($_POST["nat_cta_lnc_02"]));
    $id_cta_ctb = addslashes(trim($_POST["id_cta_ctb_02"]));
    $vlr_lnc_ctb = addslashes(trim($_POST["vlr_lnc_ctb_02"]));
    $vlr_lnc_ctb = str_replace(",", ".", $vlr_lnc_ctb);

    $sql = "INSERT INTO `bd_scb`.`tbl_evt_ptd_dbr` (`id_evt_ptd_dbr`, `id_lanc`, "
            . "`nat_cta_lnc`, `id_evt_ctb`, `id_pln_cta`, `nro_itm`, `vlr_lnc_ptd_dbd`)"
            . " VALUES (NULL, $id_lanc, '$nat_cta_lnc', $id_evt_ctb, $id_cta_ctb , 000, '$vlr_lnc_ctb');";

    $result_UPDT = @mysql_query($sql) or die("Erro no banco de dados!");
}

if (isset($_POST["nat_cta_lnc_03"])) {
    $nat_cta_lnc = addslashes(trim($_POST["nat_cta_lnc_03"]));
    $id_cta_ctb = addslashes(trim($_POST["id_cta_ctb_03"]));
    $vlr_lnc_ctb = addslashes(trim($_POST["vlr_lnc_ctb_03"]));
    $vlr_lnc_ctb = str_replace(",", ".", $vlr_lnc_ctb);

    $sql = "INSERT INTO `bd_scb`.`tbl_evt_ptd_dbr` (`id_evt_ptd_dbr`, `id_lanc`, "
            . "`nat_cta_lnc`, `id_evt_ctb`, `id_pln_cta`, `nro_itm`, `vlr_lnc_ptd_dbd`)"
            . " VALUES (NULL, $id_lanc, '$nat_cta_lnc', $id_evt_ctb, $id_cta_ctb , 000, '$vlr_lnc_ctb');";

    $result_UPDT = @mysql_query($sql) or die("Erro no banco de dados!");
}

if (isset($_POST["nat_cta_lnc_04"])) {
    $nat_cta_lnc = addslashes(trim($_POST["nat_cta_lnc_04"]));
    $id_cta_ctb = addslashes(trim($_POST["id_cta_ctb_04"]));
    $vlr_lnc_ctb = addslashes(trim($_POST["vlr_lnc_ctb_04"]));
    $vlr_lnc_ctb = str_replace(",", ".", $vlr_lnc_ctb);

    $sql = "INSERT INTO `bd_scb`.`tbl_evt_ptd_dbr` (`id_evt_ptd_dbr`, `id_lanc`, "
            . "`nat_cta_lnc`, `id_evt_ctb`, `id_pln_cta`, `nro_itm`, `vlr_lnc_ptd_dbd`)"
            . " VALUES (NULL, $id_lanc, '$nat_cta_lnc', $id_evt_ctb, $id_cta_ctb , 000, '$vlr_lnc_ctb');";

    $result_UPDT = @mysql_query($sql) or die("Erro no banco de dados!");
}

if (isset($_POST["nat_cta_lnc_05"])) {
    $nat_cta_lnc = addslashes(trim($_POST["nat_cta_lnc_05"]));
    $id_cta_ctb = addslashes(trim($_POST["id_cta_ctb_05"]));
    $vlr_lnc_ctb = addslashes(trim($_POST["vlr_lnc_ctb_05"]));
    $vlr_lnc_ctb = str_replace(",", ".", $vlr_lnc_ctb);

    $sql = "INSERT INTO `bd_scb`.`tbl_evt_ptd_dbr` (`id_evt_ptd_dbr`, `id_lanc`, "
            . "`nat_cta_lnc`, `id_evt_ctb`, `id_pln_cta`, `nro_itm`, `vlr_lnc_ptd_dbd`)"
            . " VALUES (NULL, $id_lanc, '$nat_cta_lnc', $id_evt_ctb, $id_cta_ctb , 000, '$vlr_lnc_ctb');";

    $result_UPDT = @mysql_query($sql) or die("Erro no banco de dados!");
}
/**
 * Executa a consulta no banco de dados.
 * Caso o n�mero de linhas retornadas seja 1 o login � v�lido,
 * caso 0, inv�lido.
 */
if ($result_UPDT) {
    echo $result_UPDT;
    exit;
}
?>