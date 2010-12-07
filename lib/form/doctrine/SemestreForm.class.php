<?php

/**
 * Semestre form.
 *
 * @package    monomanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SemestreForm extends BaseSemestreForm
{
  public function configure()
  {
      $this->widgetSchema->setFormFormatterName('deflist');

      $rangeYears = range(date('Y'), date('Y') + 10);
      $years = array_combine($rangeYears, $rangeYears);

      $this->getWidget('data_inicio')->setOption('format', '%day%/%month%/%year%');
      $this->getWidget('data_proposta')->setOption('format', '%day%/%month%/%year%');
      $this->getWidget('data_apresentacao')->setOption('format', '%day%/%month%/%year%');

      $this->getWidget('data_inicio')->setOption('years', $years);
      $this->getWidget('data_proposta')->setOption('years', $years);
      $this->getWidget('data_apresentacao')->setOption('years', $years);

      $this->getWidget('nome')->setAttribute('maxlength', 30);

      $this->getValidator('nome')->setOption('required', true);
      $this->getValidator('data_inicio')->setOption('required', true);
      $this->getValidator('data_proposta')->setOption('required', true);
      $this->getValidator('data_apresentacao')->setOption('required', true);

  }
}
