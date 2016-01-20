<?php
    $gt_nvl = $id_nvl;

    echo "<ul id=\"mainNav\">";
        echo "<li><a href=\"". $gt_nvl . "index.php\" ><p>Início</p></a></li>";
        //echo "<li><a href=\"". $gt_nvl . "site/extrato/extrato_menu.php\" ><p>Extratos</p></a></li>";
        echo "<li><a href=\"". $gt_nvl . "site/extrato/importar_extrato.php\" ><p>Importar Extrato</p></a></li>";
        echo "<li><a href=\"". $gt_nvl . "site/extrato/extrato_conciliacao_filtro.php\" ><p>Conciliar Extrato</p></a></li>";
        echo "<li><a href=\"". $gt_nvl . "site/manutencao/cadastro_menu.php\" ><p>Manutenção de Parâmetros</p></a></li>";
        echo "<li><a href=\"". $gt_nvl . "site/relatorios/relatorio_menu.php\" ><p>Relatórios</p></a></li>";
    echo "</ul>";
?>
