<form method="post" action="<?php echo url_for('projeto/index');  ?>">
  <?php
  echo $form->renderHiddenFields();

  echo $form['titulo']->renderRow()
     . $form['professor_id']->renderRow()
     . $form['coorientadores']->renderRow();
  ?>
  <div class="rowElem"><input type="submit" value="Salvar"></div>
</form>