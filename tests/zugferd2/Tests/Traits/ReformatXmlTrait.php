<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Tests\Traits;

trait ReformatXmlTrait
{
    public static function orderCrossIndustryInvoiceAttributes(string $xml): string
    {
        return (string)preg_replace_callback('/<rsm:CrossIndustryInvoice (((xmlns:(\w)+="[^"]+")\s*)+)>/', function (array $matches) {
            $parts = explode(' ', $matches[1]);

            foreach ($parts as $i => $part) {
                // Some french PDF have xmlns:xsi instead of xs
                if (str_starts_with($part, 'xmlns:xs')) {
                    unset($parts[$i]);
                }
            }

            sort($parts);

            return sprintf('<rsm:CrossIndustryInvoice %s>', implode(' ', $parts));
        }, $xml);
    }

    public static function reformatXml(string $xml): string
    {
        $xml = (string)preg_replace('/<!--(.|\s)*?-->/', '', $xml);

        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($xml);

        return self::orderCrossIndustryInvoiceAttributes((string)$doc->saveXML());
    }
}
