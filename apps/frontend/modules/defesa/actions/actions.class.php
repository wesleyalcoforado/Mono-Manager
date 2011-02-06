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
  

}
