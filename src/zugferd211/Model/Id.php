<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class Id
{
    /**
     * @var string
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("schemeID")
     */
    public $schemeID;

    /**
     * @var string
     * @Type("string")
     * @XmlValue(cdata = false)
     */
    public $value;

    public static function create(string $id, ?string $schemeID = null): self
    {
        $self = new self();
        $self->value = $id;
        $self->schemeID = $schemeID;
        return $self;
    }
}
