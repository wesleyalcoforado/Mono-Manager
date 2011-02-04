<?php

/**
 * Comentario form base class.
 *
 * @method Comentario getObject() Returns the current form's model object
 *
 * @package    monomanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseComentarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'comentario'   => new sfWidgetFormTextarea(),
      'liberado'     => new sfWidgetFormInputCheckbox(),
      'professor_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Professor'), 'add_empty' => false)),
      'proposta_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Proposta'), 'add_empty' => true)),
      'defesa_id'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'comentario'   => new sfValidatorString(array('required' => false)),
      'liberado'     => new sfValidatorBoolean(),
      'professor_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Professor'))),
      'proposta_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Proposta'), 'required' => false)),
      'defesa_id'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('comentario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comentario';
  }

}
