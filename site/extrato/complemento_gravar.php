<?php

//Conexão à base de dados
require "../ferramentas/conexao_banco_dados.php";

//recebe os parâmetros
$id_lanc = $_REQUEST['id_lanc'];
$id_seq = $_REQUEST['id_seq'];
$campo_alt = $_REQUEST['camp_alt'];
$txt_cont = $_REQUEST['txt_cont'];
$operacao = $_REQUEST['id_ope']; // SELECT / UPDATE / INSERT / DELETE

if ($operacao == "SELECT") {
    try {
        $consulta = "SELECT * FROM tbl_compl_lanc WHERE id_lanc = $id_lanc ORDER BY id_compl_lanc";
        $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
        $dados = "";

        while (list ($id_comp_lanc, $id_seq, $cod_cvn_comp, $cod_clt, $nro_ctr, $vlr_comp, 
                        $nro_pcl, $nro_pcl_ini, $nro_pcl_fin, $id_lanc_cmp, 
                        $cod_cpf) = $resultado->fetch_row()) {
            $dados[] = array(
                'id_comp_lanc' => $id_comp_lanc,
                'id_seq_cmp' => $id_seq,
                'cod_cpf' => $cod_cpf,
                'cod_clt' => $cod_clt,
                'cod_cvn' => $cod_cvn_comp,
                'nro_ctr' => $nro_ctr,
                'vlr_lnc' => $vlr_comp,
                'nro_pcl' => $nro_pcl,
                'nro_pcl_ini' => $nro_pcl_ini,
                'nro_pcl_fin' => $nro_pcl_fin,
                'id_lanc' => $id_lanc_cmp
            );
        }

        //retorna a matriz json no sucesso do ajax saber que foi com inserido sucesso
        $return = json_encode($dados);
        echo $return;
    } catch (Exception $ex) {
        //retorna 0 para no sucesso do ajax saber que foi um erro
        echo "99";
    }
} else if ($operacao == "UPDATE") {
    try {
        //atualiza o BD com as novas informações do registro
        $consulta = "UPDATE `bd_scb`.`tbl_compl_lanc` SET `" . trim($campo_alt) . "` = '" . trim($txt_cont) . "' 
        WHERE `tbl_compl_lanc`.`id_seq_cmp` = " . trim($id_seq) . " "
                . "AND `tbl_compl_lanc`.`id_lanc` = " . trim($id_lanc) . ";";
        $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);

        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        echo "1";
    } catch (Exception $ex) {
        //retorna 0 para no sucesso do ajax saber que foi um erro
        echo "0";
    }
} else if ($operacao == "INSERT") {
    try {
        //insere no BD o novo registro
        $consulta = "INSERT INTO `tbl_compl_lanc`(`id_seq_cmp`,`" . trim($campo_alt) . "`,`id_lanc`) "
                . "VALUES (" . trim($id_seq) . ", " . trim($txt_cont) . ", " . trim($id_lanc) . ")";
        //echo "<script language='javascript'>alert($consulta);</script>";
        $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);

        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        echo "2";
    } catch (Exception $ex) {
        //retorna 0 para no sucesso do ajax saber que foi um erro
        echo "3";
    }
} else if ($operacao == "DELETE") {
    try {
        $consulta = "DELETE FROM `tbl_compl_lanc` WHERE `id_seq_cmp`=" . trim($id_seq) . " AND `id_lanc`=" . trim($id_lanc) . "";
        $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        echo "4";
    } catch (Exception $ex) {
        //retorna 0 para no sucesso do ajax saber que foi um erro
        echo "5";
    }
}
?>
