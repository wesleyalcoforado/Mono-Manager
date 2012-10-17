<?php
/**
 * Description of ParametrosAtaForm
 *
 * @author wesley
 */
class ParametrosAtaForm extends BaseForm{

  public function configure()
  {
    $this->setWidgets(array(
      'nota'   => new sfWidgetFormInputText(),
      'data'   => new sfWidgetFormInputText(),
      'hora'   => new sfWidgetFormInputText(),
      'examinadores'   => new sfWidgetFormTextarea()
    ));

    $this->widgetSchema['examinadores']->setLabel('Examinadores (um por linha)');

    $this->widgetSchema->setNameFormat('relatorio[%s]');
  }

}
