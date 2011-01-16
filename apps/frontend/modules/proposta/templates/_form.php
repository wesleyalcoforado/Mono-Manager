<form method="post" action="<?php echo url_for('@proposta?projeto_id='.$projetoId);  ?>" enctype="multipart/form-data">
  <?php
  echo $form->renderHiddenFields();

  echo $form['documento']->renderRow();
  ?>
  <br/>(tamanho máximo permitido: <?php echo $maxFileSize ?> bytes)<br/>
  <input type="submit" value="Salvar">
</form>