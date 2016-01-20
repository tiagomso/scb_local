<?php
// Conex�o com o banco de dados
require "../ferramentas/conexao_banco_dados_02.php";

// Recupera o login
$id_lanc = isset($_POST["id_lanc"]) ? addslashes(trim($_POST["id_lanc"])) : FALSE;
// Recupera a senha, a criptografando em MD5
$id_evt_ctb = isset($_POST["id_evt_ctb"]) ? addslashes(trim($_POST["id_evt_ctb"])) : FALSE;

/**
* Executa a consulta no banco de dados.
* Caso o n�mero de linhas retornadas seja 1 o login � v�lido,
* caso 0, inv�lido.
*/
$SQL = "UPDATE  tbl_lnc_fin SET  id_evt_ctb = '" .$id_evt_ctb. "' WHERE  id_lanc = '" .$id_lanc . "'";
$result_INS = @mysql_query($SQL) or die("Erro no banco de dados!");

$SQL = "SELECT id_evt_ctb, nm_evt_ctb 
        FROM tbl_evt_ctb
        WHERE id_evt_ctb = '" .$id_evt_ctb . "'";
$result_SEL = @mysql_query($SQL) or die("Erro no banco de dados!");
$total = @mysql_num_rows($result_SEL);

if($total){
    $dados = @mysql_fetch_array($result_SEL);
    $return = $dados["nm_evt_ctb"];
    echo $return;
    exit;
}

?>