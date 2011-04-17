<?php
/**
 * Description of relatorioDefendidosForm
 *
 * @author wesley
 */
class RelatorioDefendidosForm extends BaseForm{

  public function configure()
  {
    $this->setWidgets(array(
      'semestre_id'    => new sfWidgetFormDoctrineChoice(array('model' => 'Semestre', 'add_empty' => 'Todos'))
    ));

    $this->widgetSchema->setNameFormat('relatorio[%s]');
  }

}
