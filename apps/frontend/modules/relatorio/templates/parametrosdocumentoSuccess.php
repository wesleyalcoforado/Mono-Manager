<h1 class="nobottommargin">Gerar <?php echo $tipoDocumentoLegivel; ?></h1>
<h4>Geração de documentos</h4>

<form method="post" action="<?php echo url_for('relatorio/parametrosdocumento?gerar=1');  ?>" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo $idProjeto; ?>">
	<input type="hidden" name="tipo" value="<?php echo $tipoDocumento; ?>">
<table>
  <?php echo $form; ?>
  <tr>
    <td colspan="2" align="right">
      <input type="submit" value="Gerar documento" class="dontShowOnPrint">
    </td>
  </tr>
</table>
</form>
