<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TradeTax
{
    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('CalculatedAmount')]
    public ?Amount $calculatedAmount = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('TypeCode')]
    public string $typeCode;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ExemptionReason')]
    public ?string $exemptionReason = null;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('BasisAmount')]
    public ?Amount $basisAmount = null;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('LineTotalBasisAmount')]
    public ?Amount $lineTotalBasisAmount = null;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('AllowanceChargeBasisAmount')]
    public ?Amount $allowanceChargeBasisAmount = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('CategoryCode')]
    public ?string $categoryCode = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ExemptionReasonCode')]
    public ?string $exemptionReasonCode = null;

    #[Type(DateTime::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('TaxPointDate')]
    public ?DateTime $taxPointDate = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('DueDateTypeCode')]
    public ?string $dueDateTypeCode = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('RateApplicablePercent')]
    public ?string $rateApplicablePercent = null;

    public static function create(
        string $typeCode,
        ?Amount $calculatedAmount = null,
        ?Amount $basisAmount = null,
        ?Amount $lineTotalBasisAmount = null,
        ?Amount $allowanceChargeBasisAmount = null,
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
        $self->categoryCode = $categoryCode;
        $self->rateApplicablePercent = $rateApplicablePercent;
        $self->exemptionReason = $exemptionReason;
        $self->exemptionReasonCode = $exemptionReasonCode;
        $self->taxPointDate = $taxPointDate;
        $self->dueDateTypeCode = $dueDateTypeCode;
        return $self;
    }
}
