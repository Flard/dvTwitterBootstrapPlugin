<?php

class dvWidgetFormSchemaFormatterBootstrap extends sfWidgetFormSchemaFormatter {

    protected
        $rowFormat       = "<div class=\"control-group%extra_classes%\">\n  %label%\n  %field%%error%%help%\n%hidden_fields%</div>\n",
        $errorRowFormat  = "<li>\n%errors%</li>\n",
        $helpFormat      = '<span class="help-block">%help%</span>',
        $errorListFormatInARow = '<span class="help-inline">%errors%</span>',
        $errorRowFormatInARow = '%error%',
        $requiredTemplate= '<pow class="requiredFormItem">*</pow>',
        $decoratorFormat = "%content%";
    protected $validatorSchema = null;

    public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
    {
        $p = strpos($label, 'for="');
        if (false !== $p) {
            $p += 5;
            $p2 = strpos($label, '"', $p+1);
            $p2 = $p2 - $p;
            $extraClasses = ' '.substr($label, $p, $p2);
        } else {
            $extraClasses = ' ';
        }
        if (count($errors) > 0) {
            $extraClasses .= ' error';
        }


        return strtr($this->getRowFormat(), array(
            '%extra_classes%' => $extraClasses,
            '%label%'         => $label,
            '%field%'         => $field,
            '%error%'         => $this->formatErrorsForRow($errors),
            '%help%'          => $this->formatHelp($help),
            '%hidden_fields%' => null === $hiddenFields ? '%hidden_fields%' : $hiddenFields,
        ));
    }

    public function generateLabelName($name)
    {
        $label = parent::generateLabelName($name);

        if (isset($this->validatorSchema)) {

            $fields = $this->validatorSchema->getFields();
            if($fields[$name] != null) {
                $field = $fields[$name];
                if($field->hasOption('required') && $field->getOption('required')) {
                    $label .= $this->requiredTemplate;
                }
            }
            $label .= ':';

        }
        return $label;
    }

    public function setValidatorSchema(sfValidatorSchema $validatorSchema)
    {
        $this->validatorSchema = $validatorSchema;
    }
}