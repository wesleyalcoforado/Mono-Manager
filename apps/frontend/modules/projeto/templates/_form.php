<form method="post" action="<?php echo url_for('projeto/index');  ?>">
  <dl id="formContainer">
    <?php
    echo $form->renderHiddenFields();

    echo $form['titulo']->renderRow()
       . $form['professor_id']->renderRow()
       . $form['coorientadores']->renderRow();
    ?>
    <dt><input type="submit" value="Salvar"></dt>
  </dl>
</form>