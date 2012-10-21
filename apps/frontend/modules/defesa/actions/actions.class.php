<?php

/**
 * defesa actions.
 *
 * @package    monomanager
 * @subpackage defesa
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defesaActions extends documentoActions
{

  protected function saveForm($formData, $formFiles){
    $files = $formFiles['defesa'];

    $this->form->bind($formData, $files);
    if($this->form->isValid()){
      $file = $files['documento'];
      $this->saveFile($file);
      $filename = $this->createFullFilename($file);

      $defesa = $this->form->getObject();
      $defesa->setDocumento($filename);
      $defesa->setDataRequisicao(Util::currentDateInDBFormat());
      $defesa->setQtdePaginas($formData['qtde_paginas']);
      $defesa->setStatus(Defesa::NAO_ANALISADO);

      $dataSugestao = $formData['data_sugestao'];
      $dataSugestao = Util::dateInDBFormat($dataSugestao['year'], $dataSugestao['month'], $dataSugestao['day']);
      $defesa->setDataSugestao($dataSugestao);

      $defesa->save();

      $this->setMessage('notice', 'Defesa requisitada com sucesso.');

      $this->notifyOrientador();

      $this->redirect('projeto/index');
    }
  }
	
  public function executeDownload(sfWebRequest $request)
  {
    $this->validateProject($request);

    $defesa = $this->getWorkingEntity($this->projetoId);
    $copiao = $defesa->getDocumento();
    $final = $defesa->getDocumentoFinal();

    if(!file_exists($copiao)){
      $this->forward404("Documento inexistente");
    }

    $file = $copiao;
    if(file_exists($final)){
      $file = $final;
    }

    $this->prepareDownload($file);
    readfile($file);

    return sfView::NONE;
  }

  public function executeList(sfWebRequest $request){
    parent::executeList($request);

    $minYear = SemestreTable::getInstance()->findEarliestYearOrDefault(date('Y'));
    $rangeYears = range($minYear, date('Y') + 10);
    $years = array_combine($rangeYears, $rangeYears);

    $widgetData = new sfWidgetFormDate();
    $widgetData->setOption('format', '%day%%month%%year%');
    $widgetData->setOption('years', $years);
    $widgetData->setOption('can_be_empty', false);

    $widgetSemestre = new sfWidgetFormDoctrineChoice(array(
        'model' => 'Semestre'
    ));

    $this->widgetData = $widgetData;
    $this->widgetSemestre = $widgetSemestre;
  }

  public function executeAprovar(sfWebRequest $request)
  {
    $this->validateProject($request);

    $aprovado = $request->getParameter('aprovado');
    $defesa = $this->getWorkingEntity($this->projetoId);
    if($defesa->getStatus() == Defesa::NAO_ANALISADO){
      if($aprovado == 'true'){
        $defesa->setStatus(Defesa::APROVADO);
        $this->notifyComissao();
      }else{
        $defesa->setStatus(Proposta::REPROVADO);
        $this->notifyEstudante();
      }
      $defesa->setDataFeedbackOrientador(Util::currentDateInDBFormat());
      $defesa->save();
    }else{
      $this->setMessage('error', 'A defesa já foi analisada.');
    }
    $this->redirect($this->getModuleName() . "/list");
  }

  public function executeLiberar(sfWebRequest $request)
  {
    $this->validateProject($request);

    $approved = $request->getParameter('liberado') == 'true'? true : false;
    $comment = $request->getParameter('comentario');
    $defesa = $this->getWorkingEntity($this->projetoId);

    if($approved){
      $date = $request->getParameter('data_autorizada');
      $date = Util::dateInDBFormat($date['year'], $date['month'], $date['day']);
      $defesa->setDataAutorizacao($date);
      $defesa->save();
    }

    $professor = $this->getUser()->getUsuario()->getProfessor();
    $defesa->audit($professor, $approved, $comment);

    $this->notifyEstudanteOrientador($defesa->getStatus() == Defesa::LIBERADO);
    $this->redirect($this->getModuleName() . "/list");
  }

  public function executeConcluir(sfWebRequest $request)
  {
    $this->validateProject($request);

    $finished = $request->getParameter('concluido') == 'true'? true : false;
    $defesa = $this->getWorkingEntity($this->projetoId);

    if($finished){
      $defesa->setStatus(Defesa::DEFENDIDO);
      $defesa->save();
    }

    $this->redirect($this->getModuleName() . "/list");
  }

  public function executeInfo(sfWebRequest $request)
  {
    $this->validateProject($request);
    $defesa = $this->getWorkingEntity($this->projetoId);

    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
    $urlApprove = url_for("@defesa_liberar?projeto_id={$defesa->getProjetoId()}&liberado=true");
    $urlDisapprove = url_for("@defesa_liberar?projeto_id={$defesa->getProjetoId()}&liberado=false");
    $urlConclude = url_for("@defesa_concluir?projeto_id={$defesa->getProjetoId()}&concluido=true");

    return $this->renderText(json_encode(array(
        'title' => $defesa->getProjeto()->getTitulo(),
        'urlApprove' => $urlApprove,
        'urlDisapprove' => $urlDisapprove,
        'urlConclude' => $urlConclude,
        'semestreId' => $defesa->getProjeto()->getSemestreId()
    )));
  }
	
	public function executeDocumentofinal(sfWebRequest $request)
	{
		$this->form = new DocumentoFinalForm();
		$this->validateProject($request);
		$this->maxFileSize = Util::getMaxFilesize(); 
		
		if($request->isMethod('post')){
      $formData = $request->getParameter('documento');
      $formFiles = $request->getFiles();	
			$formFiles = $formFiles['documento'];		
			
			$this->form->bind($formData, $formFiles);
			if($this->form->isValid()){
	      $file = $formFiles['documento_final'];
	      $this->saveFile($file);
	      $filename = $this->createFullFilename($file);
				
				$defesa = DefesaTable::getInstance()->findByProjetoId($this->projetoId);
				$defesa->setDocumentoFinal($filename);
				$defesa->save();
				
	      $this->setMessage('notice', 'Documento final adicionado com sucesso.');
	      $this->redirect('projeto/index');				
			}
		}
	}

  //TODO: este método pode ser refatorado para remover duplicação entre proposta e defesa
  protected function  getComments() {
    $defesa = $this->getWorkingEntity($this->projetoId);
    return ComentarioTable::getInstance()->findByDefesaId($defesa->getId());
  }

  protected function getWorkingEntity($projeto_id){
    if($this->workingEntity == null || $this->workingEntity->getProjetoId() != $projeto_id){
      $projeto = ProjetoTable::getInstance()->find($projeto_id);
      if($projeto->hasDefesa()){
        $this->workingEntity = $projeto->getDefesa();
      }else{
        $defesa = new Defesa();
        $defesa->setProjeto($projeto);
        $defesa->save();

        $this->workingEntity = $defesa;
      }
    }
    return $this->workingEntity;
  }

  protected function notifyOrientador(){
    $this->notifyPeople('DefesaRequisitada');
  }

  protected function notifyComissao(){
    $this->notifyPeople('DefesaAprovada');
  }

  protected function notifyEstudante(){
    $this->notifyPeople('DefesaReprovada');
  }

  protected function notifyEstudanteOrientador($approved = true){
    if($approved){
      $this->notifyPeople('DefesaLiberada');
    }else{
      $this->notifyPeople('DefesaNaoLiberada');
    }
  }

}
