<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade\Item;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class SpecifiedTradeDelivery
{
    /**
     * SpecifiedTradeDelivery constructor.
     */
    public function __construct(#[Type(Quantity::class)]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('BilledQuantity')]
        private Quantity $billedQuantity) {}

    /**
     * @return Quantity
     */
    public function getBilledQuantity()
    {
        return $this->billedQuantity;
    }

    /**
     * @param Quantity $billedQuantity
     */
    public function setBilledQuantity($billedQuantity)
    {
        $this->billedQuantity = $billedQuantity;
    }
}
