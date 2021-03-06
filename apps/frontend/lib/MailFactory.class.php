<?php
/**
 * @author wesley
 */
class MailFactory {
  public function __construct(sfAction $action){
    $this->action = $action;
  }

  public function createMessagePropostaEnviada(Projeto $projeto){
    $params = array(
        'nomeOrientador' => $projeto->getProfessor()->getUsuario()->getFullname(),
        'nomeEstudante'  => $projeto->getEstudante()->getUsuario()->getFullname(),
        'tituloProjeto'  => $projeto->getTitulo()
    );

    $mailOrientador = $projeto->getProfessor()->getUsuario()->getEmailAddress();
    $mailSender = sfConfig::get('app_mail_sender');

    $subject = 'TCC-Manager - Nova proposta enviada';
    $body = $this->action->getPartial('mail/propostaEnviada', $params);

    $message = new Swift_Message($subject, $body, 'text/html', 'utf-8');
    $message->setTo($mailOrientador);
    $message->setSender($mailSender);

    return $message;
  }

  public function createMessagePropostaAprovada(Projeto $projeto){
    $params = array(
        'nomeOrientador' => $projeto->getProfessor()->getUsuario()->getFullname(),
        'nomeEstudante'  => $projeto->getEstudante()->getUsuario()->getFullname(),
        'tituloProjeto'  => $projeto->getTitulo()
    );

    $mailComissao = ProfessorTable::getInstance()->findEmailsComissao();
    $mailSender = sfConfig::get('app_mail_sender');

    $subject = 'TCC-Manager - Nova proposta aprovada';
    $body = $this->action->getPartial('mail/propostaAprovada', $params);

    $message = new Swift_Message($subject, $body, 'text/html', 'utf-8');
    $message->setTo($mailComissao);
    $message->setSender($mailSender);

    return $message;
  }

  public function createMessagePropostaReprovada(Projeto $projeto){
    $params = array(
        'nomeOrientador' => $projeto->getProfessor()->getUsuario()->getFullname(),
        'tituloProjeto'  => $projeto->getTitulo()
    );

    $mailEstudante = $projeto->getEstudante()->getUsuario()->getEmailAddress();
    $mailSender = sfConfig::get('app_mail_sender');

    $subject = 'TCC-Manager - Sua proposta foi reprovada';
    $body = $this->action->getPartial('mail/propostaReprovada', $params);

    $message = new Swift_Message($subject, $body, 'text/html', 'utf-8');
    $message->setTo($mailEstudante);
    $message->setSender($mailSender);

    return $message;
  }


  public function createMessagePropostaLiberada(Projeto $projeto){
    $params = array(
        'nomeEstudante' => $projeto->getEstudante()->getUsuario()->getFullname(),
        'tituloProjeto'  => $projeto->getTitulo()
    );

    $mailEstudante = $projeto->getEstudante()->getUsuario()->getEmailAddress();
    $mailOrientador = $projeto->getProfessor()->getUsuario()->getEmailAddress();
    $emails = array($mailEstudante, $mailOrientador);

    $subject = 'TCC-Manager - Proposta aprovada pela comissão';
    $body = $this->action->getPartial('mail/propostaLiberada', $params);

    $message = $this->createMessage($subject, $body, $emails);
    return $message;

  }

  public function createMessagePropostaNaoLiberada(Projeto $projeto){
    $params = array(
        'nomeEstudante' => $projeto->getEstudante()->getUsuario()->getFullname(),
        'tituloProjeto'  => $projeto->getTitulo()
    );

    $mailEstudante = $projeto->getEstudante()->getUsuario()->getEmailAddress();
    $mailOrientador = $projeto->getProfessor()->getUsuario()->getEmailAddress();
    $emails = array($mailEstudante, $mailOrientador);

    $subject = 'TCC-Manager - Proposta reprovada pela comissão';
    $body = $this->action->getPartial('mail/propostaNaoLiberada', $params);

    $message = $this->createMessage($subject, $body, $emails);
    return $message;
  }

