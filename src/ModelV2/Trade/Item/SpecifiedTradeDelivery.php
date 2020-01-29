<?php namespace Easybill\ZUGFeRD\ModelV2\Trade\Item;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class SpecifiedTradeDelivery
{

    /**
     * @var Quantity
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\Item\Quantity")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
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
     * @return \Easybill\ZUGFeRD\ModelV2\Trade\Item\Quantity
     */
    public function getBilledQuantity()
    {
        return $this->billedQuantity;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Trade\Item\Quantity $billedQuantity
     */
    public function setBilledQuantity($billedQuantity)
    {
        $this->billedQuantity = $billedQuantity;
    }

}