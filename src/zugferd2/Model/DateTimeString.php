<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

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
