<?php

/**
 * default actions.
 *
 * @package    monomanager
 * @subpackage default
 * @author     wesley
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->nome = sfContext::getInstance()->getUser()->getUsuario()->getFirstName();
    $this->delayingProjects = $this->getDelayingProjects();
    $this->delayedProjects = $this->getDelayingProjects(true);
  }

  private function getDelayingProjects($delayed = false){
    $projetos = $this->getAllProjectsForThisUser();
    $arrProjetos = array();
    foreach($projetos as $projeto){
      if($delayed){
        if($projeto->isDelayed()){
          $arrProjetos[] = $projeto;
        }
      }else{
        if($projeto->isDelaying()){
          $arrProjetos[] = $projeto;
        }
      }
    }

    return $arrProjetos;
  }

  private function getAllProjectsForThisUser(){
    $userId = $this->getUser()->getUsuario()->getId();
    if($this->getUser()->isEstudante()){
      $projects = ProjetoTable::getInstance()->findByEstudante($userId);
    }else if($this->getUser()->isComissao() || $this->getUser()->isSuperAdmin()){
      $projects = ProjetoTable::getInstance()->findAll();
    }else if($this->getUser()->isProfessor()){
      $projects = ProjetoTable::getInstance()->findByProfessor($userId);
    }

    return $projects;
  }
  
  public function executePerfil(sfWebRequest $request)
  {
    $perfil = $request->getParameter("perfil");
    $user = $this->getUser()->getUsuario();
    $user->setPerfil($perfil);
    
    $this->redirect("index");
  }
}
