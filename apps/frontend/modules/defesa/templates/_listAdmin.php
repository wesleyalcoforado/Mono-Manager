<?php
use_helper('App', 'Text');
if(count($list) > 0): ?>
<table id="listagem">
  <thead>
    <tr>
      <th>Orientador</th>
      <th>Título</th>
      <th>Defesa</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
<?php
      foreach($list as $defesa): ?>
    <tr>
      <td><?php echo $defesa->getProjeto()->getProfessor()->getUsuario()->getFullname(); ?></td>
      <td><?php echo truncate_text($defesa->getProjeto()->getTitulo(), 50); ?></td>
      <td><?php if($defesa->getProjeto()->hasDefesaWithAttachedFile()){
                  echo link_to(viewButton(true, 'Visualizar copião'), "@download_copiao?projeto_id={$defesa->getProjetoId()}");
                }else{
                  echo viewButton(false, 'Visualizar copião');
                }
          ?></td>
      <td><?php echo link_to(deleteButton(), "defesa/excluir?id={$defesa->getProjetoId()}", array('confirm' => 'Você tem certeza de que deseja excluir este registro?')); ?></td>
    </tr>
<?php
      endforeach; ?>
  </tbody>
</table>
<?php else: ?>
Não há defesas cadastradas.
<?php endif; ?>
