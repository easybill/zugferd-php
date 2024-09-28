<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation as JMS;

class TradePaymentDiscountTerms
{
    #[JMS\Type(DateTime::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('BasisDateTime')]
    public ?DateTime $basisDateTime = null;

    #[JMS\Type(Measure::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('BasisPeriodMeasure')]
    public ?Measure $basisPeriodMeasure = null;

    #[JMS\Type(Amount::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('BasisAmount')]
    public ?Amount $basisAmount = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('CalculationPercent')]
    public ?string $calculationPercent = null;

    #[JMS\Type(Amount::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('ActualPenaltyAmount')]
    public ?Amount $actualPenaltyAmount = null;
}
