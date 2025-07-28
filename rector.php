<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Symfony\Set\JMSSetList;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNativeCallRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src/zugferd2',
    ])
    ->withPhpSets(php82: true)
    ->withRules([])
    ->withSets([]);
