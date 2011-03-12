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
</ul>
