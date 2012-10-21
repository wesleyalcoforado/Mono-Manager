<?php
/**
 * Description of ParametrosAtaForm
 *
 * @author wesley
 */
class DocumentoFinalForm extends BaseForm{

  public function configure()
  {
    $this->setWidgets(array(
      'documento_final'  => new sfWidgetFormInputFile()
    ));

	    $this->setValidators(array(
	      'documento_final' => new sfValidatorFile(array(
	          'mime_types'  => array('application/pdf'),
	          'max_size'    => Util::getMaxFilesize()
	      ), array(
	          'mime_types' => 'Apenas arquivos PDF são aceitos',
	          'max_size'   => "O tamanho do arquivo ultrapassa o limite permitido ({%max_size%} bytes)"
	      ))
	    ));

    $this->widgetSchema['documento_final']->setLabel('Documento final');

    $this->widgetSchema->setNameFormat('documento[%s]');
		$this->widgetSchema->setFormFormatterName('divform');
  }

}
