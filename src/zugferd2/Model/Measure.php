<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class Measure
{
    #[Type('string')]
    #[XmlAttribute]
    #[SerializedName('unitCode')]
    public ?string $unitCode = null;

    #[Type('int')]
    #[XmlValue(cdata: false)]
    public ?int $value = null;
}
