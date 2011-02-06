<script type="text/javascript" >
var init = app.init;
app.init = function(){
  init();
  app.createDatePicker("defesa_data_sugestao_day", "defesa_data_sugestao_month", "defesa_data_sugestao_year");
}
</script>

<h1>Defesas</h1>
<?php
include_partial('form', array('form' => $form, 'projetoId' => $projetoId, 'maxFileSize' => $maxFileSize));