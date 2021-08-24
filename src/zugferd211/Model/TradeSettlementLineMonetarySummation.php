<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TradeSettlementLineMonetarySummation
{
    /**
     * @Type("Easybill\ZUGFeRD211\Model\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("LineTotalAmount")
     */
    public Amount $totalAmount;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("TotalAllowanceChargeAmount")
     */
    public ?Amount $totalAllowanceChargeAmount = null;

    public static function create(string $totalAmount, string $totalAllowanceChargeAmount = null): self
    {
        $self = new self();
        $self->totalAmount = Amount::create($totalAmount);
        if ($totalAllowanceChargeAmount != null) {
            $self->totalAllowanceChargeAmount = Amount::create($totalAllowanceChargeAmount);
        }
        return $self;
    }
}
