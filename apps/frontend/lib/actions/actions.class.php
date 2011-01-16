<?php
/**
 * Actions de CRUD padrão
 */
abstract class monomActions extends sfActions{
  protected $workingEntity = null;

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $id = $request->getParameter('id');
    $this->loadForm($id);

    if($request->isMethod('post')){
      $entityName = $this->getEntityClassName();
      $formData = $request->getParameter($entityName);
      $formFiles = $request->getFiles();
      $this->saveForm($formData, $formFiles);
    }

    $this->list = $this->getTable()->findAll();
  }

  protected function saveForm($formData, $formFiles){
    $this->form->bind($formData, $formFiles);
    if($this->form->isValid()){
      $this->form->save();
      $this->form = $this->createForm();
      $this->setMessage('notice', 'Dados salvos com sucesso.');
    }
  }

  protected function loadForm($id){
    $entity = null;
    if(is_numeric($id) && $this->entityExists($id)){
      $entity = $this->getWorkingEntity($id);
    }
    $this->form = $this->createForm($entity);
  }

  public function executeExcluir(sfWebRequest $request)
  {
    $id = $request->getParameter('id');
    $this->forward404Unless($this->entityExists($id));
    $successfullyDeleted = $this->deleteEntity($id);
    if($successfullyDeleted){
      $this->setMessage('notice', 'Exclusão realizada com sucesso.');
    }else{
      $this->setMessage('error', 'Houve um problem ao realizar a exclusão.');
    }

    $this->redirect($this->getModuleName() . "/index");
  }

  public function prepareDownload($outFilename)
  {
    $response = $this->getResponse();
    
    $response->clearHttpHeaders();
    $response->setHttpHeader('Pragma: public', true);
    $response->setContentType('application/pdf');
    $response->setHttpHeader('Content-Disposition', 'attachment; filename="'. basename($outFilename).'"');
    $response->setHttpHeader('Content-Length', filesize($outFilename));
    $response->sendHttpHeaders();
  }

  protected function getWorkingEntity($id){
    if($this->workingEntity == null || $this->workingEntity->getId() != $id){
      $this->workingEntity = $this->getTable()->findOneById($id);
    }
    return $this->workingEntity;
  }

  protected function entityExists($id){
    $entity = $this->getWorkingEntity($id);
    return ($entity != null && $entity->exists());
  }

  /*
   * Deleta uma entidade
   * @return boolean true se deletou com sucesso
   */
  protected function deleteEntity($id){
    $entity = $this->getWorkingEntity($id);
    return $entity->delete();
  }

  protected function getEntityClassName(){
    return $this->getModuleName();
  }

  protected function getFormClassName(){
    $entityName = $this->getEntityClassName();
    $formName = $entityName . "Form";
    return $formName;
  }

  protected function getEntityTableName(){
    return $this->getEntityClassName() . "Table";
  }

  protected function getTable(){
    $tableName = $this->getEntityTableName();
    return $tableName::getInstance();
  }

  protected function createForm($data = null){
    $formName = $this->getFormClassName();
    return new $formName($data);
  }

  protected function setMessage($name, $value){
    $this->getUser()->setFlash($name, $value);
  }

}