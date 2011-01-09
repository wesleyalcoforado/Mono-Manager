<form method="post" action="<?php echo url_for('professor/index');  ?>">
  <dl id="formContainer">
    <?php
    echo $form->renderHiddenFields();

    echo $form['username']->renderRow()
       . $form['email_address']->renderRow()
       . $form['password']->renderRow()
       . $form['password_again']->renderRow()
       . $form['first_name']->renderRow()
       . $form['last_name']->renderRow()
       . $form['Professor']['instituicao']->renderRow()
       . $form['Professor']['titulacao']->renderRow()
       . $form['Professor']['experiencia']->renderRow()
       . $form['Professor']['is_substituto']->renderRow()
       . $form['Professor']['is_comissao']->renderRow()
       . $form['is_active']->renderRow()
       . $form['is_super_admin']->renderRow();
    ?>
    <dt><input type="submit" value="Salvar"></dt>
  </dl>
</form>