<?php

/**
 * relatorio actions.
 *
 * @package    monomanager
 * @subpackage relatorio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class relatorioActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  }

  public function executeStatus(sfWebRequest $request)
  {
    $this->form = new RelatorioStatusForm();

    $generate = $request->hasParameter('gerar');
    if($generate){
      $filters = $request->getParameter('relatorio');
      $estudanteId = $filters['estudante_id'];
      $professorId = $filters['professor_id'];
      $semestreId = $filters['semestre_id'];
      $status = $filters['status'];

      
    }
  }

  public function executeConcluidos(sfWebRequest $request)
  {
  }

}
