<?php
class sfWidgetFormSchemaFormatterDivForm extends sfWidgetFormSchemaFormatter {
    protected
        $rowFormat                 = "%label%%error%%field%%help%%hidden_fields%<br clear='both'/>",
        $helpFormat                = '<span class="help">%help%</span>',
        $errorRowFormat            = '<dt class="error">Errors:</dt><dd>%errors%</dd>',
        $errorListFormatInARow     = '<ul class="error_list">%errors%</ul>',
        $errorRowFormatInARow      = '<li>%error%</li>',
        $namedErrorRowFormatInARow = '<li>%name%: %error%</li>',
        $decoratorFormat           = '<dl id="formContainer">%content%</dl>';
}
