<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD211\Tests;

use Easybill\ZUGFeRD211\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testXsdSuccess()
    {
        $validator = new Validator();
        $xml = file_get_contents(__DIR__ . '/official_example_xml/zugferd_2p1_EN16931_Einfach.xml');
        $errors = $validator->validateAgainstXsd($xml, Validator::SCHEMA_EN16931);
        self::assertNull($errors, $errors ?? '');
    }

    public function testXsdFail()
    {
        $validator = new Validator();
        $xml = file_get_contents(__DIR__ . '/broken_example.xml');
        $errors = $validator->validateAgainstXsd($xml, Validator::SCHEMA_EN16931);
        self::assertNotNull($errors, 'Validator says broken xml is valid.');
    }
}
