<?php

class UsuarioProfessorForm extends UsuarioForm
{
  public function configure()
  {
    parent::configure();
    $this->embedRelation('Professor');
    $this->widgetSchema->setNameFormat('usuario[%s]');
  }
}
