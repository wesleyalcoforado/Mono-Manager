<?php

/**
 * Semestre form base class.
 *
 * @method Semestre getObject() Returns the current form's model object
 *
 * @package    monomanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSemestreForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'nome'              => new sfWidgetFormInputText(),
      'data_inicio'       => new sfWidgetFormDate(),
      'data_proposta'     => new sfWidgetFormDate(),
      'data_apresentacao' => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nome'              => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'data_inicio'       => new sfValidatorDate(array('required' => false)),
      'data_proposta'     => new sfValidatorDate(array('required' => false)),
      'data_apresentacao' => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('semestre[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Semestre';
  }

}
