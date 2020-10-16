<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class Amount
{
    /**
     * @Type("string")
     * @XmlValue(cdata = false)
     */
    public string $value;

    /**
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("currencyID")
     */
    public ?string $currency = null;

    public static function create(string $amount, ?string $currency = null): self
    {
        $self = new self();
        $self->value = $amount;
        $self->currency = $currency;
        return $self;
    }
}
