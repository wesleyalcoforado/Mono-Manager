<?php

/**
 * Defesa form.
 *
 * @package    monomanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DefesaForm extends BaseDefesaForm
{
  public function configure()
  {
    //TODO: Restringir projetos aos que o usuário possui, exceto se for adminsiostrador
    $this->setWidgets(array(
      'projeto_id'     => new sfWidgetFormInputHidden(),
      'documento'      => new sfWidgetFormInputFile(),
      'data_sugestao'            => new sfWidgetFormDate(),
      'qtde_paginas'             => new sfWidgetFormInputText()
    ));

    $this->getWidget('data_sugestao')->setOption('format', '%day%%month%%year%');

    $this->setValidators(array(
      'projeto_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projeto'))),
      'documento'      => new sfValidatorFile(array(
          'mime_types' => array('application/pdf'),
          'max_size'   => Util::getMaxFilesize()
      ), array(
          'mime_types' => 'Apenas arquivos PDF são aceitos',
          'max_size'   => "O tamanho do arquivo ultrapassa o limite permitido ({%max_size%} bytes)"
      )),
      'data_sugestao'  => new sfValidatorDate(),
      'qtde_paginas'   => new sfValidatorInteger(array('min' => 0), array('invalid' => 'A quantidade de páginas deve ser um número inteiro.', 'min' => 'A quantidade de páginas deve ser no mínimo %min%.'))
    ));

    //TODO: validar a data minima e maxima de sugestão da defesa

    $this->widgetSchema['data_sugestao']->setLabel('Data sugerida');
    $this->widgetSchema['qtde_paginas']->setLabel('Qtde. de páginas');

    $this->widgetSchema->setNameFormat('defesa[%s]');

    $this->widgetSchema->setFormFormatterName('divform');
  }
}
