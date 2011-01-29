<?php

function editButton(){
  return image_tag('icons/edit.png', array('alt' => 'Editar', 'title' => 'Editar'));
}

function deleteButton(){
  return image_tag('icons/delete.png', array('alt' => 'Excluir', 'title' => 'Excluir'));
}

function attachButton($titulo = 'Anexar proposta'){
  return image_tag('icons/attach.png', array('alt' => $titulo, 'title' => $titulo));
}

function viewButton(){
  return image_tag('icons/zoom.png', array('alt' => 'Visualizar proposta', 'title' => 'Visualizar proposta'));
}

function presentationButton(){
  return image_tag('icons/comments.png', array('alt' => 'Solicitar defesa', 'title' => 'Solicitar defesa'));
}

function formatDate($date){
  return date('d/m/Y', strtotime($date));
}

function roundedBox($begin = true){
  $b1 = content_tag('b', '', array('class' => 'b1'));
  $b2 = content_tag('b', '', array('class' => 'b2'));
  $b3 = content_tag('b', '', array('class' => 'b3'));
  $b4 = content_tag('b', '', array('class' => 'b4'));

  $roundedTop = $b1 . $b2 . $b3 . $b4;
  $roundedBottom = $b4 . $b3 . $b3 . $b1;

  if($begin){
    return "<div class='bordaBox'>" . $roundedTop . "<div class='bordaConteudo'>";
  }else{
    return "</div>" . $roundedBottom . "</div>";
  }
}