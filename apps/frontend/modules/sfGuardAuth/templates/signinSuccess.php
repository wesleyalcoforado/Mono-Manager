<?php 
  use_helper('App');

  echo roundedBox(true);
  echo "<h1>Entrar</h1>";
  include_partial('signin_form', array('form' => $form));
  echo roundedBox(false);
