<?php
    if(isset($_POST["btn_salvar"])){
        require "../ferramentas/conexao_banco_dados.php";
        $id_evt_ctb = $_POST['id_evt_ctb'];
        $id_lanc = $_POST['id_lanc'];
        $query = "UPDATE  tbl_lnc_fin SET  id_evt_ctb = '$id_evt_ctb' WHERE  id_lanc =$id_lanc";
        $resultado = $mysqli->query($query, MYSQLI_STORE_RESULT);
    }
?>