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
    $this->maxFileSize = PropostaForm::getMaxFilesize();
    $this->validateProject($request);
    $this->loadForm($this->projetoId);

    if($request->isMethod('post')){
      $entityName = $this->getEntityClassName();
      $formData = $request->getParameter($entityName);
      $formFiles = $request->getFiles();
      $this->saveForm($formData, $formFiles);
    }
  }

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

  public function executeList(sfWebRequest $request)
  {
    $this->user = $this->getUser();
    if($this->user->isSuperAdmin()){
      $this->list = $this->getTable()->findAll();
    }elseif($this->user->isComissao()){
      $this->list = $this->getTable()->createNamedQuery('find.all.visible.by.comission')->execute();
    }elseif($this->user->isProfessor()){
      $this->list = $this->getTable()->createNamedQuery('find.all.with.attached.documents')->execute();
    }else{
      $this->forward404('Você não tem permissão para visualizar esta página');
    }
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

  public function executeComments(sfWebRequest $request)
  {
    $this->validateProject($request);

    $comments = ComentarioTable::getInstance()->findByPropostaId($this->projetoId);
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

  protected function validateProject(sfWebRequest $request){
    $this->projetoId = $request->getParameter('projeto_id');
    if(!is_numeric($this->projetoId) || !ProjetoTable::getInstance()->exists($this->projetoId)){
      $this->forward404("Projeto inexistente");
    }
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

  protected function notifyEstudanteOrientador($approved = true){
    $projeto = ProjetoTable::getInstance()->find($this->projetoId);

    $mail = new MailFactory($this);

    if($approved){
      $message = $mail->createMessagePropostaLiberada($projeto);
    }else{
      $message = $mail->createMessagePropostaNaoLiberada($projeto);
    }

    $this->getMailer()->send($message);
  }


}
