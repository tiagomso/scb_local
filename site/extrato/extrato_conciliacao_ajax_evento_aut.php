<?php

// Conex�o com o banco de dados
require "../ferramentas/conexao_banco_dados_02.php";

// Recupera o login
$id_lanc = isset($_POST["id_lanc"]) ? addslashes(trim($_POST["id_lanc"])) : FALSE;
// Recupera a senha, a criptografando em MD5
$id_aut = isset($_POST["id_aut"]) ? addslashes(trim($_POST["id_aut"])) : FALSE;

/**
 * Executa a consulta no banco de dados.
 * Caso o n�mero de linhas retornadas seja 1 o login � v�lido,
 * caso 0, inv�lido.
 */
$SQL = "UPDATE  tbl_lnc_fin SET  id_cnc = '" . $id_aut . "' WHERE  id_lanc = '" . $id_lanc . "'";
$result_UPDT = @mysql_query($SQL) or die("Erro no banco de dados!");

if ($result_UPDT) {
    echo $result_UPDT;
    exit;
}
?>