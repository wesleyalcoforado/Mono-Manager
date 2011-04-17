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
      'id'                         => new sfWidgetFormInputHidden(),
      'nome'                       => new sfWidgetFormInputText(),
      'data_colacao'               => new sfWidgetFormDate(),
      'data_max_proposta'          => new sfWidgetFormDate(),
      'data_max_copiao'            => new sfWidgetFormDate(),
      'data_max_defesa'            => new sfWidgetFormDate(),
      'data_colacao_especial'      => new sfWidgetFormDate(),
      'data_max_proposta_especial' => new sfWidgetFormDate(),
      'data_max_copiao_especial'   => new sfWidgetFormDate(),
      'data_max_defesa_especial'   => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nome'                       => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'data_colacao'               => new sfValidatorDate(array('required' => false)),
      'data_max_proposta'          => new sfValidatorDate(array('required' => false)),
      'data_max_copiao'            => new sfValidatorDate(array('required' => false)),
      'data_max_defesa'            => new sfValidatorDate(array('required' => false)),
      'data_colacao_especial'      => new sfValidatorDate(array('required' => false)),
      'data_max_proposta_especial' => new sfValidatorDate(array('required' => false)),
      'data_max_copiao_especial'   => new sfValidatorDate(array('required' => false)),
      'data_max_defesa_especial'   => new sfValidatorDate(array('required' => false)),
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
