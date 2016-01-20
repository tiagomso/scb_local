<?php
//Conexão à base de dados
require "../ferramentas/conexao_banco_dados.php";

//recebe os parâmetros
$id_ctr = $_REQUEST['id_ctr'];
$id_tab = $_REQUEST['id_tab']; // CONTAS BANCARIAS / EVENTOS / COSIF / USUARIO / PARTIDAS / CONVENIOS

if ($id_tab == "CONTAS") {
    try {
        $consulta = "DELETE FROM tbl_cta WHERE id_cta IN('$id_ctr')";
        $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
        echo '1';
    } catch (Exception $ex) {
        //retorna 0 para no sucesso do ajax saber que foi um erro
        echo '0';
    }
} else if ($id_tab == "EVENTOS") {
    try {
        $consulta = "DELETE FROM tbl_evt_ctb WHERE id_evt_ctb IN('$id_ctr')";
        $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);

        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        echo '1';
    } catch (Exception $ex) {
        //retorna 0 para no sucesso do ajax saber que foi um erro
        echo '0';
    }
} else if ($id_tab == "COSIF") {
    try {
        $consulta = "DELETE FROM tbl_pln_cta_csf WHERE id_pln_cta IN('$id_ctr')";
        $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);

        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        echo '1';
    } catch (Exception $ex) {
        //retorna 0 para no sucesso do ajax saber que foi um erro
        echo '0';
    }
} else if ($id_tab == "USUARIO") {
    try {
        $consulta = "DELETE FROM tbl_cta WHERE id_cta IN('$id_ctr')";
        $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        echo '1';
    } catch (Exception $ex) {
        //retorna 0 para no sucesso do ajax saber que foi um erro
        echo '0';
    }
} else if ($id_tab == "PARTIDAS") {
    try {
        $consulta = "DELETE FROM tbl_evt_ptd_db WHERE id_evt_ptd_dbr IN('$id_ctr')";
        $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        echo '1';
    } catch (Exception $ex) {
        //retorna 0 para no sucesso do ajax saber que foi um erro
        echo '0';
    }
}else if ($id_tab == "CONVENIOS") {
    try {
        $consulta = "DELETE FROM tbl_pln_cta_csf WHERE id_pln_cta IN('$id_ctr')";
        $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        echo '1';
    } catch (Exception $ex) {
        //retorna 0 para no sucesso do ajax saber que foi um erro
        echo '0';
    }
}

?>