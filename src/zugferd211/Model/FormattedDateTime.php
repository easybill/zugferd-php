<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class FormattedDateTime
{
    /**
     * @Type("Easybill\ZUGFeRD211\Model\DateTimeString")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:QualifiedDataType:100")
     * @SerializedName("DateTimeString")
     */
    public DateTimeString $dateTimeString;

    public static function create(int $format, string $value): self
    {
        $self = new self();
        $self->dateTimeString = DateTimeString::create($format, $value);
        return $self;
    }
}
