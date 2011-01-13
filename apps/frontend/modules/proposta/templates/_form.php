<form method="post" action="<?php echo url_for('proposta/index');  ?>" class="jqtransform">
  <?php
  echo $form->renderHiddenFields();

  echo $form['documento']->renderRow();
  ?>
  <div class="rowElem"><input type="submit" value="Salvar"></div>
</form>