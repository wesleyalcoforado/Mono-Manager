<?php
use_helper('App', 'Text');
if(count($list) > 0): ?>
<table id="listagem">
  <thead>
    <tr>
      <th>Estudante</th>
      <th>Título</th>
      <th colspan="2">Ações</th>
    </tr>
  </thead>
  <tbody>
<?php
  foreach($list as $defesa): ?>
    <tr>
      <td><?php echo $defesa->getProjeto()->getEstudante()->getUsuario()->getFullname(); ?></td>
      <td><?php echo truncate_text($defesa->getProjeto()->getTitulo(), 50); ?></td>
      <td><?php if($defesa->getProjeto()->hasDefesaWithAttachedFile()){
                  echo link_to(viewButton(true, 'Visualizar copião'), "@download_copiao?projeto_id={$defesa->getProjetoId()}");
                }else{
                  echo viewButton(false, 'Visualizar copião');
                }
          ?>
      </td>
      <td><?php
        if($defesa->getStatus() == Defesa::NAO_ANALISADO):
          echo link_to(approveButton(), "@defesa_avaliar?projeto_id={$defesa->getProjetoId()}&aprovado=true", array('confirm' => 'Você tem certeza que deseja aprovar esta defesa?'));
          echo link_to(disapproveButton(), "@defesa_avaliar?projeto_id={$defesa->getProjetoId()}&aprovado=false", array('confirm' => 'Você tem certeza que deseja reprovar esta defesa?'));
        elseif($defesa->getStatus() == Defesa::APROVADO || $defesa->getStatus() == Defesa::LIBERADO || $defesa->getStatus() == Defesa::DEFENDIDO):
          echo approveButton(false, "Defesa aprovada");
        elseif($defesa->getStatus() == Defesa::REPROVADO || $defesa->getStatus() == Defesa::NAO_LIBERADO):
          echo disapproveButton(false, "Defesa reprovada");
        endif;
      ?>
      </td>
    </tr>
<?php
  endforeach; ?>
  </tbody>
</table>
<?php else: ?>
Não há defesas cadastradas.
<?php endif; ?>
