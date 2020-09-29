<?php

namespace Easybill\ZUGFeRD211\Tests;

use Doctrine\Common\Annotations\AnnotationRegistry;
use DOMDocument;
use Easybill\ZUGFeRD211\Builder;
use Easybill\ZUGFeRD211\Reader;
use PHPUnit\Framework\TestCase;

class ReaderAndBuildTest extends TestCase
{
    private function reformatXml(string $xml): string
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

    public function testGetDocument(): void
    {
        $xml = file_get_contents(__DIR__ . '/zugferd_2p1_BASIC-WL_Einfach.xml');
        $obj = Reader::create()->transform($xml);
        $str = Builder::create()->transform($obj);

        self::assertSame(
            $this->reformatXml($xml),
            $this->reformatXml($str),
        );

        self::assertTrue(true);
    }
}
