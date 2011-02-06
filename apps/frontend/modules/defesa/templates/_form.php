<form method="post" action="<?php echo url_for('@defesa?projeto_id='.$projetoId);  ?>" enctype="multipart/form-data">
  <?php
  echo $form->renderHiddenFields();

  echo $form['data_sugestao']->renderRow();
  echo $form['documento']->renderRow();
  echo $form['qtde_paginas']->renderRow();
  ?>
  <br/>(tamanho máximo permitido: <?php echo $maxFileSize ?> bytes)<br/>
  <input type="submit" value="Salvar">
</form>