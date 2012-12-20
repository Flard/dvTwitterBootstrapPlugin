<?php
/**
 * Created by JetBrains PhpStorm.
 * User: van Horck
 * Date: 1-11-11
 * Time: 18:10
 * To change this template use File | Settings | File Templates.
 */
 
class sfWidgetFormSchemaFormatterBootstrapHorizontal extends sfWidgetFormSchemaFormatter {

    protected
        $rowFormat       = "<div class=\"control-group %extra_classes%\">\n  %label%\n  <div class=\"controls\">%field%%error%%help%</div>\n%hidden_fields%</div>\n",
        $inlineRowFormat       = "<div class=\"control-group %extra_classes%\">\n  <div class=\"controls\">%field%\n  %error%%help%</div>\n%hidden_fields%</div>\n",
        $errorRowFormat  = "<li>\n%errors%</li>\n",
        $helpFormat      = '<span class="help-block">%help%</span>',
        $errorListFormatInARow = '<span class="help-inline">%errors%</span>',
        $errorRowFormatInARow = '%error%',
        $decoratorFormat = "%content%";

    public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
    {
        if (count($errors) > 0) {
            $extraClasses = ' error';
        } else {
            $extraClasses = '';
        }

        $isInlineRow = (strpos($field, 'type="checkbox"') !== false);
        $label = str_replace('<label for=', '<label class="control-label" for=', $label);

        $rowFormat = $isInlineRow ? $this->inlineRowFormat : $this->rowFormat;

        if ($isInlineRow) {
            $field = '<label class="checkbox">'.$field . strip_tags($label).'</label>';
        }

        return strtr($rowFormat, array(
          '%extra_classes%' => $extraClasses,
          '%label%'         => $label,
          '%field%'         => $field,
          '%error%'         => $this->formatErrorsForRow($errors),
          '%help%'          => $this->formatHelp($help),
          '%hidden_fields%' => null === $hiddenFields ? '%hidden_fields%' : $hiddenFields,
        ));
    }
}
