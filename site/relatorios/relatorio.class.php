<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('MPDF_PATH', '../../bibliotecas/MPDF60/'); //definimos uma constante com o nome da pasta
require_once(MPDF_PATH . 'mpdf.php'); //incluimos o arquivo da classe mPdf
require_once "../conexao/conexao.php";  //inclui a classe de conexao com o banco de dados

class relatorioFicha extends mpdf {

    // Atributos da classe  
    private $pdo = null;
    private $pdf = null;
    private $css = null;
    private $titulo = null;
    private $id_lanc = null;

    /*
     * Construtor da classe  
     * @param $css  - Arquivo CSS  
     * @param $titulo - Título do relatório   
     */

    public function __construct($css, $titulo, $id_lanc) {
        $this->pdo = Conexao::getInstance();
        $this->titulo = $titulo;
        $this->id_lanc = $id_lanc;
        $this->setarCSS($css);
    }

    /*
     * Método para setar o conteúdo do arquivo CSS para o atributo css  
     * @param $file - Caminho para arquivo CSS  
     */

    public function setarCSS($file) {
        if (file_exists($file)):
            $this->css = file_get_contents($file);
        else:
            echo 'Arquivo inexistente!';
        endif;
    }

    /*
     * Método para montar o Cabeçalho do relatório em PDF  
     */

    protected function getHeader() {
        $data = date('j/m/Y');
        $retorno = "<table class=\"tbl_header\" width=\"1000\">  
               <tr>  
                 <td align=\"left\">SCB - Sistema de Conciliação Bancária</td>  
                 <td align=\"right\">Gerado em: $data</td>  
               </tr>  
             </table>";
        return $retorno;
    }

    /*
     * Método para montar o Rodapé do relatório em PDF  
     */

    protected function getFooter() {
        $retorno = "<table class=\"tbl_footer\" width=\"1000\">  
               <tr>  
                 <td align=\"left\">Financeira BRB/Difad/Sufad/Gerfi</td>  
                 <td align=\"right\">Página: {PAGENO}</td>  
               </tr>  
             </table>";
        return $retorno;
    }

    /*
     * Método para construir a tabela em HTML com todos os dados  
     * Esse método também gera o conteúdo para o arquivo PDF  
     */

    private function getFichaContabil() {
        $empresa = '05 - BRB CFI';
        $estabelecimento = '0799';
        $unidade = '05';
        $sistema = 'SCB';
        $esquema = '7162';
        $retorno = "";
        //$color = false;

        $retorno .= "<h3 style=\"text-align:center\">{$this->titulo}</h2>";
        $retorno .= "<table border='1' width='1000' align='center'>";

        $sql = "SELECT * FROM `tbl_lnc_fin`\n"
                . "INNER JOIN `tbl_cta` ON `tbl_lnc_fin`.`id_cta` = `tbl_cta`.`id_cta`\n"
                . "INNER JOIN `tbl_evt_ctb` ON `tbl_lnc_fin`.`id_evt_ctb` = `tbl_evt_ctb`.`id_evt_ctb`\n"
                . "WHERE `tbl_lnc_fin`.`id_lanc` LIKE '$this->id_lanc'";

        foreach ($this->pdo->query($sql) as $reg):
            $retorno .= "<tr>";
            $retorno .= "<th>EMPRESA :</th>";
            $retorno .= "<td>$empresa</td>";
            $retorno .= "<th>ESTABELECIMENTO :</th>";
            $retorno .= "<td>$estabelecimento</td>";
            $retorno .= "<th>UNIDADE :</th>";
            $retorno .= "<td>$unidade</td>";
            $retorno .= "</tr>";

            $dt_efet = date('d/m/Y', strtotime($reg['dt_eft']));

            $retorno .= "<tr>";
            $retorno .= "<th>DATA :</th>";
            $retorno .= "<td>$dt_efet</td>";
            $retorno .= "<th>USUARIO :</th>";
            $retorno .= "<td>NULL</td>";
            $retorno .= "<th>SISTEMA :</th>";
            $retorno .= "<td>$sistema</td>";
            $retorno .= "</tr>";

            $retorno .= "<tr>";
            $retorno .= "<th>CONTA :</th>";
            $retorno .= "<td>{$reg['nro_cta']}</td>";
            $retorno .= "<th>NSU :</th>";
            $retorno .= "<td>{$reg['id_lanc']}</td>";
            $retorno .= "<th>DOCUMENTO :</th>";
            $retorno .= "<td>{$reg['nro_doc']}</td>";
            $retorno .= "</tr>";

            $retorno .= "<tr>";
            $retorno .= "<th>LANCAMENTO :</th>";
            $retorno .= "<td colspan=\"3\">{$reg['txt_hst']}</td>";
            $retorno .= "<th>VALOR :</th>";
            $retorno .= "<td>{$reg['vlr_lnc']}</td>";
            $retorno .= "</tr>";

            $retorno .= "<tr>";
            $retorno .= "<th>HISTORICO :</th>";
            $retorno .= "<td colspan=\"3\">{$reg['nm_evt_ctb']} - CONFORME COMPLEMENTO</td>";
            $retorno .= "<th>ESQUEMA</th>";
            $retorno .= "<td>$esquema</td>";
            $retorno .= "</tr>";

        endforeach;
        
        $retorno .= "</table>";

        return $retorno;
    }

