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

    $subject = 'Mono-Manager - Nova proposta enviada';
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

    $subject = 'Mono-Manager - Nova proposta aprovada';
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

    $subject = 'Mono-Manager - Sua proposta foi reprovada';
    $body = $this->action->getPartial('mail/propostaReprovada', $params);

    $message = new Swift_Message($subject, $body, 'text/html', 'utf-8');
    $message->setTo($mailEstudante);
    $message->setSender($mailSender);

    return $message;
  }

}
