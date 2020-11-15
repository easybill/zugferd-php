<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class AllowanceCharge.
 */
class TradeAllowanceCharge
{
    /**
     * @JMS\Type("Easybill\ZUGFeRD211\Model\Indicator")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("ChargeIndicator")
     */
    public Indicator $indicator;

    /**
     * @JMS\Type("Easybill\ZUGFeRD211\Model\Amount")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("BasisAmount")
     */
    public Amount $basisAmount;

    /**
     * @JMS\Type("Easybill\ZUGFeRD211\Model\Amount")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("ActualAmount")
     */
    public Amount $actualAmount;

    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("Reason")
     */
    public string $reason;

    /**
     * @var TradeTax[]
     * @JMS\Type("array<Easybill\ZUGFeRD211\Model\TradeTax>")
     * @JMS\XmlList(inline = true, entry = "CategoryTradeTax", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $tradeTax;
}
