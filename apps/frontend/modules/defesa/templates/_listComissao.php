<?php
use_helper('App', 'Text');
if(count($list) > 0): ?>

<script type="text/javascript">
  var init = app.init;
  app.init = function(){
    init();
    app.createDatePicker("data_autorizada_day", "data_autorizada_month", "data_autorizada_year");

    $("#cancel_audition").click(function(){
      $("#divForm").slideUp();
    });
  }
  
  function audit(projeto_id){
    $.ajax({
      type: 'POST',
      url: '<?php echo url_for('defesa/info'); ?>',
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
      url: '<?php echo url_for('defesa/comments'); ?>',
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
            alert("Ninguém comentou ainda esta defesa.");
          }
        }else{
          alert("Ocorreu um erro ao buscar os comentários desta defesa.");
        }
      }
    });
  }

  function fillCommentForm(projectTitle, urlApprove, urlDisapprove){
    $("#projeto_titulo").val(projectTitle);

    $("#approve_button").click(function(){
      if(confirm("Você tem certeza que deseja aprovar esta defesa?")){
        $("#frmLiberar").attr("action", urlApprove).submit();
      }
    });

    $("#disapprove_button").click(function(){
      if(confirm("Você tem certeza que deseja reprovar esta defesa?")){
        $("#frmLiberar").attr("action", urlDisapprove).submit();
      }
    });
  }
</script>

<div id="divForm" style="display: none">
  <form method="post" id="frmLiberar" action="">
    <input type="hidden" name="proposta_id">
    <label>Título: </label> <input type="text" id="projeto_titulo" readonly><br/>
    <label for="data_autorizada">Data autorizada:</label>  <?php echo $widgetData->render('data_autorizada', ESC_RAW); ?><br/>
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
      <th>Data sugerida</th>
      <th>Data autorizada</th>
      <th colspan="3">Ações</th>
    </tr>
  </thead>
  <tbody>
<?php
  foreach($list as $defesa): ?>
    <tr>
      <td><?php echo $defesa->getProjeto()->getProfessor()->getUsuario()->getFullname(); ?></td>
      <td><?php echo $defesa->getProjeto()->getEstudante()->getUsuario()->getFullname(); ?></td>
      <td><?php echo truncate_text($defesa->getProjeto()->getTitulo(), 50); ?></td>
      <td><?php echo formatDate($defesa->getDataSugestao()); ?></td>
      <td><?php echo formatDate($defesa->getDataAutorizacao()); ?></td>
      <td><?php echo link_to(viewButton(), "@download_copiao?projeto_id={$defesa->getProjetoId()}"); ?></td>
      <td>
        <a href="#" onclick="viewComments(<?php echo $defesa->getProjetoId()?>)">
           <?php echo commentsButton(); ?>
        </a>
      </td>
      <td><?php
        if($defesa->getStatus() == Defesa::APROVADO): ?>
        <a href="#" onclick="audit(<?php echo $defesa->getProjetoId()?>)">
           <?php echo hammerButton(); ?>
        </a>
        <?php
        elseif($defesa->getStatus() == Defesa::LIBERADO):
          echo link_to(tickButton(), "@defesa_concluir?projeto_id={$defesa->getProjetoId()}&concluido=true", array('confirm' => 'Deseja realmente marcar este projeto como defendido?'));
        elseif($defesa->getStatus() == Defesa::NAO_LIBERADO):
          echo disapproveButton(false, "Defesa reprovada");
        elseif($defesa->getStatus() == Defesa::DEFENDIDO):
          echo tickButton(false);
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
