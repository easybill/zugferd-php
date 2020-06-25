<?php namespace Easybill\ZUGFeRD\Model\v21\Trade;

use Easybill\ZUGFeRD\Model\Trade\Agreement;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class Delivery
{

    /**
     * @var TradeParty
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\TradeParty")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ShipToTradeParty")
     */
    private $tradeParty;

    /**
     * @var DeliveryChainEvent
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\DeliveryChainEvent")
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
     * @return \Easybill\ZUGFeRD\Model\v21\Trade\DeliveryChainEvent
     */
    public function getChainEvent()
    {
        return $this->chainEvent;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Trade\DeliveryChainEvent $chainEvent
     */
    public function setChainEvent($chainEvent)
    {
        $this->chainEvent = $chainEvent;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\TradeParty
     */
    public function getTradeParty()
    {
        return $this->tradeParty;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\TradeParty $tradeParty
     *
     * @return self
     */
    public function setTradeParty($tradeParty)
    {
        $this->tradeParty = $tradeParty;
        return $this;
    }

}