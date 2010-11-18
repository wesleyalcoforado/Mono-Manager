<script type="text/javascript" >
Ext.onReady(function(){
    var grid = new Ext.ux.grid.TableGrid("listagem", {
        stripeRows: true
    });
    grid.render();
});
</script>

<?php
include_partial('form', array('form' => $form));
include_partial('list', array('semestres' => $semestres));