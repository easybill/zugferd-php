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
    /**
     * @JMS\Type("Easybill\ZUGFeRD\Model\Indicator")
     *
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @JMS\SerializedName("ChargeIndicator")
     */
    public ?Indicator $indicator = null;

    /**
     * @JMS\Type("string")
     *
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @JMS\SerializedName("CalculationPercent")
     */
    public ?string $calculationPercent = null;

    /**
     * @JMS\Type("Easybill\ZUGFeRD\Model\Amount")
     *
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @JMS\SerializedName("BasisAmount")
     */
    public ?Amount $basisAmount = null;

    /**
     * @JMS\Type("Easybill\ZUGFeRD\Model\Amount")
     *
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @JMS\SerializedName("ActualAmount")
     */
    public Amount $actualAmount;

    /**
     * @JMS\Type("string")
     *
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @JMS\SerializedName("Reason")
     */
    public ?string $reason = null;

    /**
     * @var TradeTax[]
     *
     * @JMS\Type("array<Easybill\ZUGFeRD\Model\TradeTax>")
     *
     * @JMS\XmlList(inline = true, entry = "CategoryTradeTax", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $tradeTax = [];
}
