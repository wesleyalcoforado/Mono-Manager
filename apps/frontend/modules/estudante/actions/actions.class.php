<?php

/**
 * estudante actions.
 *
 * @package    monomanager
 * @subpackage estudante
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class estudanteActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $this->form = new UsuarioEstudanteForm();

      if($request->isMethod('post')){
          $this->form->bind($request->getParameter('usuario'));
          if($this->form->isValid()){
              $this->form->save();
              $this->form->resetFormFields();
          }
      }

      $this->estudantes = EstudanteTable::getInstance()->findAll();
  }
}
