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
    $generate = $request->hasParameter('gerar');
    if($generate){
      $filters = $request->getParameter('relatorio');
      $semestreId = $filters['semestre_id'];

      $results = ProjetoTable::getInstance()->generateConcluidosReport($semestreId);
      $this->reportRows = $results;

      $this->form = new RelatorioStatusForm($filters);
    }else{
      $this->form = new RelatorioStatusForm();
    }
  }

  public function executeConcluidos(sfWebRequest $request)
  {
    $generate = $request->hasParameter('gerar');
    if($generate){
      $filters = $request->getParameter('relatorio');
      $semestreId = $filters['semestre_id'];

      $results = ProjetoTable::getInstance()->generateDefendidosReport($semestreId);
      $this->reportRows = $results;

      $this->form = new RelatorioDefendidosForm($filters);
    }else{
      $this->form = new RelatorioDefendidosForm();
    }
  }

}
