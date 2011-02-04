<?php
use_helper('App', 'Text');
if(count($list) > 0): ?>

<script type="text/javascript">
  $(document).ready(function(){
    $("a.audit").click(function(){
      var projectTitle = $(this).attr('project_title');
      var urlApprove = $(this).attr('urlApprove');
      var urlDisapprove = $(this).attr('urlDisapprove');

      $("#proposta_titulo").val(projectTitle);

      $("#approve_button").click(function(){
        if(confirm("Você tem certeza que deseja aprovar esta proposta?")){
          $("#frmLiberar").attr("action", urlApprove).submit();
        }
      });

      $("#disapprove_button").click(function(){
        if(confirm("Você tem certeza que deseja reprovar esta proposta?")){
          $("#frmLiberar").attr("action", urlDisapprove).submit();
        }
      });

      $("#divForm").slideDown();

    });

    $("#cancel_audition").click(function(){
      $("#divForm").slideUp();
    });
  });
</script>

<div id="divForm" style="display: none">
  <form method="post" id="frmLiberar">
    <input type="hidden" name="proposta_id">
    <label>Proposta: </label> <input type="text" id="proposta_titulo" readonly><br/>
    <label for="comentario">Comentário:</label>
    <textarea name="comentario"></textarea><br/>
    <div align="center">
      <button type="button" id="approve_button"><?php echo approveButton(true, ''); ?> Aprovar</button>
      <button type="button" id="disapprove_button"><?php echo disapproveButton(true, ''); ?> Reprovar</button>
      <button type="button" id="cancel_audition"><?php echo cancelButton(); ?> Cancelar</button>
    </div>
  </form>
  <br/><br/>
</div>

<table id="listagem">
  <thead>
    <tr>
      <th>Orientador</th>
      <th>Estudante</th>
      <th>Título</th>
      <th colspan="2">Ações</th>
    </tr>
  </thead>
  <tbody>
<?php
  foreach($list as $proposta): ?>
    <tr>
      <td><?php echo $proposta->getProjeto()->getProfessor()->getUsuario()->getFullname(); ?></td>
      <td><?php echo $proposta->getProjeto()->getEstudante()->getUsuario()->getFullname(); ?></td>
      <td><?php echo truncate_text($proposta->getProjeto()->getTitulo(), 50); ?></td>
      <td><?php echo link_to(viewButton(), "@download_documento?projeto_id={$proposta->getProjetoId()}"); ?>
      </td>
      <td><?php
        if($proposta->getStatus() == Proposta::APROVADO): ?>
        <a href="#" class="audit"
           project_title="<?php echo $proposta->getProjeto()->getTitulo()?>"
           urlApprove="<?php echo url_for("@proposta_liberar?projeto_id={$proposta->getProjetoId()}&liberado=true"); ?>"
           urlDisapprove="<?php echo url_for("@proposta_liberar?projeto_id={$proposta->getProjetoId()}&liberado=false"); ?>">
           <?php echo hammerButton(); ?>
        </a>
        <?php
        elseif($proposta->getStatus() == Proposta::LIBERADO):
          echo approveButton(false, "Proposta aprovada");
        elseif($proposta->getStatus() == Proposta::NAO_LIBERADO):
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
