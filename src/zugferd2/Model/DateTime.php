<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class DateTime
{
    #[Type(DateTimeString::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100')]
    #[SerializedName('DateTimeString')]
    public DateTimeString $dateTimeString;

    public static function create(int $format, string $value): self
    {
        $self = new self();
        $self->dateTimeString = DateTimeString::create($format, $value);
        return $self;
    }
}
