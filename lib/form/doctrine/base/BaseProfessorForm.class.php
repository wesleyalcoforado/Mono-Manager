<?php

/**
 * Professor form base class.
 *
 * @method Professor getObject() Returns the current form's model object
 *
 * @package    monomanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfessorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'instituicao'   => new sfWidgetFormInputText(),
      'titulacao'     => new sfWidgetFormInputText(),
      'experiencia'   => new sfWidgetFormInputText(),
      'is_substituto' => new sfWidgetFormInputCheckbox(),
      'is_comissao'   => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'instituicao'   => new sfValidatorString(array('max_length' => 255)),
      'titulacao'     => new sfValidatorString(array('max_length' => 255)),
      'experiencia'   => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'is_substituto' => new sfValidatorBoolean(array('required' => false)),
      'is_comissao'   => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('professor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Professor';
  }

}
