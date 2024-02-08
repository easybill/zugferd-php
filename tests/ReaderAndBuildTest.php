<?php

declare(strict_types=1);

/*
 * This file is part of the ZUGFeRD PHP package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Easybill\ZUGFeRD\Tests;

use DOMDocument;
use Easybill\ZUGFeRD\Builder;
use Easybill\ZUGFeRD\Reader;
use PHPUnit\Framework\TestCase;

class ReaderAndBuildTest extends TestCase
{
    public static function reformatXml(string $xml): string
    {
        $xml = preg_replace('/<!--(.|\s)*?-->/', '', $xml);

        $doc = new DOMDocument('1.0', 'UTF-8');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($xml);

        return $doc->saveXML();
    }

    /** @dataProvider dataProvider */
    public function testGetDocument(string $filename): void
    {
        $xml = file_get_contents(__DIR__ . '/data/official_example_xml/' . $filename);
        $obj = Reader::create()->transform($xml);
        $str = Builder::create()->transform($obj);

        self::assertSame(
            self::reformatXml($xml),
            self::reformatXml($str),
        );

        self::assertTrue(true);
    }

    /**
     * @return array<int, array<int, string>>
     */
    public function dataProvider(): array
    {
        return [
            ['zugferd_2p1_BASIC-WL_Einfach.xml'],
            ['zugferd_2p1_EN16931_Einfach.xml'],
            ['zugferd_2p1_XRECHNUNG_Einfach.xml'],
        ];
    }
}
