<?php

// Require no script da classe reportCliente  
require_once "relatorio.class.php";

// Recupera o valor da variavel id_lanc
$id_lnc = $_GET["id_lanc"];

/*
 * passa os parâmetros para o construtor, chama o método para construção do PDF  
 * e manda exibi-lo no navegador.  
 */

$report = new relatorioFicha("../../bibliotecas/css/estilo_relatorio.css", "Ficha Contábil", $id_lnc);
$report->construirFichaContabil();
$report->Exibir("Ficha Contábil");

?>  
