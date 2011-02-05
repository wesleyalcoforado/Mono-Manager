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
      'id'             => new sfWidgetFormInputHidden(),
      'titulo'         => new sfWidgetFormInputText(),
      'estudante_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estudante'), 'add_empty' => false)),
      'professor_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Professor'), 'add_empty' => false)),
      'coorientadores' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'titulo'         => new sfValidatorString(array('max_length' => 255)),
      'estudante_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Estudante'))),
      'professor_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Professor'))),
      'coorientadores' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
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
