<h1>Enviar documento final</h1>

<form method="post" action="<?php echo url_for('@documento_final?projeto_id='.$projetoId);  ?>" enctype="multipart/form-data">
  <?php
  echo $form->renderHiddenFields();
  echo $form['documento_final']->renderRow();
  ?>
  <br/>(tamanho máximo permitido: <?php echo $maxFileSize ?> bytes)<br/>
  <input type="submit" value="Salvar">
</form>