<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\Annotation\AccessorOrder;

#[AccessorOrder(order: 'custom', custom: ['calculatedAmount', 'typeCode', 'exemptionReason', 'exemptionReasonCode', 'basisAmount', 'lineTotalBasisAmount', 'allowanceChargeBasisAmount', 'categoryCode', 'taxPointDate', 'dueDateTypeCode', 'rateApplicablePercent', 'applicablePercent'])]
class TradeTax
{
    #[JMS\Type(Amount::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('CalculatedAmount')]
    public ?Amount $calculatedAmount = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('TypeCode')]
    public string $typeCode;

    #[JMS\Type(Amount::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('BasisAmount')]
    public ?Amount $basisAmount = null;

    #[JMS\Type(Amount::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('LineTotalBasisAmount')]
    public ?Amount $lineTotalBasisAmount = null;

    #[JMS\Type(Amount::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('AllowanceChargeBasisAmount')]
    public ?Amount $allowanceChargeBasisAmount = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('ApplicablePercent')]
    public ?string $applicablePercent = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('CategoryCode')]
    public ?string $categoryCode = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('RateApplicablePercent')]
    public ?string $rateApplicablePercent = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('ExemptionReason')]
    public ?string $exemptionReason = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('ExemptionReasonCode')]
    public ?string $exemptionReasonCode = null;

    #[JMS\Type(DateTime::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('TaxPointDate')]
    public ?DateTime $taxPointDate = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('DueDateTypeCode')]
    public ?string $dueDateTypeCode = null;

    public static function create(
        string $typeCode,
        ?Amount $calculatedAmount = null,
        ?Amount $basisAmount = null,
        ?Amount $lineTotalBasisAmount = null,
        ?Amount $allowanceChargeBasisAmount = null,
        ?string $applicablePercent = null,
        ?string $categoryCode = null,
        ?string $rateApplicablePercent = null,
        ?string $exemptionReason = null,
        ?string $exemptionReasonCode = null,
        ?DateTime $taxPointDate = null,
        ?string $dueDateTypeCode = null,
    ): self {
        $self = new self();
        $self->calculatedAmount = $calculatedAmount;
        $self->typeCode = $typeCode;
        $self->basisAmount = $basisAmount;
        $self->lineTotalBasisAmount = $lineTotalBasisAmount;
        $self->allowanceChargeBasisAmount = $allowanceChargeBasisAmount;
        $self->applicablePercent = $applicablePercent;
        $self->categoryCode = $categoryCode;
        $self->rateApplicablePercent = $rateApplicablePercent;
        $self->exemptionReason = $exemptionReason;
        $self->exemptionReasonCode = $exemptionReasonCode;
        $self->taxPointDate = $taxPointDate;
        $self->dueDateTypeCode = $dueDateTypeCode;
        return $self;
    }
}
