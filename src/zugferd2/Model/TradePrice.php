<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

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

    /** @var TradeAllowanceCharge[] */
    #[JMS\Type('array<Easybill\ZUGFeRD2\Model\TradeAllowanceCharge>')]
    #[JMS\XmlList(entry: 'AppliedTradeAllowanceCharge', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $appliedTradeAllowanceCharges = [];

    /** @param array<TradeAllowanceCharge> $tradeAllowanceCharge */
    public static function create(string $amount, ?Quantity $quantity = null, array $tradeAllowanceCharge = []): self
    {
        $self = new self();
        $self->chargeAmount = Amount::create($amount);
        $self->basisQuantity = $quantity;
        $self->appliedTradeAllowanceCharges = $tradeAllowanceCharge;
        return $self;
    }
}
