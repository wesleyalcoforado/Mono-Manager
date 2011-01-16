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

    $this->projetoId = $projeto_id;
    $this->maxFileSize = PropostaForm::getMaxFilesize();
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

  protected function saveForm($formData, $formFiles){
    $files = $formFiles['proposta'];

    $this->form->bind($formData, $files);
    if($this->form->isValid()){
      $file = $files['documento'];
      $this->saveFile($file);
      $filename = $this->createFullFilename($file);
      $proposta = $this->form->getObject();
      $proposta->setDocumento($filename);
      $proposta->save();
      $this->setMessage('notice', 'Proposta anexada com sucesso.');
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

}
