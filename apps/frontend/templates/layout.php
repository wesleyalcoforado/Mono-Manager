<?php
    // Obtém a url base
    $baseUrl = _compute_public_path('', '', '', true);
    $baseUrl = substr($baseUrl, 0, -2);
    $imageDir = $baseUrl . 'images/';
    $jsDir = $baseUrl . 'js/';
    $environment = sfContext::getInstance()->getConfiguration()->getEnvironment();
    $app = sfContext::getInstance()->getConfiguration()->getApplication();
    $baseUrl .= (strcasecmp($environment, 'dev')==0)?$app . '_dev.php/':'';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    <div class="container_24">
      <div class="grid_7" id="menu">
        <ul>
          <li><?php echo link_to1("Professores", "professor/index"); ?></li>
          <li><?php echo link_to1("Estudantes", "estudante/index"); ?></li>
          <li><?php echo link_to1("Projetos", "projeto/index"); ?></li>
          <li><?php echo link_to1("Semestres", "semestre/index"); ?></li>
          <li><?php echo link_to1("Sair", "sfGuardAuth/signout"); ?></li>
        </ul>
      </div>
      <div class="grid_16" id="content">
        <?php echo $sf_content ?>
      </div>
    </div>
  </body>
</html>
