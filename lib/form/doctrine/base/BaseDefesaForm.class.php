<?php

/**
 * Defesa form base class.
 *
 * @method Defesa getObject() Returns the current form's model object
 *
 * @package    monomanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDefesaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'projeto_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projeto'), 'add_empty' => false)),
      'status'                   => new sfWidgetFormInputText(),
      'data_requisicao'          => new sfWidgetFormDate(),
      'data_feedback_orientador' => new sfWidgetFormDate(),
      'data_feedback_comissao'   => new sfWidgetFormDate(),
      'data_sugestao'            => new sfWidgetFormDate(),
      'data_autorizacao'         => new sfWidgetFormDate(),
      'documento'                => new sfWidgetFormInputText(),
      'documento_final'          => new sfWidgetFormInputText(),
      'qtde_paginas'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'projeto_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projeto'))),
      'status'                   => new sfValidatorInteger(array('required' => false)),
      'data_requisicao'          => new sfValidatorDate(array('required' => false)),
      'data_feedback_orientador' => new sfValidatorDate(array('required' => false)),
      'data_feedback_comissao'   => new sfValidatorDate(array('required' => false)),
      'data_sugestao'            => new sfValidatorDate(array('required' => false)),
      'data_autorizacao'         => new sfValidatorDate(array('required' => false)),
      'documento'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'documento_final'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'qtde_paginas'             => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('defesa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Defesa';
  }

}
