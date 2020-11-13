<?php

namespace Easybill\ZUGFeRD;

class SchemaValidator
{
    /**
     * Validates the given XML-string against the ZUGFeRD XSD-files.
     */
    public static function isValid(string $xml): bool
    {
        $xmlValidate = new \DOMDocument();
        $xmlValidate->loadXML($xml);
        return $xmlValidate->schemaValidate(__DIR__ . '/Assets/Schema/ZUGFeRD1p0.xsd');
    }
}
