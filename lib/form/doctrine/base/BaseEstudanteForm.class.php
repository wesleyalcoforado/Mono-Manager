<?php

/**
 * Estudante form base class.
 *
 * @method Estudante getObject() Returns the current form's model object
 *
 * @package    monomanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstudanteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'usuario_id' => new sfWidgetFormInputHidden(),
      'matricula'  => new sfWidgetFormInputText(),
      'telefone'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'usuario_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('usuario_id')), 'empty_value' => $this->getObject()->get('usuario_id'), 'required' => false)),
      'matricula'  => new sfValidatorString(array('max_length' => 20)),
      'telefone'   => new sfValidatorString(array('max_length' => 14, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estudante[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estudante';
  }

}
