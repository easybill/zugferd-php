<?php

namespace Easybill\ZUGFeRD\Model\Trade;

use Easybill\ZUGFeRD\Model\Trade\DeliveryChainEvent;

use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
/**
 * Class Delivery
 *
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12", prefix="ram")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15", prefix="udt")
 *
 * @package Easybill\ZUGFeRD\Model\Trade
 */
class Delivery
{

    /**
     * @var DeliveryChainEvent
     * @Type("Easybill\ZUGFeRD\Model\Trade\DeliveryChainEvent")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("ActualDeliverySupplyChainEvent")
     */
    private $chainEvent;

    /**
     * Delivery constructor.
     *
     * @param string $date
     * @param int    $format
     */
    public function __construct($date = '', $format = 102)
    {
        $this->chainEvent = new DeliveryChainEvent($date, $format);
    }


    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\DeliveryChainEvent
     */
    public function getChainEvent()
    {
        return $this->chainEvent;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\DeliveryChainEvent $chainEvent
     */
    public function setChainEvent($chainEvent)
    {
        $this->chainEvent = $chainEvent;
    }


}