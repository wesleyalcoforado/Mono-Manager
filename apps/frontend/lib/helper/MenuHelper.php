<?php
function generateMenu(){
  $user = sfContext::getInstance()->getUser();
  $menuItems = array();

  $inicioPage     = link_to("Início", "default/index");
  $professorPage  = link_to("Professores", "professor/index");
  $estudantePage  = link_to("Estudantes", "estudante/index");
  $projetoPage    = link_to("Projetos", "projeto/index");
  $propostaPage   = link_to("Propostas", "proposta/list");
  $defesaPage     = link_to("Defesas", "defesa/list");
  $semestrePage   = link_to("Semestres", "semestre/index");
  $relatorioPage   = link_to("Relatórios", "relatorio/index");
  $sairPage       = link_to("Sair", "sfGuardAuth/signout");

  $menuItems[] = $inicioPage;

  if($user->isSuperAdmin()){
    $menuItems[] = $professorPage;
    $menuItems[] = $estudantePage;
    $menuItems[] = $semestrePage;
    $menuItems[] = $propostaPage;
    $menuItems[] = $defesaPage;
    $menuItems[] = $relatorioPage;
  }else if($user->isEstudante()){
    $menuItems[] = $projetoPage;
  }else if($user->isProfessor()){
    $menuItems[] = $propostaPage;
    $menuItems[] = $defesaPage;
    $menuItems[] = $relatorioPage;
  }

  $menuItems[] = $sairPage;

  $arrListItems = array();
  foreach($menuItems as $menuItem){
    $arrListItems[] = content_tag('li', $menuItem);
  }

  return content_tag('ul', implode('', $arrListItems));
}