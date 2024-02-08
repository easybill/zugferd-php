<?php

namespace Easybill\ZUGFeRD\Tests;

use PHPUnit\Framework\TestCase;
use Easybill\ZUGFeRD\Validator;

class ValidatorTest extends TestCase
{
    public function testXsdSuccess(): void
    {
        $validator = new Validator();
        $xml = file_get_contents(__DIR__ . '/data/official_example_xml/zugferd_2p1_EN16931_Einfach.xml');
        $errors = $validator->validateAgainstXsd($xml, Validator::SCHEMA_EN16931);
        self::assertNull($errors, $errors ?? '');
    }

    public function testXsdFail(): void
    {
        $validator = new Validator();
        $xml = file_get_contents(__DIR__ . '/data/broken_example.xml');
        $errors = $validator->validateAgainstXsd($xml, Validator::SCHEMA_EN16931);
        self::assertNotNull($errors, 'Validator says broken xml is valid.');
    }
}
