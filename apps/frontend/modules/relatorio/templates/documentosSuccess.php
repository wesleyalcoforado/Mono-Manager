<h1 class="nobottommargin">Gerar <?php echo $tipoDocumentoLegivel; ?></h1>
<h4>Geração de documentos</h4>

<form method="post" action="<?php echo url_for('relatorio/documentos?gerar=1&tipo='.$tipoDocumento);  ?>" enctype="multipart/form-data">
<table>
  <?php echo $form; ?>
  <tr>
    <td colspan="2" align="right">
      <input type="submit" value="Listar projetos" class="dontShowOnPrint">
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
    <th>Semestre</th>
    <th>Docs</th>
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
      <td><?php echo $row['semestre']; ?></td>
      <?php if($tipo == 'orientador'): ?>
      <td><?php echo link_to('Gerar documento', 'relatorio/declaracaoOrientador?id=' . $row['projeto_id']);</td>
      <?php else: ?>
      <td><?php echo link_to('Gerar documento', 'relatotio/parametrosdocumento?tipo=' . $tipo . '&id='. $row['projeto_id']); ?></td>
      <?php endif; ?>
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
