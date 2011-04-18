<br/><br/>
<h1>Seja bem-vindo(a), <?php echo $nome; ?>!</h1>

<br/>

<?php if(isset($delayingProjects) && count($delayingProjects) > 0):
  if(count($delayingProjects) == 1){
    $msg = "Existe 1 projeto atrasando.";
  }else{
    $msg = "Existem {count($delayingProjects)} atrasando.";
  }
 ?>
  <p><?php echo $msg; ?></p>
  <ul>
<?php foreach($delayingProjects as $project): ?>
    <li><?php echo $project->getTitulo(); ?><br/>
        Motivo do atraso: <?php echo $project->reasonForDelay(Projeto::timeInAdvance()); ?>
    </li>
<?php endforeach; ?>
  </ul>
<?php endif; ?>

<br /><br />

<?php if(isset($delayedProjects) && count($delayedProjects) > 0):
  if(count($delayedProjects) == 1){
    $msg = "Existe 1 projeto em atraso.";
  }else{
    $msg = "Existem {count($delayedProjects)} em atraso.";
  }
 ?>
  <p><?php echo $msg; ?></p>
  <ul>
<?php foreach($delayedProjects as $project): ?>
    <li><?php echo $project->getTitulo(); ?><br/>
      Motivo do atraso: <?php echo $project->reasonForDelay(); ?>
    </li>
<?php endforeach; ?>
  </ul>
<?php endif;