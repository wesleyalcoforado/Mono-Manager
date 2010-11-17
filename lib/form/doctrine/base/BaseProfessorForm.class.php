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
      'usuario_id'  => new sfWidgetFormInputHidden(),
      'instituicao' => new sfWidgetFormInputText(),
      'titulacao'   => new sfWidgetFormInputText(),
      'experiencia' => new sfWidgetFormInputText(),
      'substituto'  => new sfWidgetFormInputCheckbox(),
      'comissao'    => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'usuario_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('usuario_id')), 'empty_value' => $this->getObject()->get('usuario_id'), 'required' => false)),
      'instituicao' => new sfValidatorString(array('max_length' => 255)),
      'titulacao'   => new sfValidatorString(array('max_length' => 30)),
      'experiencia' => new sfValidatorInteger(array('required' => false)),
      'substituto'  => new sfValidatorBoolean(array('required' => false)),
      'comissao'    => new sfValidatorBoolean(array('required' => false)),
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
