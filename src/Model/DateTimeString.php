<?php

declare(strict_types=1);

/*
 * This file is part of the ZUGFeRD PHP package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation as JMS;

class DateTimeString
{
    #[JMS\Type('integer')]
    #[JMS\XmlAttribute]
    public int $format;

    #[JMS\Type('string')]
    #[JMS\XmlValue(cdata: false)]
    public string $value;

    public static function create(int $format, string $value): self
    {
        $self = new self();
        $self->format = $format;
        $self->value = $value;

        return $self;
    }
}
