<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Tests\Traits;

trait ReformatXmlTrait
{
    public static function reformatXml(string $xml): string
    {
        $xml = (string)preg_replace('/<!--(.|\s)*?-->/', '', $xml);

        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($xml);
        $result = (string)$doc->saveXML();

        return self::sortRootXmlnsAttributes($result);
    }

    // In the newer examples (2.4) the root xmlns attributes differ from the previous version
    // to avoid any conflicts we just sort them.
    private static function sortRootXmlnsAttributes(string $xml): string
    {
        if (!preg_match('/^(<\?xml[^?]*\?>\s*)?(<[a-zA-Z0-9:]+)\s+([^>]+)>/s', $xml, $matches)) {
            return $xml;
        }

        $xmlDecl = $matches[1];
        $rootTag = $matches[2];
        $attributesStr = $matches[3];

        preg_match_all('/([a-zA-Z0-9:_-]+)="([^"]*)"/', $attributesStr, $attrMatches, PREG_SET_ORDER);

        $attributes = [];
        foreach ($attrMatches as $attr) {
            $name = $attr[1];
            $value = $attr[2];

            if (str_starts_with($name, 'xmlns:')) {
                $prefix = substr($name, 6);

                if (!preg_match('/<' . preg_quote($prefix, '/') . ':/', $xml)) {
                    continue;
                }
            }

            $attributes[$name] = $value;
        }

        ksort($attributes);

        $newAttributes = [];
        foreach ($attributes as $name => $value) {
            $newAttributes[] = $name . '="' . $value . '"';
        }

        $newRootElement = $rootTag . ' ' . implode(' ', $newAttributes) . '>';

        return preg_replace('/^(<\?xml[^?]*\?>\s*)?<[a-zA-Z0-9:]+\s+[^>]+>/s', $xmlDecl . $newRootElement, $xml, 1);
    }
}
