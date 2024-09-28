<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Set\JMSSetList;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNativeCallRector;

return RectorConfig::configure()
    ->withImportNames()
    ->withPaths([
        __DIR__ . '/src/zugferd2',
        __DIR__ . '/tests/zugferd2',
    ])
    ->withPhpSets()
    ->withPreparedSets(codeQuality: true, deadCode: true)
    ->withRules([
        ReturnTypeFromStrictNativeCallRector::class,
    ])
    ->withSets([
        JMSSetList::ANNOTATIONS_TO_ATTRIBUTES,
    ])
;