  public function createMessageDefesaRequisitada(Projeto $projeto){
    $params = array(
        'nomeOrientador' => $projeto->getProfessor()->getUsuario()->getFullname(),
        'nomeEstudante'  => $projeto->getEstudante()->getUsuario()->getFullname(),
        'tituloProjeto'  => $projeto->getTitulo()
    );

    $mailOrientador = $projeto->getProfessor()->getUsuario()->getEmailAddress();
    $mailSender = sfConfig::get('app_mail_sender');

    $subject = 'TCC-Manager - Nova defesa requisitada';
    $body = $this->action->getPartial('mail/defesaRequisitada', $params);

    $message = new Swift_Message($subject, $body, 'text/html', 'utf-8');
    $message->setTo($mailOrientador);
    $message->setSender($mailSender);

    return $message;
  }

  public function createMessageDefesaAprovada(Projeto $projeto){
    $params = array(
        'nomeOrientador' => $projeto->getProfessor()->getUsuario()->getFullname(),
        'nomeEstudante'  => $projeto->getEstudante()->getUsuario()->getFullname(),
        'tituloProjeto'  => $projeto->getTitulo()
    );

    $mailComissao = ProfessorTable::getInstance()->findEmailsComissao();
    $mailSender = sfConfig::get('app_mail_sender');

    $subject = 'TCC-Manager - Nova defesa aprovada';
    $body = $this->action->getPartial('mail/defesaAprovada', $params);

    $message = new Swift_Message($subject, $body, 'text/html', 'utf-8');
    $message->setTo($mailComissao);
    $message->setSender($mailSender);

    return $message;
  }

  public function createMessageDefesaReprovada(Projeto $projeto){
    $params = array(
        'nomeOrientador' => $projeto->getProfessor()->getUsuario()->getFullname(),
        'tituloProjeto'  => $projeto->getTitulo()
    );

    $mailEstudante = $projeto->getEstudante()->getUsuario()->getEmailAddress();
    $mailSender = sfConfig::get('app_mail_sender');

    $subject = 'TCC-Manager - Sua defesa foi reprovada';
    $body = $this->action->getPartial('mail/defesaReprovada', $params);

    $message = new Swift_Message($subject, $body, 'text/html', 'utf-8');
    $message->setTo($mailEstudante);
    $message->setSender($mailSender);

    return $message;
  }


  public function createMessageDefesaLiberada(Projeto $projeto){
    $params = array(
        'nomeEstudante' => $projeto->getEstudante()->getUsuario()->getFullname(),
        'tituloProjeto'  => $projeto->getTitulo()
    );

    $mailEstudante = $projeto->getEstudante()->getUsuario()->getEmailAddress();
    $mailOrientador = $projeto->getProfessor()->getUsuario()->getEmailAddress();
    $emails = array($mailEstudante, $mailOrientador);

    $subject = 'TCC-Manager - Defesa aprovada pela comissão';
    $body = $this->action->getPartial('mail/defesaLiberada', $params);

    $message = $this->createMessage($subject, $body, $emails);
    return $message;

  }

  public function createMessageDefesaNaoLiberada(Projeto $projeto){
    $params = array(
        'nomeEstudante' => $projeto->getEstudante()->getUsuario()->getFullname(),
        'tituloProjeto'  => $projeto->getTitulo()
    );

    $mailEstudante = $projeto->getEstudante()->getUsuario()->getEmailAddress();
    $mailOrientador = $projeto->getProfessor()->getUsuario()->getEmailAddress();
    $emails = array($mailEstudante, $mailOrientador);

    $subject = 'TCC-Manager - Defesa reprovada pela comissão';
    $body = $this->action->getPartial('mail/defesaNaoLiberada', $params);

    $message = $this->createMessage($subject, $body, $emails);
    return $message;
  }
  
  public function createMessageNovoUsuario($nome, $login, $senha, $email){
    $params = array(
        'nomeEstudante' => $nome,
        'login'  => $login,
        'senha' => $senha
    );

    $emails = array($email);

    $subject = 'TCC-Manager - Novo usuário';
    $body = $this->action->getPartial('mail/novoUsuario', $params);

    $message = $this->createMessage($subject, $body, $emails);
    return $message;
  }  

  protected function createMessage($subject, $body, $to){
    $mailSender = sfConfig::get('app_mail_sender');

    $message = new Swift_Message($subject, $body, 'text/html', 'utf-8');
    $message->setTo($to);
    $message->setSender($mailSender);

    return $message;
  }

}
