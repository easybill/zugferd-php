<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class TradeSettlementHeaderMonetarySummation
{
    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('LineTotalAmount')]
    public ?Amount $lineTotalAmount = null;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ChargeTotalAmount')]
    public ?Amount $chargeTotalAmount = null;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('AllowanceTotalAmount')]
    public ?Amount $allowanceTotalAmount = null;

    /**
     * @var Amount[]
     */
    #[Type('array<' . Amount::class . '>')]
    #[XmlList(entry: 'TaxBasisTotalAmount', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $taxBasisTotalAmount = [];

    /**
     * @var Amount[]
     */
    #[Type('array<' . Amount::class . '>')]
    #[XmlList(entry: 'TaxTotalAmount', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $taxTotalAmount = [];

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('RoundingAmount')]
    public ?Amount $roundingAmount = null;

    /**
     * @var Amount[]
     */
    #[Type('array<' . Amount::class . '>')]
    #[XmlList(entry: 'GrandTotalAmount', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $grandTotalAmount = [];

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('TotalPrepaidAmount')]
    public ?Amount $totalPrepaidAmount = null;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('DuePayableAmount')]
    public Amount $duePayableAmount;
}
