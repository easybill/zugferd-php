<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Tests\Traits;

trait ReformatXmlTrait
{
    public static function reformatXml(string $xml): string
    {
        $xml = (string) preg_replace('/<!--(.|\s)*?-->/', '', $xml);

        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($xml);
        return (string) $doc->saveXML();
    }
}
