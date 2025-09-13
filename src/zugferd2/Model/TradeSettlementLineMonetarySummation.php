<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TradeSettlementLineMonetarySummation
{
    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('LineTotalAmount')]
    public Amount $lineTotalAmount;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ChargeTotalAmount')]
    public ?Amount $chargeTotalAmount = null;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('AllowanceTotalAmount')]
    public ?Amount $allowanceTotalAmount = null;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('TaxTotalAmount')]
    public ?Amount $taxTotalAmount = null;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('GrandTotalAmount')]
    public ?Amount $grandTotalAmount = null;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('TotalAllowanceChargeAmount')]
    public ?Amount $totalAllowanceChargeAmount = null;

    public static function create(
        string $totalAmount,
        ?string $chargeTotalAmount = null,
        ?string $allowanceTotalAmount = null,
        ?string $taxTotalAmount = null,
        ?string $grandTotalAmount = null,
        ?string $totalAllowanceChargeAmount = null
    ): self {
        $self = new self();
        $self->lineTotalAmount = Amount::create($totalAmount);

        if ($chargeTotalAmount !== null) {
            $self->chargeTotalAmount = Amount::create($chargeTotalAmount);
        }

        if ($allowanceTotalAmount !== null) {
            $self->allowanceTotalAmount = Amount::create($allowanceTotalAmount);
        }

        if ($taxTotalAmount !== null) {
            $self->taxTotalAmount = Amount::create($taxTotalAmount);
        }

        if ($grandTotalAmount !== null) {
            $self->grandTotalAmount = Amount::create($grandTotalAmount);
        }

        if ($totalAllowanceChargeAmount !== null) {
            $self->totalAllowanceChargeAmount = Amount::create($totalAllowanceChargeAmount);
        }

        return $self;
    }
}
