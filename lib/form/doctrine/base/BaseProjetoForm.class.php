<?php

/**
 * Projeto form base class.
 *
 * @method Projeto getObject() Returns the current form's model object
 *
 * @package    monomanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProjetoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'titulo'           => new sfWidgetFormInputText(),
      'estudante_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estudante'), 'add_empty' => false)),
      'professor_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Professor'), 'add_empty' => false)),
      'coorientadores'   => new sfWidgetFormInputText(),
      'data_requisicao'  => new sfWidgetFormDate(),
      'data_sugestao'    => new sfWidgetFormDate(),
      'data_aprovacao'   => new sfWidgetFormDate(),
      'data_autorizacao' => new sfWidgetFormDate(),
      'documento'        => new sfWidgetFormInputText(),
      'documento_final'  => new sfWidgetFormInputText(),
      'qtde_paginas'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'titulo'           => new sfValidatorString(array('max_length' => 255)),
      'estudante_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Estudante'))),
      'professor_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Professor'))),
      'coorientadores'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'data_requisicao'  => new sfValidatorDate(array('required' => false)),
      'data_sugestao'    => new sfValidatorDate(array('required' => false)),
      'data_aprovacao'   => new sfValidatorDate(array('required' => false)),
      'data_autorizacao' => new sfValidatorDate(array('required' => false)),
      'documento'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'documento_final'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'qtde_paginas'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('projeto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Projeto';
  }

}
