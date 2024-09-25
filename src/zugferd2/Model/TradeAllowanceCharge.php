<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class AllowanceCharge.
 */
class TradeAllowanceCharge
{
    #[JMS\Type(Indicator::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('ChargeIndicator')]
    public ?Indicator $indicator = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('CalculationPercent')]
    public ?string $calculationPercent = null;

    #[JMS\Type(Amount::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('BasisAmount')]
    public ?Amount $basisAmount = null;

    #[JMS\Type(Amount::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('ActualAmount')]
    public Amount $actualAmount;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('ReasonCode')]
    public ?string $reasonCode = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('Reason')]
    public ?string $reason = null;

    /** @var TradeTax[] */
    #[JMS\Type('array<Easybill\ZUGFeRD2\Model\TradeTax>')]
    #[JMS\XmlList(entry: 'CategoryTradeTax', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
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
