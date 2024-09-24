<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Tests;

use Easybill\ZUGFeRD2\Builder;
use Easybill\ZUGFeRD2\Reader;
use Easybill\ZUGFeRD2\Tests\Traits\AssertXmlOutputTrait;
use Easybill\ZUGFeRD2\Tests\Traits\ReformatXmlTrait;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class ReaderTest extends TestCase
{
    use AssertXmlOutputTrait;
    use ReformatXmlTrait;

    /** @dataProvider dataProvider */
    public function testReaderWithExamples(SplFileInfo $fileInfo): void
    {
        $xml = (string)file_get_contents($fileInfo->getRealPath());

        $obj = Reader::create()->transform($xml);
        $str = Builder::create()->transform($obj);

        self::assertSame(
            self::reformatXml($xml),
            self::reformatXml($str),
        );

        self::assertTrue(true);
    }

    /** @return array<string, array<SplFileInfo>> */
    public function dataProvider(): array
    {
        $finder = (new Finder())
            ->files()
            ->name('*.xml')
            ->in(__DIR__ . '/Examples')
        ;


        $buffer = [];
        foreach ($finder as $file) {
            $buffer[$file->getFilename()] = [$file];
        }

        return $buffer;
    }
}
