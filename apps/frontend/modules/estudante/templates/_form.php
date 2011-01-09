<form method="POST">
  <dl id="formContainer">
    <?php
    echo $form->renderHiddenFields();
    
    echo $form['username']->renderRow()
       . $form['email_address']->renderRow()
       . $form['password']->renderRow()
       . $form['password_again']->renderRow()
       . $form['first_name']->renderRow()
       . $form['last_name']->renderRow()
       . $form['Estudante']['telefone']->renderRow()
       . $form['is_active']->renderRow();
    ?>
    <dt><input type="submit" value="Salvar"></dt>
  </dl>
</form>