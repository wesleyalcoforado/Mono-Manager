<?php

class myUser extends sfGuardSecurityUser
{

  public function signIn($user, $remember = false, $con = null){
    parent::signIn($user, $remember, $con);
    $this->configCredentialsAccordingToUserType();
  }

  protected function configCredentialsAccordingToUserType(){
    if($this->isSuperAdmin()){
      $this->addCredential('admin');
    }else if($this->isEstudante()){
      $this->addCredential('estudante');
    }else if($this->isProfessor()){
      $this->addCredential('professor');
    }
  }

  public function isEstudante(){
    $usuario = $this->getUsuario();
    return $usuario ? $usuario->isEstudante() : false;
  }

  public function isComissao(){
    $usuario = $this->getUsuario();
    return $usuario ? $usuario->isComissao() : false;
  }

  public function isProfessor(){
    $usuario = $this->getUsuario();
    return $usuario ? $usuario->isProfessor() : false;
  }

  public function getUsuario(){
    if(!$this->getGuardUser()){
      return null;
    }

    return Usuario::parseUser($this->getGuardUser());
  }



}
