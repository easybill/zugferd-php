<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use Easybill\ZUGFeRD\Model\Date;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class DeliveryChainEvent
{
    /**
     * @var Date
     */
    #[Type(Date::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('OccurrenceDateTime')]
    private $date;

    /**
     * ChainEvent constructor.
     *
     * @param string $date
     * @param int $format
     */
    public function __construct($date = '', $format = 102)
    {
        $this->date = new Date($date, $format);
    }

    /**
     * @return Date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param Date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}
