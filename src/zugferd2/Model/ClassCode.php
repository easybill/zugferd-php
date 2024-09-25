<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class ClassCode
{
    #[Type('string')]
    #[XmlAttribute]
    #[SerializedName('listID')]
    public ?string $listID = null;

    #[Type('string')]
    #[XmlValue(cdata: false)]
    public string $value;

    public static function create(string $id, ?string $listID = null): self
    {
        $self = new self();
        $self->value = $id;
        $self->listID = $listID;
        return $self;
    }
}