    private function getPartidasFichaContabil() {
        $soma_deb = 0;
        $soma_cred = 0;
        
        $retorno = "";
        $retorno .= "<table border='1' width='1000' align='center'>";

        $retorno .= "<tr>";
        $retorno .= "<th>D/C</th>";
        $retorno .= "<th>ITEM</th>";
        $retorno .= "<th>CONTA</th>";
        $retorno .= "<th colspan=\"2\">DESCRIÇÃO</th>";
        $retorno .= "<th>VALOR</th>";
        $retorno .= "</tr>";

        $sql = "SELECT * FROM `tbl_lnc_fin` \n"
                . "INNER JOIN `tbl_cta` ON `tbl_lnc_fin`.`id_cta` = `tbl_cta`.`id_cta`\n"
                . "INNER JOIN `tbl_evt_ctb` ON `tbl_lnc_fin`.`id_evt_ctb` = `tbl_evt_ctb`.`id_evt_ctb`\n"
                . "INNER JOIN `tbl_evt_ptd_dbr` ON `tbl_lnc_fin`.`id_lanc` = `tbl_evt_ptd_dbr`.`id_lanc`\n"
                . "INNER JOIN `tbl_pln_cta_csf` ON `tbl_evt_ptd_dbr`.`id_pln_cta` = `tbl_pln_cta_csf`.`id_pln_cta`\n"
                . "WHERE `tbl_lnc_fin`.`id_lanc` LIKE '$this->id_lanc'";
        
        foreach ($this->pdo->query($sql) as $reg):
            if ($reg['nat_cta_lnc'] == "D") {
                $nat_ctb = "DÉBITO";
                $item = $reg['nro_itm_deb'];
                $soma_deb = $soma_deb + $reg['vlr_lnc_ptd_dbd'];
            } else {
                $nat_ctb = "CRÉDITO";
                $item = $reg['nro_itm_cre'];
                $soma_cred = $soma_cred + $reg['vlr_lnc_ptd_dbd'];
            }

            $retorno .= "<tr>";
            $retorno .= "<td>$nat_ctb</td>";
            $retorno .= "<td>$item</td>";
            $retorno .= "<td>{$reg['cod_csf']}</td>";
            $retorno .= "<td colspan=\"2\">{$reg['nm_csf']}</td>";
            $retorno .= "<td>{$reg['vlr_lnc_ptd_dbd']}</td>";
            $retorno .= "</tr>";
        endforeach;
        
        $dif_d_c = $soma_deb - $soma_cred;
        
        $retorno .= "<tr>";
        $retorno .= "<th>TOTAL DÉBITO</th>";
        $retorno .= "<td>$soma_deb</td>";
        $retorno .= "<th>TOTAL CRÉDITO</th>";
        $retorno .= "<td>$soma_cred</td>";
        $retorno .= "<th>DIFERENÇA</th>";
        $retorno .= "<td>$dif_d_c</td>";
        $retorno .= "</tr>";

        $retorno .= "</table>";
        return $retorno;
    }

