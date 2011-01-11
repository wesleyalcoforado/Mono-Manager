<?php
class sfWidgetFormSchemaFormatterDivForm extends sfWidgetFormSchemaFormatter {
    protected
        $rowFormat                 = "<div class='rowElem'>%label%%error%%field%%help%%hidden_fields%</div>",
        $helpFormat                = '<span class="help">%help%</span>',
        $errorRowFormat            = '<dt class="error">Errors:</dt><dd>%errors%</dd>',
        $errorListFormatInARow     = '<ul class="error_list">%errors%</ul>',
        $errorRowFormatInARow      = '<li>%error%</li>',
        $namedErrorRowFormatInARow = '<li>%name%: %error%</li>',
        $decoratorFormat           = '<dl id="formContainer">%content%</dl>';
}
