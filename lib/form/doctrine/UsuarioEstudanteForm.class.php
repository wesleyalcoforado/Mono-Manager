<?php

class UsuarioEstudanteForm extends UsuarioForm
{
  public function configure()
  {
    parent::configure();
    $this->widgetSchema['username']->setLabel('Matrícula');
    $this->embedRelation('Estudante');
    $this->widgetSchema->setNameFormat('usuario[%s]');
  }
}
