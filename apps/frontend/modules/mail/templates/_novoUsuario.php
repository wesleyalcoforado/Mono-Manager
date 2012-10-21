<p>Seja bem vindo ao TCC-Manager, <em><?php echo $nomeEstudante; ?></em>.
<p>Uma conta acabou de ser criada para você no sistema com os seguintes dados:</p>  
<ul>
  <li>Login: <?php echo $login; ?></li>
  <li>Senha: <?php echo $senha; ?></li>  
</ul>  

<p><?php echo link_to('Clique aqui', 'default/index', array('absolute' => true)) ?>
 para acessar o sistema.</p>
<br/>
<br/>
<span style="font-size: 10px; color: #999">Este email foi enviado automaticamente.
  Não é necessario respondê-lo. </span>