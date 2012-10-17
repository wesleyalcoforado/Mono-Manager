<h1>Relatórios</h1>

<ul id="icons_table">
  <li>
    <?php
      echo link_to(image_tag('icons/project_status') . "<br/>Status dos projetos", 'relatorio/status');
    ?>
  </li>
  <li>
    <?php
      echo link_to(image_tag('icons/concluded_projects') . "<br/>Projetos defendidos<br/>por semestre", 'relatorio/concluidos');
    ?>
  </li>
  <li>
    <?php
      echo link_to(image_tag('icons/document') . "<br/>Ata", 'relatorio/documentos/tipo/ata');
    ?>
  </li>
  <li>
    <?php
      echo link_to(image_tag('icons/document') . "<br/>Declaração Orientador", 'relatorio/documentos/tipo/orientador');
    ?>
  </li>
  <li>
    <?php
      echo link_to(image_tag('icons/document') . "<br/>Declaração Banca", 'relatorio/documentos/tipo/banca');
    ?>
  </li>	
  <li>
    <?php
      echo link_to(image_tag('icons/document') . "<br/>Ficha de avaliação", 'relatorio/documentos/tipo/ficha');
    ?>
  </li>			
</ul>
