<p>Sua proposta <em><?php echo $tituloProjeto; ?></em>, acabou de ser reprovada
  pelo professor <strong><?php echo $nomeOrientador; ?></strong>.</p>

<p>Entre em contato com seu orientador para verificar qual o motivo da reprovação
e submeta um novo documento para substituir o atual.</p>

<p><?php echo link_to('Clique aqui', 'projeto/index', array('absolute' => true)) ?> 
para acessar o sistema e acompanhar este projeto.</p>
<br/>
<br/>
<span style="font-size: 10px; color: #999">Este email foi enviado automaticamente.
  Não é necessario respondê-lo. </span>