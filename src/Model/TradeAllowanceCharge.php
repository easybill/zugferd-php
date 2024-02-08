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

/**
 * Class AllowanceCharge.
 */
class TradeAllowanceCharge
{
    #[JMS\Type(Indicator::class)]
    #[JMS\SerializedName('ChargeIndicator')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?Indicator $indicator = null;

    #[JMS\Type('string')]
    #[JMS\SerializedName('CalculationPercent')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $calculationPercent = null;

    #[JMS\Type(Amount::class)]
    #[JMS\SerializedName('BasisAmount')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?Amount $basisAmount = null;

    #[JMS\Type(Amount::class)]
    #[JMS\SerializedName('ActualAmount')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public Amount $actualAmount;

    #[JMS\Type('string')]
    #[JMS\SerializedName('Reason')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $reason = null;

    /**
     * @var TradeTax[]
     */
    #[JMS\Type('array<Easybill\ZUGFeRD\Model\TradeTax>')]
    #[JMS\XmlList(inline: true, entry: 'CategoryTradeTax', namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $tradeTax = [];
}
