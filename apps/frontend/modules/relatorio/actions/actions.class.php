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
		$projetoId = $request->getParameter('id');
		$projeto = ProjetoTable::getInstance()->find($projetoId);
		
		$aluno = $projeto->getEstudante()->getUsuario()->getFullName();
		$titulo = $projeto->getTitulo();
		$orientador = $projeto->getProfessor()->getUsuario()->getFullName();
		$nota = 9.7;
		$data = date();
		$hora = "12:30";
		$examinadores = array("Fulano de tal", "Cicrano Silva", "Beltrano José");
		
		$this->generateAta($aluno, $titulo, $orientador, $nota, $data, $hora, $examinadores);
  }
	
	private function generateAta($aluno, $titulo, $orientador, $nota, $data, $hora, $examinadores = array()){
    $pdf = $this->createBaseDocument('ATA DA APRESENTAÇÃO E DEFESA DE PROJETO FINAL');

    $pdf->SetY(70);
    $pdf->cell(0,0,'Aluno(a): ' . $aluno, 0, 2);
    $pdf->cell(0,0,'Título: ' . $titulo, 0, 2);
    $pdf->Ln('');
    $pdf->cell(0,0,'Orientador: Prof.(a) ' . $orientador, 0, 2);
    $pdf->Ln('');
    $pdf->cell(0,0,'Banca Examinadora:', 0, 2);
    $pdf->SetX(25);
		for($i=0; $i<count($examinadores); $i++){
	    $pdf->cell(0,0, ($i+1) . 'º Examinador: Prof. ' . $examinadores[$i], 0, 2);
		}

    $pdf->Ln(10);
		$formattedDate = $this->formatDate($data);
    $pdf->writeHTML("<span style='text-align:justify;'>Defesa da referida monografia de Projeto Final ocorreu no dia  $formattedDate às $hora h, tendo sido o aluno submetido à sabatina pela banca examinadora. Finalmente, a mesma reuniu-se em separado e concluiu por considerar o candidato $aluno em virtude da sua monografia e sua defesa pública alcançarem média $nota.</span>");

    $pdf->Ln(5);
    $pdf->cell(0,0,'Eu, que presidi a banca assino a presente ata, juntamente com os demais membros e dou fé.', 0, 2);
    $pdf->Ln();
    $pdf->cell(0,0,$this->getCurrentDateString(), 0, 2);
    $pdf->Ln(10);

		for($i=0; $i<count($examinadores); $i++){
			$pdf->Ln(10);
	    $pdf->cell(120,0, ($i+1) . 'º Examinador: Prof. ' . $examinadores[$i], 'T', 2);
		}
		
    $pdf->Output('ata.pdf', 'I');

    throw new sfStopException();			
	}

  public function executeDeclaracao(sfWebRequest $request)
  {
    $pdf = $this->createBaseDocument('DECLARAÇÃO');

    $pdf->SetY(70);
    $pdf->writeHTML('<span style="text-align:justify;">Declaramos que o(a) professor(a) Mmmm Sssss orientou e presidiu a Banca Examinadora da Monografia de Projeto Final do(a) aluno(a) Xxxxx Yyyyy intitulada Titulo, dentro dos preceitos instituídos pela Universidade Estadual do Ceará, objetivando o preenchimento dos requisitos para titulação de Bacharel em Ciência da Computação.</span>');

    $pdf->Ln(20);
    $pdf->cell(0,0,$this->getCurrentDateString(), 0, 2);
    $pdf->Ln(20);

    $pdf->cell(120,0,'Profa. Mariela Inés Cortés', 'T', 2);
    $pdf->cell(0,0,'Coordenadora do Curso de Ciência da Computação - UECE', 0, 2);

    $pdf->Output('declaracao.pdf', 'I');

    throw new sfStopException();
  }

  public function executeFicha(sfWebRequest $request)
  {
    $pdf = $this->createBaseDocument('FICHA DE AVALIAÇÃO DE PROJETO FINAL');

    $pdf->SetY(60);
    $pdf->cell(0,0,'Examinador: Prof.', 0, 2);
    $pdf->Ln();
    $pdf->cell(0,0,'Aluno:', 0, 2);
    $pdf->Ln();
    $pdf->cell(0,0,'Título:', 0, 2);
    $pdf->Ln();

    //Tabela
    $pdf->SetFontSize(10);
    $pageSize = $pdf->getPageWidth() - 30;
    //Cabeçalho
    $pdf->cell($pageSize * 0.8, 10, 'Tópico', 1, 0, 'C');
    $pdf->cell($pageSize * 0.2, 10, 'Avaliação (0 - 10)', 1, 0, 'C');
    $pdf->Ln();

    $pdf->cell($pageSize * 0.8, 10, 'Projeto e organização do trabalho (fundamentação, metodologia e relevância)', 1, 0);
    $pdf->cell($pageSize * 0.2, 10, '', 1);
    $pdf->Ln();

    $pdf->cell($pageSize * 0.8, 10, 'Avaliação do trabalho escrito (correção, clareza e objetividade)', 1, 0);
    $pdf->cell($pageSize * 0.2, 10, '', 1);
    $pdf->Ln();

    $pdf->cell($pageSize * 0.8, 10, 'Apresentação oral (segurança e tempo - 30 min)', 1, 0);
    $pdf->cell($pageSize * 0.2, 10, '', 1);
    $pdf->Ln();

    $pdf->cell($pageSize * 0.8, 10, 'Nota final (Média aritmética)', 1, 0, 'R');
    $pdf->cell($pageSize * 0.2, 10, '', 1);
    $pdf->Ln(15);

    $pdf->SetFontSize(12);
    $pdf->cell(0,0,'Comentários:', 0, 2);
    $pdf->Ln();
    for($i=0; $i<10; $i++){
      $pdf->cell($pageSize,8,'', 'T', 2);
    }

    $pdf->Ln(5);
    $pdf->cell(0,0,$this->getCurrentDateString(), 0, 2);
    $pdf->Ln(15);

    $pdf->cell(120,0,'Examinador Prof.', 'T', 2);

    $pdf->Output('ficha.pdf', 'I');

    throw new sfStopException();
  }

  private function createBaseDocument($mainTitle) {

    $config = sfTCPDFPluginConfigHandler::loadConfig();
    $pdf = new sfTCPDF();

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('TCC-MANAGER');
    $pdf->SetTitle($mainTitle);

    $pdf->SetPrintHeader(false);
    $pdf->SetPrintFooter(false);
    $pdf->SetMargins(15, 15, 15, true);

    $pdf->addPage();
    $logo = 'images/logo_uece.png';
    $pdf->Image($logo, 15, 15, 20);
    $pdf->SetFont('helvetica', '', 11);
    $pdf->writeHTMLCell(0, 0, 40, 20, 'UNIVERSIDADE ESTADUAL DO CEARÁ<br/>Centro de Ciências e Tecnologia<br/>Coordenação do Curso de Ciências da Computação<br/>Av. Paranjana, 1700, Campus do Itaperi, Fortaleza, Ceará');

    $pdf->Line(15, 47, $pdf->getPageWidth() - 15, 47);
    $pdf->Rect(5, 5, $pdf->getPageWidth() - 10, $pdf->getPageHeight() - 10);

    $pdf->SetY(50);
    $pdf->SetFont('helvetica', 'b', 12);
    $pdf->cell(0,0,$mainTitle, 0, 1, 'C');

    $pdf->SetFont('helvetica', '', 12);

    return $pdf;
  }

  private function getCurrentDateString(){
    setlocale(LC_TIME, 'pt_BR.utf8');
    return strftime('Fortaleza, %d de %B de %Y');
  }
	
	private function formatDate($date){
		setlocale(LC_TIME, 'pt_BR.utf8');
    return strftime('%d de %B de %Y', $date);
	}

}
