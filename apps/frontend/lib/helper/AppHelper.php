<?php

function editButton(){
  return image_tag('icons/edit.png', array('alt' => 'Editar', 'title' => 'Editar'));
}

function deleteButton(){
  return image_tag('icons/delete.png', array('alt' => 'Excluir', 'title' => 'Excluir'));
}

function attachButton(){
  return image_tag('icons/attach.png', array('alt' => 'Anexar proposta', 'title' => 'Anexar proposta'));
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