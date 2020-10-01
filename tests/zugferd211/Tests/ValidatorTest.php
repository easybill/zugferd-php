<?php

namespace Easybill\ZUGFeRD211\Tests;

use Easybill\ZUGFeRD211\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testXsdSuccess()
    {
        $validator = new Validator();
        $xml = file_get_contents(__DIR__.'/official_example_xml/zugferd_2p1_EN16931_Einfach.xml');
        $errors = $validator->validateAgainstXsd($xml, __DIR__ . '/../../../src/zugferd211/Schema/EN16931/FACTUR-X_EN16931.xsd');
        self::assertNull($errors, $errors ?? '');
    }

    public function testXsdFail()
    {
        $validator = new Validator();
        $xml = file_get_contents(__DIR__.'/broken_example.xml');
        $errors = $validator->validateAgainstXsd($xml, __DIR__ . '/../../../src/zugferd211/Schema/EN16931/FACTUR-X_EN16931.xsd');
        self::assertNotNull($errors, 'Validator says broken xml is valid.');
    }

}
