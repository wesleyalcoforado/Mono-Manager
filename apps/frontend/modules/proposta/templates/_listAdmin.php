<?php
use_helper('App', 'Text');
if(count($list) > 0): ?>
<table id="listagem">
  <thead>
    <tr>
      <th>Orientador</th>
      <th>Título</th>
      <th>Proposta</th>
      <th>Defesa</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
<?php
      foreach($list as $proposta): ?>
    <tr>
      <td><?php echo $proposta->getProjeto()->getProfessor()->getUsuario()->getFullname(); ?></td>
      <td><?php echo truncate_text($proposta->getProjeto()->getTitulo(), 50); ?></td>
      <td><?php if($proposta->getProjeto()->hasPropostaWithAttachedFile()){
                  echo link_to(viewButton(), "@download_documento?projeto_id={$proposta->getProjetoId()}");
                }else{
                  echo "";
                }
          ?>
      </td>
      <td><?php echo link_to(presentationButton(), 'projeto/index'); ?></td>
      <td><?php echo link_to(deleteButton(), "projeto/excluir?id={$proposta->getProjetoId()}", array('confirm' => 'Você tem certeza de que deseja excluir este registro?')); ?></td>
    </tr>
<?php
      endforeach; ?>
  </tbody>
</table>
<?php else: ?>
Não há propostas cadastradas.
<?php endif; ?>
