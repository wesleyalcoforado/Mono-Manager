<?php
/**
 * proposta actions.
 *
 * @package    monomanager
 * @subpackage proposta
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class propostaActions extends monomActions
{

  public function executeIndex(sfWebRequest $request)
  {
    $projeto_id = $request->getParameter('projeto_id');
    $this->projetoId = $projeto_id;
    $this->maxFileSize = PropostaForm::getMaxFilesize();

    if(!is_numeric($projeto_id) || !ProjetoTable::getInstance()->exists($projeto_id)){
      $this->forward404("Projeto inexistente");
    }

    $this->loadForm($projeto_id);

    if($request->isMethod('post')){
      $entityName = $this->getEntityClassName();
      $formData = $request->getParameter($entityName);
      $formFiles = $request->getFiles();
      $this->saveForm($formData, $formFiles);
    }
  }

  public function executeDownload(sfWebRequest $request)
  {
    $projeto_id = $request->getParameter('projeto_id');
    if(!is_numeric($projeto_id) || !ProjetoTable::getInstance()->exists($projeto_id)){
      $this->forward404("Projeto inexistente");
    }

    $proposta = $this->getWorkingEntity($projeto_id);
    if(!file_exists($proposta->getDocumento())){
      $this->forward404("Documento inexistente");
    }

    $file = $proposta->getDocumento();

    $this->prepareDownload($file);
    readfile($file);

    return sfView::NONE;
  }

  public function executeList(sfWebRequest $request)
  {
    $this->list = $this->getTable()->findAll();
    $this->user = $this->getUser();
  }

  public function executeAprovar(sfWebRequest $request)
  {
    $projeto_id = $request->getParameter('projeto_id');
    $this->projetoId = $projeto_id;
    if(!is_numeric($projeto_id) || !ProjetoTable::getInstance()->exists($projeto_id)){
      $this->forward404("Projeto inexistente");
    }

    $aprovado = $request->getParameter('aprovado');
    $proposta = $this->getWorkingEntity($projeto_id);
    if($proposta->getStatus() == Proposta::NAO_ANALISADO){
      if($aprovado == 'true'){
        $proposta->setStatus(Proposta::APROVADO);
        $this->notifyComissao();
      }else{
        $proposta->setStatus(Proposta::REPROVADO);
        $this->notifyEstudante();
      }
      $proposta->save();
    }else{
      $this->setMessage('error', 'A proposta já foi analisada.');
    }
    $this->redirect($this->getModuleName() . "/list");
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
      $proposta->setDataSubmissao(date('Y-m-d H:i:s'));
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

  public function executeExcluir(sfWebRequest $request){
    $this->forward404();
  }

  protected function saveFile($file){
    $destinationFilename = $this->createFullFilename($file);
    if(file_exists($destinationFilename)){
      unlink($destinationFilename);
    }

    move_uploaded_file($file['tmp_name'], $destinationFilename);
  }

  protected function createFullFilename($file){
    $uploadDir = sfConfig::get('sf_upload_dir');
    $name = 'proposta_[projeto_' . $this->form->getObject()->getProjetoId() . ']';
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

    $nomeArquivo = $uploadDir . '/' . $name . '.' . $extension;
    return $nomeArquivo;
  }

  protected function notifyOrientador(){
    $projeto = ProjetoTable::getInstance()->find($this->projetoId);

    $mail = new MailFactory($this);
    $message = $mail->createMessagePropostaEnviada($projeto);

    $this->getMailer()->send($message);
  }

  protected function notifyComissao(){
    $projeto = ProjetoTable::getInstance()->find($this->projetoId);

    $mail = new MailFactory($this);
    $message = $mail->createMessagePropostaAprovada($projeto);

    $this->getMailer()->send($message);
  }

  protected function notifyEstudante(){
    $projeto = ProjetoTable::getInstance()->find($this->projetoId);

    $mail = new MailFactory($this);
    $message = $mail->createMessagePropostaReprovada($projeto);

    $this->getMailer()->send($message);
  }

}
