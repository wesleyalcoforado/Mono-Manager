<?php

/**
 * Projeto form.
 *
 * @package    monomanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ProjetoForm extends BaseProjetoForm
{
  public function configure()
  {
    $this->widgetSchema['titulo']->setLabel('Título');
    $this->widgetSchema['professor_id']->setLabel('Orientador');

    $this->widgetSchema['tipo_colacao'] = new sfWidgetFormChoice(array(
        'choices' => Semestre::$tiposColacao
    ));
    $this->widgetSchema['tipo_colacao']->setLabel('Tipo de colação');

    $this->widgetSchema->setFormFormatterName('divform');
  }
}
