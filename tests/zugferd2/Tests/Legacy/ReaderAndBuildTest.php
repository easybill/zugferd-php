<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Tests\Legacy;

use Easybill\ZUGFeRD2\Builder;
use Easybill\ZUGFeRD2\Reader;
use PHPUnit\Framework\TestCase;

class ReaderAndBuildTest extends TestCase
{
    public static function reformatXml(string $xml): string
    {
        $xml = preg_replace('/<!--(.|\s)*?-->/', '', $xml);

        $doc = new \DOMDocument('1.0', 'UTF-8');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($xml);
        return $doc->saveXML();
    }

    /**
     * @before
     */
    public function setupAnnotationRegistry(): void
    {
        // AnnotationRegistry::registerLoader('class_exists');
    }

    /** @dataProvider dataProvider */
    public function testGetDocument(string $filename): void
    {
        $xml = file_get_contents(__DIR__ . '/official_example_xml/' . $filename);
        $obj = Reader::create()->transform($xml);
        $str = Builder::create()->transform($obj);

        self::assertSame(
            self::reformatXml($xml),
            self::reformatXml($str),
        );

        self::assertTrue(true);
    }

    public function dataProvider()
    {
        return [
            ['zugferd_2p1_BASIC-WL_Einfach.xml'],
            ['zugferd_2p1_EN16931_Einfach.xml'],
            ['zugferd_2p1_XRECHNUNG_Einfach.xml'],
        ];
    }
}
