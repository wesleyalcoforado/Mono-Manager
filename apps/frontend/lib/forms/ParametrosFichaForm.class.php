<?php
/**
 * Description of ParametrosAtaForm
 *
 * @author wesley
 */
class ParametrosFichaForm extends BaseForm{

  public function configure()
  {
    $this->setWidgets(array(
      'professor'   => new sfWidgetFormInputText()
    ));

    $this->widgetSchema->setNameFormat('relatorio[%s]');
  }

}
