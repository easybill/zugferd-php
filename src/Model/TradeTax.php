<?php

declare(strict_types=1);

/*
 * This file is part of the ZUGFeRD PHP package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation as JMS;

class TradeTax
{
    #[JMS\Type(Amount::class)]
    #[JMS\SerializedName('CalculatedAmount')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?Amount $calculatedAmount = null;

    #[JMS\Type('string')]
    #[JMS\SerializedName('TypeCode')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public string $typeCode;

    #[JMS\Type('string')]
    #[JMS\SerializedName('ExemptionReason')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $exemptionReason = null;

    #[JMS\Type(Amount::class)]
    #[JMS\SerializedName('BasisAmount')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?Amount $basisAmount = null;

    #[JMS\Type(Amount::class)]
    #[JMS\SerializedName('LineTotalBasisAmount')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?Amount $lineTotalBasisAmount = null;

    #[JMS\Type(Amount::class)]
    #[JMS\SerializedName('AllowanceChargeBasisAmount')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?Amount $allowanceChargeBasisAmount = null;

    #[JMS\Type('string')]
    #[JMS\SerializedName('ApplicablePercent')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $applicablePercent = null;

    #[JMS\Type('string')]
    #[JMS\SerializedName('CategoryCode')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $categoryCode = null;

    #[JMS\Type('string')]
    #[JMS\SerializedName('ExemptionReasonCode')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $exemptionReasonCode = null;

    #[JMS\Type(DateTime::class)]
    #[JMS\SerializedName('TaxPointDate')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?DateTime $taxPointDate = null;

    #[JMS\Type('string')]
    #[JMS\SerializedName('DueDateTypeCode')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $dueDateTypeCode = null;

    #[JMS\Type('string')]
    #[JMS\SerializedName('RateApplicablePercent')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $rateApplicablePercent = null;
}
