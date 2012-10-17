<h1>Relatórios</h1>

<table class="icons_table">
	<tr>
	  <td>
			<?php echo link_to(image_tag('icons/project_status') . "<br/>Status dos projetos", 'relatorio/status'); ?>
	  </td>
		<td>
			<?php echo link_to(image_tag('icons/concluded_projects') . "<br/>Projetos defendidos<br/>por semestre", 'relatorio/concluidos'); ?>
		</td>
		<td>
			<?php echo link_to(image_tag('icons/document') . "<br/>Ata", 'relatorio/documentos?tipo=ata'); ?>
		</td>
		<td>
			<?php echo link_to(image_tag('icons/document') . "<br/>Declaração Orientador", 'relatorio/documentos?tipo=orientador'); ?>
		</td>
  </tr>
	<tr>
		<td>
			<?php echo link_to(image_tag('icons/document') . "<br/>Declaração Banca", 'relatorio/documentos?tipo=banca'); ?>
		</td>
		<td>
			<?php echo link_to(image_tag('icons/document') . "<br/>Ficha de avaliação", 'relatorio/documentos?tipo=ficha'); ?>
		</td>
		<td></td><td></td>
	</tr>
</table>


