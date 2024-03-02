<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation as JMS;

class BinaryObject
{
    #[JMS\Type('string')]
    #[JMS\XmlAttribute]
    #[JMS\SerializedName('mimeCode')]
    public string $mimeCode;

    #[JMS\Type('string')]
    #[JMS\XmlAttribute]
    #[JMS\SerializedName('filename')]
    public string $filename;

    #[JMS\Type('string')]
    #[JMS\XmlValue(cdata: false)]
    public string $value;
}
