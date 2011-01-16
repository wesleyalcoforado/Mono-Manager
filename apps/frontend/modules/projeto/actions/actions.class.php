<?php

/**
 * projeto actions.
 *
 * @package    monomanager
 * @subpackage projeto
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class projetoActions extends monomActions
{
  protected function saveForm($formData, $formFiles){
    //TODO: estudante fake, trocar pelo verdadeiro qdo aplicação estiver pronta para isso
    $user = EstudanteTable::getInstance()->findAll()->getFirst();

    $formIsNew = !$this->form->getObject()->exists();
    if($formIsNew){
      $formData['estudante_id'] = $user->getId();
    }else{
      $formData['estudante_id'] = $this->form->getObject()->getEstudante()->getId();
    }

    $this->form->bind($formData);
    if($this->form->isValid()){
      $this->form->save();
      $this->form = $this->createForm();
      $this->setMessage('notice', 'Dados salvos com sucesso.');
    }
  }

}
