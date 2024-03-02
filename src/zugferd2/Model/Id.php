<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class Id
{
    #[Type('string')]
    #[XmlAttribute]
    #[SerializedName('schemeID')]
    public ?string $schemeID = null;

    #[Type('string')]
    #[XmlValue(cdata: false)]
    public string $value;

    public static function create(string $id, ?string $schemeID = null): self
    {
        $self = new self();
        $self->value = $id;
        $self->schemeID = $schemeID;
        return $self;
    }
}
