<?php if(count($list) > 0):  ?>

<script type="text/javascript">
  function openModal(id){
    var modalContainer = $("#"+id);
    modalContainer.dialog({
      modal: true,
      width: 600,
      height: 300
    });
  }

  function viewProposalComments(projectId){
    openModal("proposal_comments_" + projectId);
  }

  function viewPresentationComments(projectId){
    openModal("presentation_comments_" + projectId);
  }
</script>

<table id="listagem">
    <thead>
        <tr>
            <th>Orientador</th>
            <th>Título</th>
            <th>Semestre</th>
            <th>Proposta</th>
            <th>Defesa</th>
            <th>Status</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>

<?php
foreach($list as $projeto): ?>
        <tr>
            <td><?php echo $projeto->getProfessor()->getUsuario()->getFullname(); ?></td>
            <td><?php echo truncate_text($projeto->getTitulo(), 50); ?></td>
            <td><?php echo $projeto->getSemestre()->getNome(); ?></td>
            <td><?php 
                  if($projeto->hasPropostaWithAttachedFile()):
                    echo link_to(viewButton(), "@download_documento?projeto_id={$projeto->getId()}");
                    ?>
                    <a href="#" onclick="viewProposalComments(<?php echo $projeto->getId()?>)">
                      <?php echo commentsButton(); ?>
                    </a>
                    <div id="proposal_comments_<?php echo $projeto->getId()?>" style="display: none;" title="Comentários">
                      <?php
                        if($projeto->getProposta()->getComentarios()->count() > 0):
                          echo "<ul>";
                          foreach($projeto->getProposta()->getComentarios() as $comentario):
                            echo "<li>{$comentario->getComentario()}</li>";
                          endforeach;
                          echo "</ul>";
                        else:
                          echo "<p>Não foram feitos comentários sobre esta proposta.</p>";
                        endif;
                      ?>
                    </div>
                    <?php
                    echo link_to(attachButton('Substituir proposta'), "@proposta?projeto_id={$projeto->getId()}", array('confirm' => 'Ao substituir a proposta, o processo todo será reiniciado. Deseja continuar?'));
                  else:
                    echo link_to(attachButton(), "@proposta?projeto_id={$projeto->getId()}");
                  endif;
                ?>
            </td>
            <td><?php 
              if($projeto->mayRequestPresentation()):
                if($projeto->hasDefesaWithAttachedFile()):
                  echo link_to(viewButton(), "@download_copiao?projeto_id={$projeto->getId()}");
                  ?>
                  <a href="#" onclick="viewPresentationComments(<?php echo $projeto->getId()?>)">
                    <?php echo commentsButton(); ?>
                  </a>
                  <div id="presentation_comments_<?php echo $projeto->getId()?>" style="display: none;" title="Comentários">
                    <?php
                      if($projeto->getDefesa()->getComentarios()->count() > 0):
                        echo "<ul>";
                        foreach($projeto->getDefesa()->getComentarios() as $comentario):
                          echo "<li>{$comentario->getComentario()}</li>";
                        endforeach;
                        echo "</ul>";
                      else:
                        echo "<p>Não foram feitos comentários sobre esta solicitação de defesa.</p>";
                      endif;
                    ?>
                  </div>
                  <?php
                  echo link_to(presentationButton(true, 'Renovar requisição de defesa'), "@defesa?projeto_id={$projeto->getId()}", array('confirm' => 'Ao renovar a defesa, o processo de requisição de defesa será reiniciado. Deseja continuar?'));
									echo link_to(finalDocumentButton(), "@documento_final?projeto_id={$projeto->getId()}");
                else:
                  echo link_to(presentationButton(), "@defesa?projeto_id={$projeto->getId()}");
                endif;
              else:
                echo presentationButton(false); 
              endif;
            ?></td>
            <td><?php echo $projeto->getStatus(); ?></td>
            <td><?php echo link_to(editButton(), "projeto/index?id={$projeto->getId()}"); ?></td>
            <td><?php echo link_to(deleteButton(), "projeto/excluir?id={$projeto->getId()}", array('confirm' => 'Você tem certeza de que deseja excluir este registro?')); ?></td>
        </tr>
<?php
endforeach;
?>
    </tbody>
</table>
<?php endif;