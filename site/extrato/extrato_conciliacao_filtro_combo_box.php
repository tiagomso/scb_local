<?php
    require "../ferramentas/conexao_banco_dados.php";
    
    echo "<p><label for=\"lbl_texto\" class=\"label\">";
        echo "Gerência : </label>";
        echo "<select name=cmb_gerencia size=\”1\” maxlength=\"50\" onkeydown=\"impede_enter();\">";
            echo "<option ></option>";
                $query = "SELECT * FROM tbl_gerencias ORDER BY txt_gerencias";
                $resultado = $mysqli->query($query, MYSQLI_STORE_RESULT);
                    while(list ($txt_gerencia) = $resultado->fetch_row()){
                        echo "<option value=\"" . $txt_gerencia . "\">" . $txt_gerencia . "</option>";
                    }
        echo "</select>";
    echo "</p>";
    
    echo "<p><label for=\"lbl_texto\" class=\"label\">";
        echo "Status : </label>";
        echo "<select name=txt_status size=\"1\" maxlength=\"50\" onkeydown=\"impede_enter();\" />";
            echo "<option ></option>";
                $query = "SELECT * FROM tbl_status_demanda ORDER BY txt_status";
                    $resultado = $mysqli->query($query, MYSQLI_STORE_RESULT);
                        while(list ($txt_status) = $resultado->fetch_row()){
                            echo "<option value=\"" . $txt_status . "\">" . $txt_status . "</option>";
                        }
        echo "</select>";
    echo "</p>";
     
    echo "<p><label for=\"lbl_texto\" class=\"label\">";
        echo "Prazo : </label>";
        echo "<select name=txt_status_prz size=\"1\" maxlength=\"50\" onkeydown=\"impede_enter();\" />";
            echo "<option ></option>";
                $query = "SELECT * FROM tbl_status_prazo ORDER BY txt_status_prz";
                    $resultado = $mysqli->query($query, MYSQLI_STORE_RESULT);
                        while(list ($txt_status_prz) = $resultado->fetch_row()){
                            echo "<option value=\"" . $txt_status_prz . "\">" . $txt_status_prz . "</option>";
                        }
        echo "</select>";
    echo "</p>";
     
    echo "<p><label for=\"lbl_texto\" class=\"label\">";
        echo "Prioridade : </label>";
        echo "<select name=txt_prioridade size=\"1\" maxlength=\"50\" onkeydown=\"impede_enter();\" />";
            echo "<option ></option>";
                $query = "SELECT * FROM tbl_proridade ORDER BY txt_prioridade";
                    $resultado = $mysqli->query($query, MYSQLI_STORE_RESULT);
                        while(list ($txt_prioridade) = $resultado->fetch_row()){
                            echo "<option value=\"" . $txt_prioridade . "\">" . $txt_prioridade . "</option>";
                        }
        echo "</select>";
    echo "</p>";
    
    $mysqli->close();
?>
