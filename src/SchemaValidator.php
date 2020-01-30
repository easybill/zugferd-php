<?php

namespace Easybill\ZUGFeRD;


class SchemaValidator {

    /**
     * Validates the given XML-string against the ZUGFeRD XSD-files.
     */
    public static function isValid(string $xml, string $standard = 'zugferd.de.1p0'): bool {
        $xmlValidate = new \DOMDocument();
        libxml_use_internal_errors(true);
        $xmlValidate->loadXML($xml);
        $result = false;
        switch ($standard) {
            case "zugferd.de.1p0":
            case "invoice:1p0":
                $result = $xmlValidate->schemaValidate(__DIR__ . '/Assets/Schema/ZUGFeRD1p0.xsd');
                break;
            case "zugferd.de.2p0":
            case "factur-x.eu:1p0":
                $result = $xmlValidate->schemaValidate(__DIR__ . '/Assets/Schema/zugferd2p0_en16931.xsd');
                break;

        }

        if (!$result) {
            var_dump(SchemaValidator::libxml_display_errors());
            return false;
        } else
            return true;


    }

    public static function libxml_display_error($error) {
        $return = "<br/>\n";
        switch ($error->level) {
            case LIBXML_ERR_WARNING:
                $return .= "<b>Warning $error->code</b>: ";
                break;
            case LIBXML_ERR_ERROR:
                $return .= "<b>Error $error->code</b>: ";
                break;
            case LIBXML_ERR_FATAL:
                $return .= "<b>Fatal Error $error->code</b>: ";
                break;
        }
        $return .= trim($error->message);
        $return .= " on line <b>$error->line</b>\n";
        return $return;
    }

    public static function libxml_display_errors() {
        $errors = libxml_get_errors();
        $error_list = array();
        foreach ($errors as $error) {
            $error_list[] = SchemaValidator::libxml_display_error($error);
        }
        libxml_clear_errors();
        $retval = implode('<br>', $error_list);
        return $retval;
    }
}