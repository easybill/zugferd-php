<?php namespace Easybill\ZUGFeRD\ModelV2\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class Delivery
{

    /**
     * @var TradeParty
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\TradeParty")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ShipToTradeParty")
     */
    private $shipToTradeParty;

    /**
     * @var DeliveryChainEvent
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\DeliveryChainEvent")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
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
     * @return \Easybill\ZUGFeRD\ModelV2\Trade\DeliveryChainEvent
     */
    public function getChainEvent()
    {
        return $this->chainEvent;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Trade\DeliveryChainEvent $chainEvent
     */
    public function setChainEvent($chainEvent)
    {
        $this->chainEvent = $chainEvent;
    }


}