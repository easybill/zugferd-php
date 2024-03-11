<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Set\JMSSetList;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNativeCallRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictScalarReturnExprRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src/zugferd2',
    ])
    ->withPhpSets(php81: true)
    ->withRules([
        ReturnTypeFromStrictNativeCallRector::class,
        ReturnTypeFromStrictScalarReturnExprRector::class,
    ])
    ->withSets([
        JMSSetList::ANNOTATIONS_TO_ATTRIBUTES,
    ]);
