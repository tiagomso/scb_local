 
    <?php
    
    $id_lanc = $_GET['id_lanc'];
    
    require "../ferramentas/conexao_banco_dados.php";
    
    $consulta = "SELECT tbl_lnc_fin.id_lanc, tbl_lnc_fin.id_seq_dt, tbl_lnc_fin.dt_vlz,
                        tbl_lnc_fin.nro_doc, tbl_lnc_fin.txt_hst, tbl_lnc_fin.vlr_lnc, 
                        tbl_lnc_fin.nat_fin_lnc,tbl_lnc_fin.nat_ctb_lnc, tbl_lnc_fin.id_cnc, 
                        (SELECT tbl_evt_ctb.nm_evt_ctb FROM tbl_evt_ctb WHERE tbl_lnc_fin.id_evt_ctb = tbl_evt_ctb.id_evt_ctb), 
                        (SELECT tbl_cta.nro_cta FROM tbl_cta WHERE tbl_cta.id_cta = tbl_lnc_fin.id_cta)
                        FROM tbl_lnc_fin WHERE tbl_lnc_fin.id_lanc = $id_lanc";
    $resultado = $mysqli->query($consulta, MYSQLI_STORE_RESULT);
    while(list ($id_lnc, $id_seq_dt, $dt_vlz, $nro_doc, $txt_hst, $vlr_lnc, $nat_fin_lnc, $nat_ctb_lnc, $id_cnc, $id_evt_rec, $id_cta) = $resultado->fetch_row()){
        $vlr_lnc = number_format($vlr_lnc, 2, ',', '.');
        
        $id_evt_rec = $id_evt_rec;
   
        echo "<form id=\"formEvento\" action=\"extrato_conciliacao.php?id_lanc=$id_lanc\" method=\"post\" autocomplete=\"off\">";
        echo "<div id=\"critica\">critica</div>";
        echo "<p><label for=\"lbl_texto\" class=\"label\">NSU : </label>";
        echo "<input type=\"text\" name=\"id_lanc\" id=\"id_lanc\" class=\"text\" value=\"$id_lanc\"></p>";
        echo "<p><label for=\"lbl_texto\" class=\"label\">Identificador : </label>";
        echo "<input type=\"text\" name=\"id_seq_dt\" id=\"id_seq_dt\" class=\"text\" value=\"$id_seq_dt\"></p>";
        echo "<p><label for=\"lbl_texto\" class=\"label\">Conta : </label>";
        echo "<input type=\"text\" name=\"id_cta\" id=\"id_cta\" class=\"text\" value=\"$id_cta\"></p>";
        echo "<p><label for=\"lbl_texto\" class=\"label\">Valorização : </label>";
        echo "<input type=\"text\" name=\"dt_vlz\" id=\"dt_vlz\" class=\"text\" value=\"$dt_vlz\"></p>";
        echo "<p><label for=\"lbl_texto\" class=\"label\">Documento : </label>";
        echo "<input type=\"text\" name=\"dt_vlz\" id=\"dt_vlz\" class=\"text\" value=\"$nro_doc\"></p>";
        echo "<p><label for=\"lbl_texto\" class=\"label\">Histórico : </label>";
        echo "<input type=\"text\" name=\"txt_hst\" id=\"txt_hst\" class=\"text\" value=\"$txt_hst\"></p>";
        echo "<p><label for=\"lbl_texto\" class=\"label\">Valor : </label>";
        echo "<input type=\"text\" name=\"vlr_lnc\" id=\"vlr_lnc\" class=\"text\" value=\"$vlr_lnc\"></p>";
        echo "<p><label for=\"lbl_texto\" class=\"label\">Natureza : </label>";
        echo "<input type=\"text\" name=\"nat_fin_lnc\" id=\"nat_fin_lnc\" class=\"text\" value=\"$nat_fin_lnc\"></p>"; 
    }

    echo "<p><label for=\"lbl_texto\" class=\"label\">Evento : </label>";
        echo "<select name=id_evt_ctb id=\"id_evt_ctb\" size=\”1\” maxlength=\"50\" class=\"text\" onkeydown=\"impede_enter();\">";
                $query = "SELECT id_evt_ctb, nm_evt_ctb FROM tbl_evt_ctb ORDER BY nm_evt_ctb";
                $resultado = $mysqli->query($query, MYSQLI_STORE_RESULT);
                    while(list ($id_evt_ctb, $txt_evento) = $resultado->fetch_row()){
                        //if ($id_evt_ctb !== $id_evt_rec){
                            echo "<option value=\"" . $id_evt_ctb . "\">" . $txt_evento . "</option>";
                        //} else {
                           // echo "<option selected=\"true\" value=\"" . $id_evt_ctb . "\">" . $txt_evento . "</option>";
                        //}   
                    }
        echo "</select>";
    echo "</p>";
    
    echo "<p><label for=\"lbl_texto\" class=\"label\">Complemento : </label>";
    echo "<select name=id_obr_evt id=id_obr_evt size=\”1\” maxlength=\"50\" class=\"text\" onkeydown=\"impede_enter();\">";
        echo "<option selected=\"true\">OBRIGATÓRIO</option>";
        echo "<option >OPCIONAL</option>";
    echo "</select>";
    echo "</p></br></br>";
    
    echo "<input id=\"voltar\" type=\"button\" class=\"input\" onclick=\"anterior()\" value=\"Anterior\">";
    echo "<input id=\"avancar\" type=\"button\" class=\"input\" onclick=\"acao_proximo()\" value=\"Próximo\">";
    
    $mysqli->close();
    
    ?>
    <input id="salvar" type="button" class="input" onclick="acao();reload()" value="Salvar">
    <input id="sair" type="button" class="input" onclick="fechar_event();reload()" value="Sair">
    
    <br>
    <br>
</form>