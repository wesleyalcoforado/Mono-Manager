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
    $this->widgetSchema->setFormFormatterName('divform');

    $minYear = SemestreTable::getInstance()->findEarliestYearOrDefault(date('Y'));

    $rangeYears = range($minYear - 1, date('Y') + 10);
    $years = array_combine($rangeYears, $rangeYears);

    $format = '%day%%month%%year%';
    $this->getWidget('data_colacao')->setOption('format', $format);
    $this->getWidget('data_max_proposta')->setOption('format', $format);
    $this->getWidget('data_max_copiao')->setOption('format', $format);
    $this->getWidget('data_max_defesa')->setOption('format', $format);

    $this->getWidget('data_colacao')->setOption('years', $years);
    $this->getWidget('data_max_proposta')->setOption('years', $years);
    $this->getWidget('data_max_copiao')->setOption('years', $years);
    $this->getWidget('data_max_defesa')->setOption('years', $years);


    $this->getWidget('data_colacao_especial')->setOption('format', $format);
    $this->getWidget('data_max_proposta_especial')->setOption('format', $format);
    $this->getWidget('data_max_copiao_especial')->setOption('format', $format);
    $this->getWidget('data_max_defesa_especial')->setOption('format', $format);

    $this->getWidget('data_colacao_especial')->setOption('years', $years);
    $this->getWidget('data_max_proposta_especial')->setOption('years', $years);
    $this->getWidget('data_max_copiao_especial')->setOption('years', $years);
    $this->getWidget('data_max_defesa_especial')->setOption('years', $years);

    $this->getWidget('nome')->setAttribute('maxlength', 30);

    $this->getValidator('nome')->setOption('required', true);
    $this->getWidget('data_colacao')->setOption('can_be_empty', false);
    $this->setDefault('data_colacao', time());

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(
        array(
          new sfValidatorSchemaCompare('data_max_proposta', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'data_max_copiao',
            array(),
            array('invalid' => 'A data de proposta deve ser anterior à data de apresentação.')
          ),
          new sfValidatorSchemaCompare('data_max_copiao', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'data_max_defesa',
            array(),
            array('invalid' => 'A data de proposta deve ser anterior à data de apresentação.')
          ),
          new sfValidatorSchemaCompare('data_max_defesa', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'data_colacao',
            array(),
            array('invalid' => 'A data de proposta deve ser anterior à data de apresentação.')
          ),
          new sfValidatorSchemaCompare('data_colacao', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'data_colacao_especial',
            array(),
            array('invalid' => 'A data de colação normal deve ser anterior à data de colação especial.')
          ),
          new sfValidatorSchemaCompare('data_max_proposta_especial', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'data_max_copiao_especial',
            array(),
            array('invalid' => 'A data de proposta deve ser anterior à data de apresentação.')
          ),
          new sfValidatorSchemaCompare('data_max_copiao_especial', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'data_max_defesa_especial',
            array(),
            array('invalid' => 'A data de proposta deve ser anterior à data de apresentação.')
          ),
          new sfValidatorSchemaCompare('data_max_defesa_especial', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'data_colacao_especial',
            array(),
            array('invalid' => 'A data de proposta deve ser anterior à data de apresentação.')
          )
        )
      )
    );

    $this->widgetSchema['data_colacao']->setLabel('Colação normal *');
    $this->widgetSchema['data_max_proposta']->setLabel('Entrega da proposta');
    $this->widgetSchema['data_max_copiao']->setLabel('Entrega do copião');
    $this->widgetSchema['data_max_defesa']->setLabel('Defesa');

    $this->widgetSchema['data_colacao_especial']->setLabel('Colação especial');
    $this->widgetSchema['data_max_proposta_especial']->setLabel('Entrega da proposta (esp.)');
    $this->widgetSchema['data_max_copiao_especial']->setLabel('Entrega do copião (esp.)');
    $this->widgetSchema['data_max_defesa_especial']->setLabel('Defesa (esp.)');

  }

  public function bind(array $taintedValues = null, array $taintedFiles = null) {
    $dataColacao = mktime(0, 0, 0, $taintedValues['data_colacao']['month'], $taintedValues['data_colacao']['day'], $taintedValues['data_colacao']['year']);

    if(!$this->validDate($taintedValues['data_colacao_especial'])){
      $dataColacaoEspecial = strtotime('+1 month', $dataColacao);
      $taintedValues['data_colacao_especial'] = $this->makeDate($dataColacaoEspecial);
    }else{
      $dataColacaoEspecial = mktime(0, 0, 0,  $taintedValues['data_colacao_especial']['month'], $taintedValues['data_colacao_especial']['day'], $taintedValues['data_colacao_especial']['year']);
    }

    if(!$this->validDate($taintedValues['data_max_proposta'])){
      $date = strtotime('-3 month', $dataColacao);
      $taintedValues['data_max_proposta'] = $this->makeDate($date);
    }

    if(!$this->validDate($taintedValues['data_max_copiao'])){
      $date = strtotime('-1 month', $dataColacao);
      $taintedValues['data_max_copiao'] = $this->makeDate($date);
    }


    if(!$this->validDate($taintedValues['data_max_defesa'])){
      $date = strtotime('-1 week', $dataColacao);
      $taintedValues['data_max_defesa'] = $this->makeDate($date);
    }

    if(!$this->validDate($taintedValues['data_max_proposta_especial'])){
      $date = strtotime('-3 month', $dataColacaoEspecial);
      $taintedValues['data_max_proposta_especial'] = $this->makeDate($date);
    }

    if(!$this->validDate($taintedValues['data_max_copiao_especial'])){
      $date = strtotime('-1 month', $dataColacaoEspecial);
      $taintedValues['data_max_copiao_especial'] = $this->makeDate($date);
    }

    if(!$this->validDate($taintedValues['data_max_defesa_especial'])){
      $date = strtotime('-1 week', $dataColacaoEspecial);
      $taintedValues['data_max_defesa_especial'] = $this->makeDate($date);
    }


    parent::bind($taintedValues, $taintedFiles);
  }

  protected function validDate(array $dateArray){
    return !empty($dateArray['day']) && !empty($dateArray['month']) && !empty($dateArray['year']);
  }

  protected function makeDate($timestamp){
    $day = date('j', $timestamp);
    $month = date('n', $timestamp);
    $year = date('Y', $timestamp);

    return array(
        'day' => $day,
        'month' => $month,
        'year' => $year
    );
  }
}
