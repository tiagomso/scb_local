<?php

// Conex�o com o banco de dados
require "../ferramentas/conexao_banco_dados_02.php";

// Recupera o valor da variavel id_lanc
$id_lanc = isset($_POST["id_lanc"]) ? addslashes(trim($_POST["id_lanc"])) : FALSE;
// Recupera o valor da variavel txt_obs
$txt_obs = isset($_POST["txt_obs"]) ? addslashes(trim($_POST["txt_obs"])) : FALSE;

/**
 * Executa a consulta no banco de dados.
 * Caso o n�mero de linhas retornadas seja 1 o login � v�lido,
 * caso 0, inv�lido.
 */

$SQL = "UPDATE  tbl_lnc_fin SET  txt_obs = '" . $txt_obs . "' WHERE  id_lanc = '" . $id_lanc . "'";
$result_UPDT = @mysql_query($SQL) or die("Erro no banco de dados!");

if ($result_UPDT) {
    echo $result_UPDT;
    exit;
}
?>