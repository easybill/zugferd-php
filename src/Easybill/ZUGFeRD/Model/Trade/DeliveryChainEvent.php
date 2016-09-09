<?php

namespace Easybill\ZUGFeRD\Model\Trade;

use Easybill\ZUGFeRD\Model\Date;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Class ChainEvent
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12", prefix="ram")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15", prefix="udt")
 * @package Easybill\ZUGFeRD\Model\Trade\Delivery
 */
class DeliveryChainEvent
{

    /**
     * @var Date
     * @Type("Easybill\ZUGFeRD\Model\Date")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("OccurrenceDateTime")
     */
    private $date;

    /**
     * ChainEvent constructor.
     *
     * @param string $date
     * @param int $format
     */
    public function __construct($date = '', $format)
    {
        $this->date = new Date($date, $format);
    }


    /**
     * @return \Easybill\ZUGFeRD\Model\Date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}