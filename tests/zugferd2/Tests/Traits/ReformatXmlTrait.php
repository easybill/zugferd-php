<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Tests\Traits;

use Composer\Pcre\Preg;

trait ReformatXmlTrait
{
    public static function reformatXml(string $xml): string
    {
        $xml = (string)preg_replace('/<!--(.|\s)*?-->/', '', $xml);

        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($xml);

        if ($doc->documentElement instanceof \DOMElement) {
            self::sortElementAttributes($doc->documentElement);
        }

        $result = (string)$doc->saveXML();

        return self::sortRootXmlnsAttributes($result);
    }

    // Attribute order is not significant in XML, but the official examples and our serializer
    // emit some attributes (e.g. mimeCode/filename on AttachmentBinaryObject) in different orders.
    // Normalise by sorting each element's non-namespaced attributes so byte comparison ignores order.
    // Elements carrying prefixed attributes (e.g. xsi:*) are left untouched to preserve bindings.
    private static function sortElementAttributes(\DOMElement $element): void
    {
        if ($element->hasAttributes()) {
            /** @var array<string, string> $attributes */
            $attributes = [];
            $prefixed = false;
            foreach (iterator_to_array($element->attributes) as $attribute) {
                // Intentionally skip the whole element if it carries any prefixed attribute
                // (e.g. xsi:type, xml:lang) to avoid disturbing namespace bindings. xmlns:*
                // declarations are namespace nodes and never appear here.
                if (str_contains($attribute->nodeName, ':')) {
                    $prefixed = true;
                    break;
                }
                $attributes[$attribute->nodeName] = (string)$attribute->nodeValue;
            }

            if (!$prefixed) {
                $names = array_keys($attributes);
                $sorted = $names;
                sort($sorted, SORT_STRING);

                if ($names !== $sorted) {
                    foreach ($names as $name) {
                        $element->removeAttribute($name);
                    }
                    foreach ($sorted as $name) {
                        $element->setAttribute($name, $attributes[$name]);
                    }
                }
            }
        }

        foreach (iterator_to_array($element->childNodes) as $child) {
            if ($child instanceof \DOMElement) {
                self::sortElementAttributes($child);
            }
        }
    }

    // In the newer examples (2.4) the root xmlns attributes differ from the previous version
    // to avoid any conflicts we just sort them.
    private static function sortRootXmlnsAttributes(string $xml): string
    {
        if (!Preg::isMatch('/^(<\?xml[^?]*\?>\s*)?(<[a-zA-Z0-9:]+)\s+([^>]+)>/s', $xml, $matches)) {
            return $xml;
        }

        $xmlDecl = $matches[1];
        $rootTag = $matches[2];
        $attributesStr = $matches[3];

        preg_match_all('/([a-zA-Z0-9:_-]+)="([^"]*)"/', (string)$attributesStr, $attrMatches, PREG_SET_ORDER);

        $attributes = [];
        foreach ($attrMatches as $attr) {
            $name = $attr[1];
            $value = $attr[2];

            if (str_starts_with($name, 'xmlns:')) {
                $prefix = substr($name, 6);

                if (!Preg::isMatch('/<' . preg_quote($prefix, '/') . ':/', $xml)) {
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

        return Preg::replace('/^(<\?xml[^?]*\?>\s*)?<[a-zA-Z0-9:]+\s+[^>]+>/s', $xmlDecl . $newRootElement, $xml, 1);
    }
}
