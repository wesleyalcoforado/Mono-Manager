<h1 class="nobottommargin">Relatórios</h1>
<h4>Status dos projetos</h4>

<form method="post" action="<?php echo url_for('relatorio/status?gerar=1');  ?>" enctype="multipart/form-data">
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
    <th>Orientador</th>
    <th>Projeto</th>
    <th>Status</th>
    <th>Semestre</th>
  </thead>
  <tbody>
<?php
if(count($reportRows) > 0):
  foreach($reportRows as $row): ?>
    <tr>
      <td><?php echo $row['matricula']; ?></td>
      <td><?php echo $row['nomeEstudante']; ?></td>
      <td><?php echo $row['nomeProfessor']; ?></td>
      <td><?php echo $row['projeto']; ?></td>
      <td><?php echo $row['status']; ?></td>
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
