<h1 class="nobottommargin">Relatórios</h1>
<h4>Status dos projetos</h4>

<form method="get" action="<?php echo url_for('relatorio/status?gerar=1');  ?>" enctype="multipart/form-data">
<table>
  <?php echo $form; ?>
  <tr>
    <td colspan="2" align="right"><input type="submit" value="Gerar relatório"></td>
  </tr>
</table>
</form>