<p>A defesa do projeto <em><?php echo $tituloProjeto; ?></em>, requisitada pelo(a) estudante <strong><?php echo $nomeEstudante; ?></strong>
acabou de ser aprovada pelo professor <strong><?php echo $nomeOrientador; ?></strong>.</p>

<p>O Sr(a), como integrante da comissão, necessita liberar o projeto para que o sistema
dê continuidade ao processo. <?php echo link_to('Clique aqui', 'defesa/list', array('absolute' => true)) ?>
 para acessar o sistema e acompanhar este projeto.</p>
<br/>
<br/>
<span style="font-size: 10px; color: #999">Este email foi enviado automaticamente.
  Não é necessario respondê-lo. </span>