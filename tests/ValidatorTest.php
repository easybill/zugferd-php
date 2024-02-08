<?php

declare(strict_types=1);

/*
 * This file is part of the ZUGFeRD PHP package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Easybill\ZUGFeRD\Tests;

use Easybill\ZUGFeRD\Validator;
use PHPUnit\Framework\TestCase;

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
