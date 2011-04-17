<?php
/**
 * Description of relatorioStatusForm
 *
 * @author wesley
 */
class RelatorioStatusForm extends BaseForm{

  public function configure()
  {
    $arrStatus = array('' => 'Todos') + Proposta::$status + Defesa::$status;

    $this->setWidgets(array(
      'estudante_id'   => new sfWidgetFormInputText(),
      'professor_id'   => new sfWidgetFormDoctrineChoice(array('model' => 'Professor', 'add_empty' => 'Todos')),
      'status'         => new sfWidgetFormChoice(array('choices' => $arrStatus)),
      'semestre_id'    => new sfWidgetFormDoctrineChoice(array('model' => 'Semestre', 'add_empty' => 'Todos'))
    ));

    $this->widgetSchema['estudante_id']->setLabel('Matrícula do estudante');
    $this->widgetSchema['professor_id']->setLabel('Orientador');

    $this->widgetSchema->setNameFormat('relatorio[%s]');
  }

}
