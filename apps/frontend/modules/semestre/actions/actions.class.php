<?php

/**
 * semestre actions.
 *
 * @package    monomanager
 * @subpackage semestre
 * @author     Wesley Alcofrado
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class semestreActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $this->form = new SemestreForm();

      if($request->isMethod('post')){
          $this->form->bind($request->getParameter('semestre'));
          if($this->form->isValid()){
              $this->form->save();
              $this->form->resetFormFields();
          }
      }

      $this->semestres = SemestreTable::getInstance()->findAll();
  }

}
