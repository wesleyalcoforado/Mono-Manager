<?php use_helper('App'); ?>
<script type="text/javascript" >
var init = app.init;
app.init = function(){
  init();
  app.createDatePicker("semestre_data_inicio_day", "semestre_data_inicio_month", "semestre_data_inicio_year");
  app.createDatePicker("semestre_data_proposta_day", "semestre_data_proposta_month", "semestre_data_proposta_year");
  app.createDatePicker("semestre_data_apresentacao_day", "semestre_data_apresentacao_month", "semestre_data_apresentacao_year");
}
</script>

<h1>Semestres</h1>

<?php
include_partial('form', array('form' => $form));
include_partial('list', array('list' => $list));