    private function getComplementoFichaContabil() {
        $retorno = "";
        $complemento = "";

        $retorno .= "<table border='1' width='1000' align='center'>";

        $sql = "SELECT * FROM `tbl_lnc_fin` \n"
                . "INNER JOIN `tbl_compl_lanc` ON `tbl_lnc_fin`.`id_lanc` = `tbl_compl_lanc`.`id_lanc`\n"
                . "WHERE `tbl_lnc_fin`.`id_lanc` LIKE '$this->id_lanc'";
       
        foreach ($this->pdo->query($sql) as $reg):
            $complemento .= "ID : {$reg['id_seq_cmp']}||"
                . " Cliente : {$reg['cod_clt']}||"
                . " CPF : {$reg['cod_cpf']}||"
                . " Convênio : {$reg['cod_cvn']}||"
                . " Contrato : {$reg['nro_ctr']}||"
                . " Parcela : {$reg['nro_pcl']}||"
                . " Valor : {$reg['vlr_comp']}<br>";
        endforeach;
        
        $retorno .= "<tr>";
        $retorno .= "<th>COMPLEMENTO</th>";
        $retorno .= "<td  colspan=\"5\">$complemento</td>";
        $retorno .= "</tr>";

        $retorno .= "</table>";
        return $retorno;
    }
    
    private function getObservacoesFichaContabil(){
        $retorno = "";
        $retorno .= "<table border='1' width='1000' align='center'>";
        
        $sql = "SELECT * FROM `tbl_lnc_fin` \n"
                . "WHERE `tbl_lnc_fin`.`id_lanc` LIKE '$this->id_lanc'";
       
        foreach ($this->pdo->query($sql) as $reg):
            $retorno .= "<tr>";   
            $retorno .= "<th>OBSERVAÇÕES :</th>";
            $retorno .= "<td colspan=\"5\">{$reg['txt_obs']}</td>";
            $retorno .= "</tr>";  
        endforeach;
        
        $retorno .= "</table>";
        return $retorno;
        
    }

    /*
     * Método para construir o arquivo PDF da Ficha Contabil
     */

    public function construirFichaContabil() {
        $this->pdf = new mPDF('utf-8', 'A4-P');
        $this->pdf->WriteHTML($this->css, 1);

        $this->pdf->WriteHTML($this->getFichaContabil());
        $this->pdf->WriteHTML($this->getPartidasFichaContabil());
        $this->pdf->WriteHTML("<br>");
        $this->pdf->WriteHTML($this->getComplementoFichaContabil());
        $this->pdf->WriteHTML("<br>");
        $this->pdf->WriteHTML($this->getObservacoesFichaContabil());

        for ($i = 0; $i < 15; $i++) {
            $this->pdf->WriteHTML("<br>");
        }
        
        $this->pdf->WriteHTML($this->getFichaContabil());
        $this->pdf->WriteHTML($this->getPartidasFichaContabil());
        $this->pdf->WriteHTML("<br>");
        $this->pdf->WriteHTML($this->getComplementoFichaContabil());
        $this->pdf->WriteHTML("<br>");
        $this->pdf->WriteHTML($this->getObservacoesFichaContabil());
    }

    /*
     * Método para exibir o arquivo PDF  
     * @param $name - Nome do arquivo se necessário grava-lo  
     */

    public function Exibir($name = NULL) {
        $this->pdf->Output($name, 'I');
    }

}

?>