<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
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
