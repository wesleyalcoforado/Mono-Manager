<?php
use \Util;

/**
 * Proposta form.
 *
 * @package    monomanager
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PropostaForm extends BasePropostaForm
{
  public function configure()
  {
    //TODO: Restringir projetos aos que o usuário possui, exceto se for adminsiostrador
    $this->setWidgets(array(
      'projeto_id'     => new sfWidgetFormInputHidden(),
      'documento'      => new sfWidgetFormInputFile()
    ));

    $this->setValidators(array(
      'projeto_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projeto'))),
      'documento'      => new sfValidatorFile(array(
          'mime_types' => array('application/pdf'),
          'max_size'   => Util::getMaxFilesize()
      ), array(
          'mime_types' => 'Apenas arquivos PDF são aceitos',
          'max_size'   => "O tamanho do arquivo ultrapassa o limite permitido ({%max_size%} bytes)"
      ))
    ));

    $this->widgetSchema->setNameFormat('proposta[%s]');
    
    $this->widgetSchema->setFormFormatterName('divform');
  }

}
