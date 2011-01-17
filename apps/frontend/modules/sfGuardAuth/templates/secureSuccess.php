<h2>Opa! Você esta tentando acessar uma área segura.</h2>

<p><?php echo sfContext::getInstance()->getRequest()->getUri() ?></p>

<h3>Entrar no sistema</h3>

<?php echo get_component('sfGuardAuth', 'signin_form') ?>