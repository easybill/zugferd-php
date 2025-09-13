<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Tests;

use Easybill\ZUGFeRD2\Builder;
use Easybill\ZUGFeRD2\Reader;
use Easybill\ZUGFeRD2\Tests\Traits\AssertXmlOutputTrait;
use Easybill\ZUGFeRD2\Tests\Traits\ReformatXmlTrait;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class ReaderTest extends TestCase
{
    use AssertXmlOutputTrait;
    use ReformatXmlTrait;

    #[DataProvider('dataProvider')]
    public function testReaderWithExamples(SplFileInfo $fileInfo): void
    {
        $xml = (string)file_get_contents($fileInfo->getRealPath());

        $obj = Reader::create()->transform($xml);
        $str = Builder::create()->transform($obj);

        self::assertSame(
            self::reformatXml($xml),
            self::reformatXml($str),
        );
    }

    /** @return \Generator<string, array<SplFileInfo>> */
    public static function dataProvider(): \Generator
    {
        $finder = (new Finder())
            ->files()
            ->name('*.xml')
            ->in(__DIR__ . '/Examples')
        ;

        foreach ($finder as $file) {
            yield $file->getFilename() => [$file];
        }
    }
}
