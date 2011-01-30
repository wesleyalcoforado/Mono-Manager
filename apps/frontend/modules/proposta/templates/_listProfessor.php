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
  foreach($list as $proposta): ?>
    <tr>
      <td><?php echo $proposta->getProjeto()->getEstudante()->getUsuario()->getFullname(); ?></td>
      <td><?php echo truncate_text($proposta->getProjeto()->getTitulo(), 50); ?></td>
      <td><?php if($proposta->getProjeto()->hasPropostaWithAttachedFile()){
                  echo link_to(viewButton(), "@download_documento?projeto_id={$proposta->getProjetoId()}");
                }else{
                  echo "";
                }
          ?>
      </td>
      <td><?php
        if($proposta->getStatus() == Proposta::NAO_ANALISADO):
          echo link_to(approveButton(), "@proposta_avaliar?projeto_id={$proposta->getProjetoId()}&aprovado=true", array('confirm' => 'Você tem certeza que deseja aprovar esta proposta?'));
          echo link_to(disapproveButton(), "@proposta_avaliar?projeto_id={$proposta->getProjetoId()}&aprovado=false", array('confirm' => 'Você tem certeza que deseja reprovar esta proposta?'));
        elseif($proposta->getStatus() == Proposta::APROVADO || $proposta->getStatus() == Proposta::LIBERADO):
          echo approveButton(false, "Proposta aprovada");
        elseif($proposta->getStatus() == Proposta::REPROVADO):
          echo disapproveButton(false, "Proposta reprovada");
        endif;
      ?>
      </td>
    </tr>
<?php
  endforeach; ?>
  </tbody>
</table>
<?php else: ?>
Não há propostas cadastradas.
<?php endif; ?>
