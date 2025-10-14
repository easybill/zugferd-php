<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class Delivery
{
    /**
     * @var TradeParty
     */
    #[Type(TradeParty::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('ShipToTradeParty')]
    private $shipToTradeParty;

    /**
     * @var TradeParty
     */
    #[Type(TradeParty::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('UltimateShipToTradeParty')]
    private $ultimateShipToTradeParty;

    /**
     * @var TradeParty
     */
    #[Type(TradeParty::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('ShipFromTradeParty')]
    private $shipFromTradeParty;

    /**
     * @var DeliveryChainEvent
     */
    #[Type(DeliveryChainEvent::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('ActualDeliverySupplyChainEvent')]
    private $chainEvent;

    /**
     * Delivery constructor.
     *
     * @param string $date
     * @param int $format
     */
    public function __construct($date = '', $format = 102)
    {
        $this->chainEvent = new DeliveryChainEvent($date, $format);
    }

    /**
     * @return DeliveryChainEvent
     */
    public function getChainEvent()
    {
        return $this->chainEvent;
    }

    /**
     * @param DeliveryChainEvent $chainEvent
     */
    public function setChainEvent($chainEvent)
    {
        $this->chainEvent = $chainEvent;
    }

    /**
     * @return TradeParty
     */
    public function getShipToTradeParty()
    {
        return $this->shipToTradeParty;
    }

    /**
     * @return self
     */
    public function setShipToTradeParty(TradeParty $shipToTradeParty)
    {
        $this->shipToTradeParty = $shipToTradeParty;
        return $this;
    }

    /**
     * @return TradeParty
     */
    public function getUltimateShipToTradeParty()
    {
        return $this->ultimateShipToTradeParty;
    }

    /**
     * @return self
     */
    public function setUltimateShipToTradeParty(TradeParty $ultimateShipToTradeParty)
    {
        $this->ultimateShipToTradeParty = $ultimateShipToTradeParty;
        return $this;
    }

    /**
     * @return TradeParty
     */
    public function getShipFromTradeParty()
    {
        return $this->shipFromTradeParty;
    }

    /**
     * @return self
     */
    public function setShipFromTradeParty(TradeParty $shipFromTradeParty)
    {
        $this->shipFromTradeParty = $shipFromTradeParty;
        return $this;
    }
}
