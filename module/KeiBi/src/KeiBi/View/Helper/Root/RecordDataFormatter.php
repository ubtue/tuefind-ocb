<?php
namespace KeiBi\View\Helper\Root;

class RecordDataFormatter extends \TueFind\View\Helper\Root\RecordDataFormatter
{ 
    // Adjust if needed
    protected function render($driver, $field, $data, $options) {
        return parent::render($driver, $field, $data, $options);
    }
}
