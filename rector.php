<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\BooleanAnd\RepeatedAndNotEqualToNotInArrayRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPromotedPropertyRector;
use Rector\PHPUnit\CodeQuality\Rector\Class_\PreferPHPUnitThisCallRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    // uncomment to reach your current PHP version
    ->withPhpSets()
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        phpunitCodeQuality: true,
    )
    ->withComposerBased(
        phpunit: true
    )
    ->withSkip([
        PreferPHPUnitThisCallRector::class,
        RepeatedAndNotEqualToNotInArrayRector::class,
        RemoveUnusedPromotedPropertyRector::class => __DIR__ . '/src/zugferd10/Model/ContextParameterID.php',
    ])
;
