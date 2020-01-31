<?php

namespace Easybill\ZUGFeRD\Tests;

use Doctrine\Common\Annotations\AnnotationRegistry;
use DOMDocument;
use Easybill\ZUGFeRD\Builder;
use Easybill\ZUGFeRD\ModelV2\Invoice;
use Easybill\ZUGFeRD\Reader;
use Easybill\ZUGFeRD\SchemaValidator;
use PHPUnit\Framework\TestCase;

class BuilderReaderTest extends TestCase
{

    /**
     * @before
     */
    public function setupAnnotationRegistry(): void
    {
        AnnotationRegistry::registerLoader('class_exists');
    }

    public function testGetDocument(): void
    {

        $reader = Reader::create();

        $doc = $reader->getDocument(file_get_contents(__DIR__ . '/zugferd-invoice.xml'),'zugferd.de.2p0');
        $this->assertInstanceOf(Invoice::class, $doc);
        $xml = Builder::create()->getXMLv2($doc);
        $this->assertTrue(SchemaValidator::isValid($xml,'zugferd.de.2p0'));


        $expected = new DOMDocument;
        $expected_xml = file_get_contents(__DIR__ . '/zugferd-invoice.xml');
        $expected->loadXML($expected_xml);
        $actual = new DOMDocument;
        $actual->loadXML($xml);
        $this->assertEqualXMLStructure(
            $expected->firstChild, $actual->firstChild
        );

    }



}
