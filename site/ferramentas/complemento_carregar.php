<?php

// Conex�o com o banco de dados
require "conexao_banco_dados.php";

$id_lanc = $_REQUEST['id_lanc'];

try {
    //consulta na BD
    $SQL = "SELECT * FROM tbl_compl_lanc WHERE id_lanc = $id_lanc ORDER BY id_seq_cmp";

    $resultado = $mysqli->query($SQL, MYSQLI_STORE_RESULT);
    $dados = "";

    while (list ($id_comp_lanc, $id_seq_cmp, $cod_cpf, $cod_clt, $cod_cvn, $nro_ctr, $vlr_lnc, $nro_pcl, $nro_pcl_ini, $nro_pcl_fin, $id_lanc) = $resultado->fetch_row()) {
        $dados[] = array(
            'id_comp_lanc' => $id_comp_lanc,
            'id_seq_cmp' => $id_seq_cmp,
            'cod_cpf' => $cod_cpf,
            'cod_clt' => $cod_clt,
            'cod_cvn' => $cod_cvn,
            'nro_ctr' => $nro_ctr,
            'vlr_lnc' => $vlr_lnc,
            'nro_pcl' => $nro_pcl,
            'nro_pcl_ini' => $nro_pcl_ini,
            'nro_pcl_fin' => $nro_pcl_fin,
            'id_lanc' => $id_lanc
        );
    }

    //retorna a matriz json no sucesso do ajax saber que foi com inserido sucesso
    $return = json_encode($dados);
    echo $return;
} catch (Exception $ex) {
    //retorna 0 para no sucesso do ajax saber que foi um erro
    echo "0";
}
?>
