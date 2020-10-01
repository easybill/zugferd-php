<?php

namespace Easybill\ZUGFeRD211;

class Validator
{
    public function validateAgainstXsd(string $xml, string $schemaFile): ?string
    {
        $domDoc = new \DOMDocument();
        $domDoc->loadXML($xml);

        try {
            libxml_use_internal_errors(true);
            libxml_clear_errors();
            $isValid = $domDoc->schemaValidate($schemaFile);
            if ($isValid) {
                return null;
            } else {
                return implode("\n", array_column(libxml_get_errors(), 'message'));
            }
        } finally {
            libxml_use_internal_errors(false);
            libxml_clear_errors();
        }
    }
}
