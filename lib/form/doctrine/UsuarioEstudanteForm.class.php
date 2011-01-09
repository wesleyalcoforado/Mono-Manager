<?php

class UsuarioEstudanteForm extends UsuarioForm
{
  public function configure()
  {
    parent::configure();
    $this->widgetSchema['username']->setLabel('Matrícula');
    unset($this->widgetSchema['is_super_admin']);

    $this->embedRelation('Estudante');
    $this->widgetSchema->setNameFormat('estudante[%s]');
  }
}
