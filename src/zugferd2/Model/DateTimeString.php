<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class DateTimeString
{
    #[Type('integer')]
    #[XmlAttribute]
    public int $format;

    #[Type('string')]
    #[XmlValue(cdata: false)]
    public string $value;

    public static function create(int $format, string $value): self
    {
        $self = new self();
        $self->format = $format;
        $self->value = $value;
        return $self;
    }
}
