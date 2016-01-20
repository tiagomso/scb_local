<?php
/**
 * 
 * Este arquivo realiza o upload de um arquivo
 * utilizando a função move_uploaded_file
 * do PHP.
 * 
 * A maneira que está implementada neste código, 
 * é a mais simples possível. Não há validação de tipos,
 * aceitando todos os tipos de arquivos.
 * 
 */ 


if( $_FILES ) { // Verificando se existe o envio de arquivos.
    

	
	if( $_FILES['arquivo'] ) { // Verifica se o campo não está vazio.
		
		$dir = '../../arquivos/'; // Diretório que vai receber o arquivo.
		$tmpName = $_FILES['arquivo']['tmp_name']; // Recebe o arquivo temporário.
		$name = $_FILES['arquivo']['name']; // Recebe o nome do arquivo.
		
		// move_uploaded_file( $arqTemporário, $nomeDoArquivo )
		if( move_uploaded_file( $tmpName, $dir . $name ) ) { // move_uploaded_file irá realizar o envio do arquivo.
                            require "../ferramentas/conexao_banco_dados.php";
                            
                            //recupera o número da conta e a data efetiva
                            $nro_cta = $_POST['nro_cta'];

                            $query = "SELECT (id_cta) FROM tbl_cta WHERE nro_cta = $nro_cta";
                            $resultado = $mysqli->query($query, MYSQLI_STORE_RESULT);
                            while(list ($nro_cta_rec) = $resultado->fetch_row()){ 
                                $nro_cta =  $nro_cta_rec; 
                            }
                            
                            //verifica se a conta informada já foi cadastrada
                            if ($nro_cta > 10){
                                header('Location: erro.php');
                            }
                            
                            $id_seq_lnc = 0;
                            
                            //atribue o endereço absoluto ao arquivo de texto
                            $arquivo = $dir . $name;
                            
                            //abre o arquivo de texto para leitura
                            $arq = fopen($arquivo,'rt');
                            
                            
                            echo "<pre>";
                            //enquanto o fim do arquivo não for alcançado, recupera a próxima linha
                            while(!feof($arq)){
                                $conteudo = fgets($arq);
                                $id = substr($conteudo, 2,1);
                                if ($id == "/"){
                                    
                                    //$dt_eft = strftime("%Y-%m-%d",strtotime($_POST['dt_eft']));
                                    
                                    $dt_eft = $_POST['dt_eft'];
                                    $dt_eft = explode('/', $dt_eft);     // transforma em array
                                    $dt_eft = array_reverse($dt_eft); // inverte posicoes do array
                                    $dt_eft = implode('-', $dt_eft);     // transforma em string novamente
                                    
                                    $dt_eft_ano = substr($dt_eft, 0, 4);
                                    $dt_vlz = $dt_eft_ano . "-" . substr($conteudo, 3, 2) . "-" . substr($conteudo, 0, 2);
                                    
                                    $nro_doc = substr($conteudo, 6, 6);
                                    $txt_hst = strtoupper(substr($conteudo, 13, 30));
                                    
                                    $vlr_lnc = substr($conteudo, 43, 19);
                                    $vlr_lnc = str_replace('.', '',$vlr_lnc);
                                    $vlr_lnc = str_replace(',', '.',$vlr_lnc);
                                    $vlr_lnc = trim($vlr_lnc);
                                    $vlr_lnc = (double) $vlr_lnc;
                                    
                                    if (substr($conteudo, 62, 1) == "+"){
                                        $nat_fin_lnc = 'C';
                                        $nat_ctb_lnc = 'D';
                                    } else {
                                        $nat_fin_lnc = 'D';
                                        $nat_ctb_lnc = 'C';
                                    }
                                    $id_cnc = 'N';
                                    $id_seq_lnc++;

                                     //consulta sql - inserção
                                     
                                    $query = "INSERT INTO bd_scb.tbl_lnc_fin (dt_eft, dt_vlz, nro_doc, txt_hst, vlr_lnc, nat_fin_lnc, nat_ctb_lnc, id_cnc, id_evt_ctb, id_cta, id_seq_dt) 
                                        VALUES ('$dt_eft', '$dt_vlz', '$nro_doc', '$txt_hst', '$vlr_lnc', '$nat_fin_lnc', '$nat_ctb_lnc', '$id_cnc', '1', '$nro_cta', '$id_seq_lnc')";
                                    $resultado = $mysqli->query($query, MYSQLI_STORE_RESULT);
                                }
                            }
                            echo "</pre>";
                            
                            //fecha o arquivo de texto
                            fclose($arq);
                            //fecha a conexão com o banco de dados
                            $mysqli->close();
                            
			header('Location: sucesso.php'); // Em caso de sucesso, retorna para a página de sucesso.			
		} else {			
			header('Location: erro.php'); // Em caso de erro, retorna para a página de erro.			
		}		
	}
}

?>