<?php
/**
 * proposta actions.
 *
 * @package    monomanager
 * @subpackage proposta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class propostaActions extends documentoActions
{

  public function executeDownload(sfWebRequest $request)
  {
    $this->validateProject($request);

    $proposta = $this->getWorkingEntity($this->projetoId);
    if(!file_exists($proposta->getDocumento())){
      $this->forward404("Documento inexistente");
    }

    $file = $proposta->getDocumento();

    $this->prepareDownload($file);
    readfile($file);

    return sfView::NONE;
  }

  public function executeAprovar(sfWebRequest $request)
  {
    $this->validateProject($request);

    $aprovado = $request->getParameter('aprovado');
    $proposta = $this->getWorkingEntity($this->projetoId);
    if($proposta->getStatus() == Proposta::NAO_ANALISADO){
      if($aprovado == 'true'){
        $proposta->setStatus(Proposta::APROVADO);
        $this->notifyComissao();
      }else{
        $proposta->setStatus(Proposta::REPROVADO);
        $this->notifyEstudante();
      }
      $proposta->setDataFeedbackOrientador(Util::currentDateInDBFormat());
      $proposta->save();
    }else{
      $this->setMessage('error', 'A proposta já foi analisada.');
    }
    $this->redirect($this->getModuleName() . "/list");
  }

  public function executeLiberar(sfWebRequest $request)
  {
    $this->validateProject($request);

    $approved = $request->getParameter('liberado') == 'true'? true : false;
    $comment = $request->getParameter('comentario');
    $proposta = $this->getWorkingEntity($this->projetoId);

    $professor = $this->getUser()->getUsuario()->getProfessor();
    $proposta->audit($professor, $approved, $comment);
    
    $this->notifyEstudanteOrientador($proposta->getStatus() == Proposta::LIBERADO);
    $this->redirect($this->getModuleName() . "/list");
  }

  public function executeInfo(sfWebRequest $request)
  {
    $this->validateProject($request);
    $proposta = $this->getWorkingEntity($this->projetoId);

    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
    $urlApprove = url_for("@proposta_liberar?projeto_id={$proposta->getProjetoId()}&liberado=true");
    $urlDisapprove = url_for("@proposta_liberar?projeto_id={$proposta->getProjetoId()}&liberado=false");

    return $this->renderText(json_encode(array(
        'title' => $proposta->getProjeto()->getTitulo(),
        'urlApprove' => $urlApprove,
        'urlDisapprove' => $urlDisapprove
    )));
  }

  protected function  getComments() {
    $proposta = $this->getWorkingEntity($this->projetoId);
    return ComentarioTable::getInstance()->findByPropostaId($proposta->getId());
  }

  protected function saveForm($formData, $formFiles){
    $files = $formFiles['proposta'];

    $this->form->bind($formData, $files);
    if($this->form->isValid()){
      $file = $files['documento'];
      $this->saveFile($file);
      $filename = $this->createFullFilename($file);
      $proposta = $this->form->getObject();
      $proposta->setDocumento($filename);
      $proposta->setDataSubmissao(Util::currentDateInDBFormat());
      $proposta->setStatus(Proposta::NAO_ANALISADO);
      $proposta->save();
      $this->setMessage('notice', 'Proposta anexada com sucesso.');
      $this->notifyOrientador();
      $this->redirect('projeto/index');
    }
  }

  protected function getWorkingEntity($projeto_id){
    if($this->workingEntity == null || $this->workingEntity->getProjetoId() != $projeto_id){
      $projeto = ProjetoTable::getInstance()->find($projeto_id);
      if($projeto->hasProposta()){
        $this->workingEntity = $projeto->getProposta();
      }else{
        $proposta = new Proposta();
        $proposta->setProjeto($projeto);
        $proposta->save();

        $this->workingEntity = $proposta;
      }
    }
    return $this->workingEntity;
  }

  protected function notifyOrientador(){
    $this->notifyPeople('PropostaEnviada');
  }

  protected function notifyComissao(){
    $this->notifyPeople('PropostaAprovada');
  }

  protected function notifyEstudante(){
    $this->notifyPeople('PropostaReprovada');
  }

  protected function notifyEstudanteOrientador($approved = true){
    if($approved){
      $this->notifyPeople('PropostaLiberada');
    }else{
      $this->notifyPeople('PropostaNaoLiberada');
    }
  }

}
