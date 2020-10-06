<?php

namespace Easybill\ZUGFeRD211;

class Validator
{
    public const SCHEMA_BASIC = __DIR__ . '/Schema/BASIC/FACTUR-X_BASIC.xsd';
    public const SCHEMA_BASIC_WL = __DIR__ . '/Schema/BASIC-WL/FACTUR-X_BASIC-WL.xsd';
    public const SCHEMA_EN16931 = __DIR__ . '/Schema/EN16931/FACTUR-X_EN16931.xsd';
    public const SCHEMA_EXTENDED = __DIR__ . '/Schema/EXTENDED/FACTUR-X_EXTENDED.xsd';
    public const SCHEMA_MINIMUM = __DIR__ . '/Schema/MINIMUM/FACTUR-X_MINIMUM.xsd';

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
            }
            return implode("\n", array_column(libxml_get_errors(), 'message'));
        } finally {
            libxml_use_internal_errors(false);
            libxml_clear_errors();
        }
    }
}
