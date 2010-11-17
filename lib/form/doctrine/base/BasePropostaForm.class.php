<?php

/**
 * Proposta form base class.
 *
 * @method Proposta getObject() Returns the current form's model object
 *
 * @package    monomanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePropostaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'projeto_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projeto'), 'add_empty' => false)),
      'status'         => new sfWidgetFormInputText(),
      'comentarios'    => new sfWidgetFormTextarea(),
      'data_submissao' => new sfWidgetFormDate(),
      'data_feedback'  => new sfWidgetFormDate(),
      'documento'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'projeto_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projeto'))),
      'status'         => new sfValidatorInteger(array('required' => false)),
      'comentarios'    => new sfValidatorString(array('required' => false)),
      'data_submissao' => new sfValidatorDate(array('required' => false)),
      'data_feedback'  => new sfValidatorDate(array('required' => false)),
      'documento'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('proposta[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Proposta';
  }

}
