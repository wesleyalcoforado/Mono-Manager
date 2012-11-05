<?php

/**
 * Usuario
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    monomanager
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Usuario extends BaseUsuario
{
  const ESTUDANTE = 'estudante';
  const PROFESSOR = 'professor';
  const COMISSAO = 'comissao';
  const ADMIN = 'admin';

  public function getFullname(){
    return $this->getFirstName() . " " . $this->getLastName();
  }

  public static function parseUser(sfGuardUser $user){
    $usuario = UsuarioTable::getInstance()->find($user->getId());
    return $usuario;
  }

  public function isEstudante(){
    return (boolean)$this->getEstudante()->exists();
  }

  public function isProfessor(){
    return (boolean)$this->getProfessor()->exists();
  }

  public function isComissao(){
    if($this->isProfessor()){
      return $this->getProfessor()->isComissao();
    }
    return false;
  }

  public function isSubstituto(){
    if($this->isProfessor()){
      return $this->getProfessor()->isSubstituto();
    }
    return false;
  }
  
  public function getPerfil(){
    $perfil = $this->getAttribute("perfil");
    if(!$perfil){
      if($this->isSuperAdmin()){
        $perfil = Usuario::ADMIN;
      }else if($this->isEstudante()){
        $perfil = Usuario::ESTUDANTE;
      }else if($this->isComissao()){
        $perfil = Usuario::COMISSAO;
      }else if($this->isProfessor()){
        $perfil = Usuario::PROFESSOR;
      }
    }
    return $perfil;
  }
  
  
  public function setPerfil($perfil){
    if($perfil == Usuario::ADMIN && $this->isSuperAdmin()){
      $user->setAttribute("perfil", Usuario::ADMIN);
    }else if($perfil == Usuario::PROFESSOR && $this->isProfessor()){
      $user->setAttribute("perfil", Usuario::PROFESSOR);
    }else if($perfil == Usuario::COMISSAO && $this->isComissao()){
      $user->setAttribute("perfil", Usuario::COMISSAO);
    }
  }

}
