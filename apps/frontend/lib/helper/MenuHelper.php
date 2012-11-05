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
  
  
  $perfil = $user->getUsuario()->getPerfil();

  if($perfil == Usuario::ADMIN){
    $menuItems[] = $professorPage;
    $menuItems[] = $estudantePage;
    $menuItems[] = $semestrePage;
    $menuItems[] = $propostaPage;
    $menuItems[] = $defesaPage;
    $menuItems[] = $relatorioPage;
  }else if($perfil == Usuario::ESTUDANTE){
    $menuItems[] = $projetoPage;
  }else if($perfil == Usuario::PROFESSOR || $perfil == Usuario::COMISSAO){
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

function comboPerfis(){
  $user = sfContext::getInstance()->getUser()->getUsuario();
  $perfis = array();
  
  if($user->isSuperAdmin()){
    $perfis[] = link_to("Administrador", "default/perfil", array("perfil" => Usuario::ADMINISTRADOR));
  }
  
  if($user->isProfessor()){
    $perfis[] = link_to("Professor", "default/perfil", array("perfil" => Usuario::PROFESSOR));
  }
  
  if($user->isComissao()){
    $perfis[] = link_to("Comissão", "default/perfil", array("perfil" => Usuario::COMISSAO));
  }  
  
  if(count($perfis) > 1){
    return implode(" | ", $perfis);
  }

}
