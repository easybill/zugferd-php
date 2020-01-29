<?php

namespace Easybill\ZUGFeRD;


class SchemaValidator {

    /**
     * Validates the given XML-string against the ZUGFeRD XSD-files.
     */
    public static function isValid(string $xml, string $standard = 'zugferd.de.1p0'): bool {
        $xmlValidate = new \DOMDocument();
        $xmlValidate->loadXML($xml);
        switch ($standard) {
            case "zugferd.de.1p0":
            case "invoice:1p0":
                return $xmlValidate->schemaValidate(__DIR__ . '/Assets/Schema/ZUGFeRD1p0.xsd');
                break;
            case "zugferd.de.2p0":
            case "factur-x.eu:1p0":
                return $xmlValidate->schemaValidate(__DIR__ . '/Assets/Schema/zugferd2p0_en16931.xsd');
                break;

        }


    }
}