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

function viewButton($enabled = true, $title = 'Visualizar proposta'){
  $img = 'icons/zoom.png';
  if(!$enabled)
    $img = 'icons/zoom_grey.png';

  return image_tag($img, array('alt' => $title, 'title' => $title));
}

function presentationButton($enabled = true, $titulo = 'Solicitar defesa'){
  $img = 'icons/presentation.png';
  if(!$enabled)
    $img = 'icons/presentation_grey.png';

  return image_tag($img, array('alt' => $titulo, 'title' => $titulo));
}

function finalDocumentButton(){
  return image_tag('icons/pdf.png', array('alt' => 'Enviar documento final', 'title' => 'Enviar documento final'));
}

function approveButton($enabled = true, $titulo = 'Aprovar proposta'){
  $img = "icons/thumb_up.png";
  if(!$enabled){
    $img = "icons/thumb_up_grey.png";
  }

  return image_tag($img, array('alt' => $titulo, 'title' => $titulo));
}

function tickButton($enabled = true){
  $img = "icons/tick.png";
  $title = "Marcar projeto como defendido";
  if(!$enabled){
    $img = "icons/tick_grey.png";
    $title = "Projeto defendido";
  }

  return image_tag($img, array('alt' => $title, 'title' => $title));
}

function hammerButton(){
  return image_tag('icons/judge.png', array('alt' => "Avaliar proposta", 'title' => "Avaliar proposta"));
}

function commentsButton(){
  return image_tag('icons/comments.png', array('alt' => "Visualizar comentários", 'title' => "Visualizar comentários"));
}

function disapproveButton($enabled = true, $titulo = 'Desaprovar proposta'){
  $img = "icons/thumb_down.png";
  if(!$enabled){
    $img = "icons/thumb_down_grey.png";
  }

  return image_tag($img, array('alt' => $titulo, 'title' => $titulo));
}

function cancelButton(){
  return image_tag('icons/cancel.png');
}

function formatDate($date){
  if($date){
    return date('d/m/Y', strtotime($date));
  }

  return "-";
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