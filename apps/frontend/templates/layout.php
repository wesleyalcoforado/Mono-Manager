<?php
  use_helper('Menu');

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
  <body class="mainLayout">
    <div class="container_24">
      <div class="grid_5" id="menu">
        <?php echo generateMenu(); ?>
        <div class="perfis">
          <?php echo comboPerfis(); ?>
        </div>
      </div>
      <div class="grid_19" id="content">
        <?php echo $sf_content ?>
      </div>
    </div>
  </body>
</html>
