<p>Caro(a) sr(a) professor <strong><?php echo $nomeOrientador; ?></strong>. Seu
orientando, <strong><?php echo $nomeEstudante; ?></strong>,  acabou de enviar uma
proposta para o projeto <em><?php echo $tituloProjeto; ?></em>.</p>

<p><?php echo link_to('Clique aqui', 'proposta/list', array('absolute' => true)) ?> 
para  acessar o sistema e acompanhar este projeto. O sistema aguarda sua
aprovação para dar continuidade ao processo.</p>
<br/><br/>

<span style="font-size: 10px; color: #999">Este email foi enviado automaticamente.
  Não é necessario respondê-lo. </span>