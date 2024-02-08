<?php

declare(strict_types=1);

/*
 * This file is part of the CFONB Parser package.
 *
 * (c) SILARHI <dev@silarhi.fr>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\AnnotationToAttributeRector;
use Rector\Php80\ValueObject\AnnotationToAttribute;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $config): void {
    $config->importShortClasses();
    $config->importNames();

    $config->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $config->import(LevelSetList::UP_TO_PHP_80);
    $config->import(SetList::CODE_QUALITY);

    $config->ruleWithConfiguration(AnnotationToAttributeRector::class, [
        new AnnotationToAttribute('JMS\Serializer\Annotation\SerializedName'),
        new AnnotationToAttribute('JMS\Serializer\Annotation\Type'),
        new AnnotationToAttribute('JMS\Serializer\Annotation\XmlValue'),
        new AnnotationToAttribute('JMS\Serializer\Annotation\XmlAttribute'),
        new AnnotationToAttribute('JMS\Serializer\Annotation\XmlElement'),
        new AnnotationToAttribute('JMS\Serializer\Annotation\XmlList'),
    ]);
};
