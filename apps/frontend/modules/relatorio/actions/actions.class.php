<?php

/**
 * relatorio actions.
 *
 * @package    monomanager
 * @subpackage relatorio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class relatorioActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  }

  public function executeStatus(sfWebRequest $request)
  {
    $generate = $request->hasParameter('gerar');
    if($generate){
      $filters = $request->getParameter('relatorio');
      $matriculaEstudante = $filters['estudante_id'];
      $professorId = $filters['professor_id'];
      $status = $filters['status'];
      $semestreId = $filters['semestre_id'];

      $results = ProjetoTable::getInstance()->generateStatusReport($matriculaEstudante, $professorId, $status, $semestreId);
      $this->reportRows = $results;

      $this->form = new RelatorioStatusForm($filters);
    }else{
      $this->form = new RelatorioStatusForm();
    }
  }

  public function executeConcluidos(sfWebRequest $request)
  {
    $generate = $request->hasParameter('gerar');
    if($generate){
      $filters = $request->getParameter('relatorio');
      $semestreId = $filters['semestre_id'];

      $results = ProjetoTable::getInstance()->generateDefendidosReport($semestreId);
      $this->reportRows = $results;

      $this->form = new RelatorioDefendidosForm($filters);
    }else{
      $this->form = new RelatorioDefendidosForm();
    }
  }

  public function executeAta(sfWebRequest $request)
  {

    $config = sfTCPDFPluginConfigHandler::loadConfig();
    $pdf = new sfTCPDF();

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('TCC-MANAGER');
    $pdf->SetTitle('Ata de apresentação de projeto final');

    $pdf->addPage();

    $html = '
    <div align="center">
        <table width="700">
            <tr>
                <td><img src="images/logo_uece.png" height="100" /></td>
                <td>UNIVERSIDADE ESTADUAL DO CEARÁ<br/>
                    Centro de Ciências e Tecnologia<br/>
                    Coordenação do Curso de Ciências da  Computação<br/>
                    Av. Paranjana, 1700, Campus do Itaperi, Fortaleza, Ceará</td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3 align="center">ATA DA APRESENTAÇÃO E DEFESA DE PROJETO FINAL</h3>
                        Aluno(a): <br/>
                        Título:. <br/>
                        <br/>
                        Orientador: Prof.( a). <br/>
                        <br/>
                        Banca Examinadora:
                        <ul>
                            <li>1º Examinador: Prof. </li>
                            <li>2º Examinador: Prof. </li>
                            <li>3º Examinador: Prof. </li>
                        </ul>
                        <p align="justify">A Defesa da referida monografia de Projeto Final ocorreu no dia  de  de 2011  às h, tendo sido o aluno submetido à sabatina pela banca examinadora. Finalmente, a mesma reuniu-se em separado e concluiu por considerar o candidato______________ em virtude da sua monografia e sua defesa pública alcançarem média ______.</p>  
                        
                        <p align="justify">Eu, que presidi a banca assino a presente ata, juntamente com os demais membros e dou fé.</p>
                        Fortaleza,   de   de  2011       
                        
                        <br/><br/><br/><br/>
                        <table width="600">
                            <tr><td style="border-top: 1px solid #000000; padding-bottom: 40px;">1º Examinador: Prof</td></tr>
                            <tr><td style="border-top: 1px solid #000000; padding-bottom: 40px;">2º Examinador: Prof</td></tr>
                            <tr><td style="border-top: 1px solid #000000;">3º Examinador: Prof</td></tr>
                        </table> 
                </td>
            </tr>
        </table>
    </div> 
    ';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('ata.pdf', 'I');

    throw new sfStopException();
  }

}
