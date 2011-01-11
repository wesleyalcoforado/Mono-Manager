<?php

/**
 * Professor form.
 *
 * @package    monomanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProfessorForm extends BaseProfessorForm
{
  public function configure()
  {
    $this->widgetSchema->setFormFormatterName('divform');
    $this->widgetSchema['instituicao']->setLabel('Instituição');
    $this->widgetSchema['titulacao']->setLabel('Titulação');
    $this->widgetSchema['experiencia']->setLabel('Experiência');
    $this->widgetSchema['is_comissao']->setLabel('Comissão?');
    $this->widgetSchema['is_substituto']->setLabel('Substituto?');
  }
}
