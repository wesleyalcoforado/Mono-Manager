<script type="text/javascript" >
Ext.onReady(function(){
    var grid = new Ext.ux.grid.TableGrid("listagem", {
        stripeRows: true
    });
    grid.render();

    var opts = {
        formElements:{
            "semestre_data_inicio_year":"Y",
            "semestre_data_inicio_month":"n",
            "semestre_data_inicio_day":"j"
        }
    };
    datePickerController.createDatePicker(opts);
});
</script>

<?php
include_partial('form', array('form' => $form));
include_partial('list', array('semestres' => $semestres));