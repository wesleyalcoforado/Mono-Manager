<?php
use_helper('App', 'Text');
if(count($list) > 0): ?>

<script type="text/javascript">
  function audit(projeto_id){
    $.ajax({
      type: 'POST',
      url: '<?php echo url_for('proposta/info'); ?>',
      data: 'projeto_id=' + projeto_id,
      dataType: 'json',
      success: function(json){
        fillCommentForm(json.title, json.urlApprove, json.urlDisapprove);
        $("#divForm").slideDown();
      }
    });
  }

  function viewComments(projeto_id){
    $.ajax({
      type: 'POST',
      url: '<?php echo url_for('proposta/comments'); ?>',
      data: 'projeto_id=' + projeto_id,
      dataType: 'json',
      success: function(comments){
        var isArray = typeof(comments.length)!="undefined";
        if(isArray){
          if(comments.length > 0){
            var modalContainer = $("#comments");

            modalContainer.empty();

            for(index in comments){
              var comment = comments[index];
              var positive = comment['positive']
              var text = comment['text'];

              var line;
              if(positive){
                line = "<p class='positive'>";
              }else{
                line = "<p class='negative'>";
              }
              var line = line + text + "</p>";

              modalContainer.append(line);
            }

            $("#comments p:last-child").addClass('last');

            modalContainer.dialog({
              modal: true,
              width: 600,
              height: 300
            });
          }else{
            alert("Ninguém comentou ainda esta proposta.");
          }
        }else{
          alert("Ocorreu um erro ao buscar os comentários desta proposta.");
        }
      }
    });
  }

  function fillCommentForm(projectTitle, urlApprove, urlDisapprove){
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
  }

  $(document).ready(function(){
    $("#cancel_audition").click(function(){
      $("#divForm").slideUp();
    });
  });
</script>

<div id="divForm" style="display: none">
  <form method="post" id="frmLiberar" action="">
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

<div id="comments" style="display:none" title="Comentários">
</div>

<table id="listagem">
  <thead>
    <tr>
      <th>Orientador</th>
      <th>Estudante</th>
      <th>Título</th>
      <th colspan="3">Ações</th>
    </tr>
  </thead>
  <tbody>
<?php
  foreach($list as $proposta): ?>
    <tr>
      <td><?php echo $proposta->getProjeto()->getProfessor()->getUsuario()->getFullname(); ?></td>
      <td><?php echo $proposta->getProjeto()->getEstudante()->getUsuario()->getFullname(); ?></td>
      <td><?php echo truncate_text($proposta->getProjeto()->getTitulo(), 50); ?></td>
      <td><?php echo link_to(viewButton(), "@download_documento?projeto_id={$proposta->getProjetoId()}"); ?></td>
      <td>
        <a href="#" onclick="viewComments(<?php echo $proposta->getProjetoId()?>)">
           <?php echo commentsButton(); ?>
        </a>
      </td>
      <td><?php
        if($proposta->getStatus() == Proposta::APROVADO): ?>
        <a href="#" onclick="audit(<?php echo $proposta->getProjetoId()?>)">
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
