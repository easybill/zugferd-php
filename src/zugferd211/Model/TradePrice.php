<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation as JMS;

class TradePrice
{
    #[JMS\Type(Amount::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('ChargeAmount')]
    public Amount $chargeAmount;

    #[JMS\Type(Quantity::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('BasisQuantity')]
    public ?Quantity $basisQuantity = null;

    #[JMS\Type(TradeAllowanceCharge::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('AppliedTradeAllowanceCharge')]
    public ?TradeAllowanceCharge $appliedTradeAllowanceCharge = null;

    public static function create(string $amount, Quantity $quantity = null, TradeAllowanceCharge $tradeAllowanceCharge = null): self
    {
        $self = new self();
        $self->chargeAmount = Amount::create($amount);
        $self->basisQuantity = $quantity;
        $self->appliedTradeAllowanceCharge = $tradeAllowanceCharge;
        return $self;
    }
}
