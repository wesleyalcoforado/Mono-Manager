<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <?php
    echo $form['username']->renderLabel('Login')
       . $form['username']->render();
  ?> <br/>
  <?php
    echo $form['password']->renderLabel('Senha')
       . $form['password']->render();
  ?> <br/>
  <?php
    echo $form['remember']->renderLabel('Lembrar de mim?')
       . $form['remember']->render();
  ?> <br/>

  <input type="submit" value="Entrar" />

</form>