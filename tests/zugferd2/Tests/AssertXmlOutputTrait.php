<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Tests;

use Easybill\ZUGFeRD2\Builder;
use Easybill\ZUGFeRD2\Model\CrossIndustryInvoice;
use Easybill\ZUGFeRD2\Tests\Legacy\ReaderAndBuildTest;
use Easybill\ZUGFeRD2\Validator;

trait AssertXmlOutputTrait
{
    private function buildAndAssertXmlFromCII(CrossIndustryInvoice $invoice, string $referenceFilePath, string $validatorSchema): void
    {
        $xml = Builder::create()->transform($invoice);
        self::assertNotEmpty($xml);

        $referenceFile = file_get_contents($referenceFilePath);
        $referenceFile = ReaderAndBuildTest::reformatXml($referenceFile);

        $xml = ReaderAndBuildTest::reformatXml($xml);
        self::assertEquals($referenceFile, $xml);

        $result = (new Validator())->validateAgainstXsd($xml, $validatorSchema);
        self::assertNull($result, $result ?? '');
    }
}
