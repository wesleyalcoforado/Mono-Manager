<?php
  use_helper('App');

  echo roundedBox(true);
?>
<div align="center">
  <p class='alert_access_denied'>
      Ops! Você esta tentando acessar uma área para a qual você não possui permissão.
  </p>
  <br/>
  Que tal tentar voltar para a <?php echo link_to('página inicial', 'default/index') ?>?
  Ou talvez você queira <?php echo link_to('entrar no sistema com um usuário diferente', 'sfGuardAuth/signout') ?>.
</div>
<?php
  echo roundedBox(false);
