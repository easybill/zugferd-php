<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class TradePrice
{
    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ChargeAmount')]
    public Amount $chargeAmount;

    #[Type(Quantity::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('BasisQuantity')]
    public ?Quantity $basisQuantity = null;

    /** @var TradeAllowanceCharge[] */
    #[Type('array<' . TradeAllowanceCharge::class . '>')]
    #[XmlList(entry: 'AppliedTradeAllowanceCharge', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $appliedTradeAllowanceCharges = [];

    #[Type(TradeTax::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('IncludedTradeTax')]
    public ?TradeTax $includedTradeTax = null;

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
