<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

/**
 * Class AllowanceCharge.
 */
class TradeAllowanceCharge
{
    #[Type(Indicator::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ChargeIndicator')]
    public ?Indicator $indicator = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('CalculationPercent')]
    public ?string $calculationPercent = null;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('BasisAmount')]
    public ?Amount $basisAmount = null;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ActualAmount')]
    public Amount $actualAmount;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ReasonCode')]
    public ?string $reasonCode = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('Reason')]
    public ?string $reason = null;

    /** @var TradeTax[] */
    #[Type('array<' . TradeTax::class . '>')]
    #[XmlList(entry: 'CategoryTradeTax', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $tradeTax = [];

    /** @param array<TradeTax> $tradeTax */
    public static function create(
        Amount $actualAmount,
        ?Indicator $indicator = null,
        ?string $calculationPercent = null,
        ?Amount $basisAmount = null,
        ?string $reason = null,
        array $tradeTax = []
    ): self {
        $self = new self();
        $self->actualAmount = $actualAmount;
        $self->indicator = $indicator;
        $self->calculationPercent = $calculationPercent;
        $self->basisAmount = $basisAmount;
        $self->reason = $reason;
        $self->tradeTax = $tradeTax;
        return $self;
    }
}
