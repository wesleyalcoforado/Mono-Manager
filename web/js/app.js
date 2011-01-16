$(document).ready(function(){
  $("input[type=text], input[type=password], textarea, #projeto_professor_id").addClass("width400");

  $("input[type=text], input[type=password], textarea, select").addClass("idle");
  $("input[type=text], input[type=password], textarea, select").focus(function(){
    $(this).addClass("activeField").removeClass("idle");
  }).blur(function(){
    $(this).removeClass("activeField").addClass("idle");
  });
});

