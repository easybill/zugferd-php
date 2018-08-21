<?php namespace Pyrexx\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class Delivery
{

    /**
     * @var DeliveryChainEvent
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\DeliveryChainEvent")
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
     * @return \Pyrexx\ZUGFeRD\Model\Trade\DeliveryChainEvent
     */
    public function getChainEvent()
    {
        return $this->chainEvent;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\DeliveryChainEvent $chainEvent
     */
    public function setChainEvent($chainEvent)
    {
        $this->chainEvent = $chainEvent;
    }


}