<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation as JMS;

class DateTimeString
{
    /**
     * @var int
     * @JMS\Type("integer")
     * @JMS\XmlAttribute
     */
    public $format;

    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlValue(cdata=false)
     */
    public $time;
}
