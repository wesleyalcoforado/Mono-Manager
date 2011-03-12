<?php use_helper('App'); ?>
<script type="text/javascript" >
var init = app.init;
app.init = function(){
  init();
  app.createDatePicker("semestre_data_colacao_day", "semestre_data_colacao_month", "semestre_data_colacao_year");
  app.createDatePicker("semestre_data_colacao_especial_day", "semestre_data_colacao_especial_month", "semestre_data_colacao_especial_year");
  app.createDatePicker("semestre_data_max_proposta_day", "semestre_data_max_proposta_month", "semestre_data_max_proposta_year");
  app.createDatePicker("semestre_data_max_copiao_day", "semestre_data_max_copiao_month", "semestre_data_max_copiao_year");
  app.createDatePicker("semestre_data_max_defesa_day", "semestre_data_max_defesa_month", "semestre_data_max_defesa_year");
}
</script>

<h1>Semestres</h1>

<?php
include_partial('form', array('form' => $form));
include_partial('list', array('list' => $list));