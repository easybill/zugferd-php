<?php namespace Pyrexx\ZUGFeRD\Model\Trade\Item;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class SpecifiedTradeDelivery
{

    /**
     * @var Quantity
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\Item\Quantity")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("BilledQuantity")
     */
    private $billedQuantity;

    /**
     * SpecifiedTradeDelivery constructor.
     *
     * @param Quantity $billedQuantity
     */
    public function __construct(Quantity $billedQuantity)
    {
        $this->billedQuantity = $billedQuantity;
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Item\Quantity
     */
    public function getBilledQuantity()
    {
        return $this->billedQuantity;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Item\Quantity $billedQuantity
     */
    public function setBilledQuantity($billedQuantity)
    {
        $this->billedQuantity = $billedQuantity;
    }

}