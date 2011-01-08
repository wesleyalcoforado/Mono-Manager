<?php

/**
 * Usuario form.
 *
 * @package    monomanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UsuarioForm extends BaseUsuarioForm
{
  /**
   * @see sfGuardUserForm
   */
  public function configure()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'username'         => new sfWidgetFormInputText(),
      'first_name'       => new sfWidgetFormInputText(),
      'last_name'        => new sfWidgetFormInputText(),
      'email_address'    => new sfWidgetFormInputText(),
      'password'         => new sfWidgetFormInputPassword(),
      'is_active'        => new sfWidgetFormInputCheckbox(),
      'is_super_admin'   => new sfWidgetFormInputCheckbox()
    ));

    $this->setValidators(array(
      'password' => new sfValidatorString(),
      'email_address' => new sfValidatorEmail()
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'username'         => new sfValidatorString(array('max_length' => 128)),
      'first_name'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'last_name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email_address'    => new sfValidatorEmail(array('max_length' => 255)),
      'password'         => new sfValidatorString(array('max_length' => 128)),
      'is_active'        => new sfValidatorBoolean(array('required' => false)),
      'is_super_admin'   => new sfValidatorBoolean(array('required' => false))
    ));

    $this->widgetSchema['username']->setLabel('Nome de usuário');
    $this->widgetSchema['first_name']->setLabel('Nome');
    $this->widgetSchema['last_name']->setLabel('Sobrenome');
    $this->widgetSchema['password']->setLabel('Senha');
    $this->widgetSchema['email_address']->setLabel('Email');
    $this->widgetSchema['is_active']->setLabel('Ativo?');
    $this->widgetSchema['is_super_admin']->setLabel('Superusuário?');

    $this->widgetSchema->setFormFormatterName('deflist');
    
    parent::configure();
  }
}
