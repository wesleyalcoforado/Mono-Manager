<h1 class="nobottommargin">Relatórios</h1>
<h4>Projetos defendidos por semestre</h4>

<form method="post" action="<?php echo url_for('relatorio/concluidos?gerar=1');  ?>" enctype="multipart/form-data">
<table>
  <?php echo $form; ?>
  <tr>
    <td colspan="2" align="right">
      <input type="submit" value="Gerar relatório" class="dontShowOnPrint">
    </td>
  </tr>
</table>
</form>

<?php if(isset($reportRows)): ?>
<table id="listagem">
  <thead>
    <th>Matrícula</th>
    <th>Estudante</th>
    <th>Projeto</th>
    <th>Semestre</th>
  </thead>
  <tbody>
<?php
if(count($reportRows) > 0):
  foreach($reportRows as $row): ?>
    <tr>
      <td><?php echo $row['matricula']; ?></td>
      <td><?php echo $row['nomeEstudante']; ?></td>
      <td><?php echo $row['projeto']; ?></td>
      <td><?php echo $row['semestre']; ?></td>
    </tr>
<?php
  endforeach;
  else: ?>
    <tr>
      <td colspan="6">Não foram encontrados resultados que atendam aos filtros especificados.</td>
    </tr>
<?php
endif;
?>
  </tbody>
</table>
<?php endif; ?>
