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
    $this->widgetSchema->setFormFormatterName('deflist');
  }
}
