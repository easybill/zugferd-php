<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class BinaryObject
{
    #[Type('string')]
    #[XmlAttribute]
    #[SerializedName('mimeCode')]
    public string $mimeCode;

    #[Type('string')]
    #[XmlAttribute]
    #[SerializedName('filename')]
    public string $filename;

    #[Type('string')]
    #[XmlValue(cdata: false)]
    public string $value;
}
