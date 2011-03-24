<?php
/**
 * Description of relatorioStatusForm
 *
 * @author wesley
 */
class RelatorioStatusForm extends BaseForm{

  public function configure()
  {
    $arrStatus = array_merge(array('' => 'Todos'), Proposta::$status, Defesa::$status);

    $this->setWidgets(array(
      'estudante_id'   => new sfWidgetFormDoctrineChoice(array('model' => 'Estudante', 'add_empty' => 'Todos')),
      'professor_id'   => new sfWidgetFormDoctrineChoice(array('model' => 'Professor', 'add_empty' => 'Todos')),
      'status'         => new sfWidgetFormChoice(array('choices' => $arrStatus)),
      'semestre_id'    => new sfWidgetFormDoctrineChoice(array('model' => 'Semestre', 'add_empty' => 'Todos'))
    ));

    $this->widgetSchema->setNameFormat('relatorio[%s]');
  }

}
