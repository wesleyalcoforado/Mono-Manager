<?php use_helper('App'); ?>
<script type="text/javascript" >
var app = {
  init: function(){
    app.createDatePicker("semestre_data_inicio_day", "semestre_data_inicio_month", "semestre_data_inicio_year");
    app.createDatePicker("semestre_data_proposta_day", "semestre_data_proposta_month", "semestre_data_proposta_year");
    app.createDatePicker("semestre_data_apresentacao_day", "semestre_data_apresentacao_month", "semestre_data_apresentacao_year");
  },

  createDatePicker: function(day, month, year){
    var elements = new Object();
    elements[year] = 'Y';
    elements[month] = 'n';
    elements[day] = 'j';

    var opts = {
        formElements: elements
    };

    datePickerController.createDatePicker(opts);
  }
}


$(function() {
  app.init();
});


</script>

<?php
include_partial('form', array('form' => $form));
include_partial('list', array('list' => $list));