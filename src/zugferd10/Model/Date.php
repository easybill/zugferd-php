<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class Date
{
    /**
     * @var DateTime
     */
    #[Type(DateTime::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15')]
    #[SerializedName('DateTimeString')]
    private $date;

    /**
     * Date constructor.
     *
     * @param \DateTime|string $date
     * @param int $format
     */
    public function __construct($date, $format = 102)
    {
        $this->date = new DateTime($date, $format);
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date->getTime();
    }

    /**
     * @return int
     */
    public function getFormat()
    {
        return $this->date->getFormat();
    }
}
