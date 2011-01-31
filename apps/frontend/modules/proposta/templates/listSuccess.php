<h1>Proposta</h1>

<?php 
  if($user->isSuperAdmin()):
    include_partial('listAdmin', array('list' => $list));
  elseif($user->isComissao()):
    include_partial('listComissao', array('list' => $list));
  elseif($user->isProfessor()):
    include_partial('listProfessor', array('list' => $list));
  endif;
