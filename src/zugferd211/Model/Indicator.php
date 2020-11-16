<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation as JMS;

class Indicator
{
    /**
     * @JMS\Type("boolean")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100")
     * @JMS\SerializedName("Indicator")
     */
    public bool $indicator;
}
