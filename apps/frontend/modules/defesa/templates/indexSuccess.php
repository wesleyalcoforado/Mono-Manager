<script type="text/javascript" >
var app = {
  init: function(){
    app.createDatePicker("defesa_data_sugestao_day", "defesa_data_sugestao_month", "defesa_data_sugestao_year");
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

<h1>Defesas</h1>
<?php
include_partial('form', array('form' => $form, 'projetoId' => $projetoId, 'maxFileSize' => $maxFileSize));