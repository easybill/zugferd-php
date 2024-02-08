<?php

declare(strict_types=1);

/*
 * This file is part of the ZUGFeRD PHP package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class Amount
{
    #[Type('string')]
    #[XmlValue(cdata: false)]
    public string $value;

    #[Type('string')]
    #[XmlAttribute]
    #[SerializedName('currencyID')]
    public ?string $currency = null;

    public static function create(string $amount, ?string $currency = null): self
    {
        $self = new self();
        $self->value = $amount;
        $self->currency = $currency;

        return $self;
    }
}
