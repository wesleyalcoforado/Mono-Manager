<?php

class notifyDelayingProjectsTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine')
    ));

    $this->namespace        = '';
    $this->name             = 'notifyDelayingProjects';
    $this->briefDescription = 'Notifica projetos atrasando.';
    $this->detailedDescription = <<<EOF
Notifica os responsáveis quando um projeto estiver atrasando.
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $allProjects = ProjetoTable::getInstance()->findAll();
    $delayingProjects = array();
    foreach($allProjects as $project){
      if($project->isDelaying()){
        $delayingProjects[] = $project;
      }
    }

    //agrupa por estudante e envia os projetos dele
    $arrProjetosPorEstudante = $this->groupByEstudante($delayingProjects);
    foreach($arrProjetosPorEstudante as $estudanteId => $projetos){
      $this->sendEmail($estudanteId, $projetos);
    }

    //agrupa por professor e envia os projetos dele
    $arrProjetosPorProfessor = $this->groupByProfessor($delayingProjects);
    foreach($arrProjetosPorEstudante as $professorId => $projetos){
      $this->sendEmail($professorId, $projetos);
    }

    //envia todos os projetos em atraso para a comissão
    $comissao = ProfessorTable::getInstance()->findByIsComissao(true);
    foreach($comissao as $professor){
      $this->sendEmail($professor->getId(), $delayingProjects);
    }


  }

  protected function groupByEstudante($delayingProjects){
    $arrEstudantes = array();
    foreach($delayingProjects as $project){
      $estudanteId = $project->getEstudanteId();
      if(!array_key_exists($estudanteId, $arrEstudantes)){
        $arrEstudantes[$estudanteId] = array();
      }

      $arrEstudantes[$estudanteId][] = $project;
    }

    return $arrEstudantes;
  }

  protected function groupByProfessor($delayingProjects){
    $arrProfessores = array();
    foreach($delayingProjects as $project){
      $professorId = $project->getProfessorId();
      if(!array_key_exists($professorId, $arrProfessores)){
        $arrProfessores[$professorId] = array();
      }

      $arrProfessores[$professorId][] = $project;
    }

    return $arrProfessores;
  }

  protected function sendEmail($userId, $arrProjects){
    $msg = "Existem projetos atrasando.<br/>";
    $msg .= "<ul>";
    foreach($arrProjects as $project){
      $msg .= "<li>{$project->getTitulo()}<br/>";
      $msg .= "Motivo do atraso: " . $project->reasonForDelay(Projeto::timeInAdvance());
      $msg .= "</li>";
    }
    $msg .= "</ul>";

    $to = UsuarioTable::getInstance()->find($userId)->getEmailAddress();

    $from = sfConfig::get('app_mail_sender');
    $subject = 'TCC-Manager - Projetos atrasando';
    $body = $msg;

    $message = $this->getMailer()->compose($from, $to, $subject);
    $message->setBody($body, "text/html");

    $this->getMailer()->send($message);
  }

}
