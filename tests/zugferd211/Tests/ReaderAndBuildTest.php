<?php

namespace Easybill\ZUGFeRD211\Tests;

use Doctrine\Common\Annotations\AnnotationRegistry;
use DOMDocument;
use Easybill\ZUGFeRD211\Builder;
use Easybill\ZUGFeRD211\Reader;
use PHPUnit\Framework\TestCase;

class ReaderAndBuildTest extends TestCase
{
    public static function reformatXml(string $xml): string
    {
        $xml = preg_replace('/<!--(.|\s)*?-->/', '', $xml);

        $doc = new DomDocument('1.0', 'UTF-8');
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
        AnnotationRegistry::registerLoader('class_exists');
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
