<?php
/**
 * Actions de entidades que lidam com documentos
 */
abstract class documentoActions extends monomActions{

  public function executeIndex(sfWebRequest $request)
  {
    $this->maxFileSize = Util::getMaxFilesize();
    $this->validateProject($request);
    $this->loadForm($this->projetoId);

    if($request->isMethod('post')){
      $entityName = $this->getEntityClassName();
      $formData = $request->getParameter($entityName);
      $formFiles = $request->getFiles();
      $this->saveForm($formData, $formFiles);
    }
  }

  public function executeList(sfWebRequest $request)
  {
    $this->user = $this->getUser();
    if($this->user->isSuperAdmin()){
      $this->list = $this->getTable()->findAll();
    }elseif($this->user->isComissao()){
      $this->list = $this->getTable()->createNamedQuery('find.all.visible.by.comission')->execute();
    }elseif($this->user->isProfessor()){
      $this->list = $this->getTable()->createNamedQuery('find.all.visible.by.professor')->execute();
    }else{
      $this->forward404('Você não tem permissão para visualizar esta página');
    }
  }

  protected function validateProject(sfWebRequest $request){
    $this->projetoId = $request->getParameter('projeto_id');
    if(!is_numeric($this->projetoId) || !ProjetoTable::getInstance()->exists($this->projetoId)){
      $this->forward404("Projeto inexistente");
    }
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

  public function executeComments(sfWebRequest $request)
  {
    $this->validateProject($request);

    $comments = $this->getComments();
    $arrComments = array();
    foreach($comments as $com){
      $text = trim($com->getComentario());

      if($text){
        $arrComments[] = array(
            'positive' => $com->getLiberado(),
            'text' => $text
        );
      }
    }

    return $this->renderText(json_encode($arrComments));
  }

  protected abstract function getComments();

  protected function createFullFilename($file){
    $uploadDir = sfConfig::get('sf_upload_dir');

    $entity = $this->getEntityClassName();
    $name = $entity . '_[projeto_' . $this->form->getObject()->getProjetoId() . ']';
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

    $nomeArquivo = $uploadDir . '/' . $name . '.' . $extension;
    return $nomeArquivo;
  }

  protected function notifyPeople($message){
    $projeto = ProjetoTable::getInstance()->find($this->projetoId);

    $mail = new MailFactory($this);
    $message = call_user_func(array($mail, "createMessage$message"), $projeto);

    try{
      @$this->getMailer()->send($message);
    }catch(Exception $e){
      $this->setMessage('error', 'Ocorreu um erro durante o envio de email.');
    }

  }

}