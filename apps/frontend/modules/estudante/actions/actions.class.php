<?php

/**
 * estudante actions.
 *
 * @package    monomanager
 * @subpackage estudante
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class estudanteActions extends monomActions
{

  protected function getFormClassName() {
    return "UsuarioEstudanteForm";
  }  
  
  protected function saveForm($formData, $formFiles){
    $this->form->bind($formData, $formFiles);
    if($this->form->isValid()){
      //se o ID esta vazio, o usuario é novo, notificá-lo da criação
      if(empty($formData['id'])){
        $usuario = $formData['username'];
        $senha = $formData['password'];
        $nome = $formData['first_name'] . ' ' . $formData['last_name'];
        $email = $formData['email_address'];
        
        $mail = new MailFactory($this);
        $message = $mail->createMessageNovoUsuario($nome, $usuario, $senha, $email);
        
        try{
          @$this->getMailer()->send($message);
        }catch(Exception $e){
          $this->setMessage('error', 'Ocorreu um erro durante o envio de email.');
        }        
      }
      $this->form->save();
      $this->form = $this->createForm();
      $this->setMessage('notice', 'Dados salvos com sucesso.');
    }
  }

}
