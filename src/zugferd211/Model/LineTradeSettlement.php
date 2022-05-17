<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class LineTradeSettlement
{
    /**
     * @var TradeTax[]
     * @Type("array<Easybill\ZUGFeRD211\Model\TradeTax>")
     * @XmlList(inline = true, entry = "ApplicableTradeTax", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $tradeTax = [];

    /**
     * @var TradeAllowanceCharge[]
     * @Type("array<Easybill\ZUGFeRD211\Model\TradeAllowanceCharge>")
     * @XmlList(inline = true, entry = "SpecifiedTradeAllowanceCharge", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $specifiedTradeAllowanceCharge = [];

    /**
     * @Type("Easybill\ZUGFeRD211\Model\Period")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("BillingSpecifiedPeriod")
     */
    public ?Period $billingSpecifiedPeriod = null;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\TradeSettlementLineMonetarySummation")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedTradeSettlementLineMonetarySummation")
     */
    public TradeSettlementLineMonetarySummation $monetarySummation;

    /**
     * @var TradeAccountingAccount[]
     * @Type("array<Easybill\ZUGFeRD211\Model\TradeAccountingAccount>")
     * @XmlList(inline = true, entry = "ReceivableSpecifiedTradeAccountingAccount", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $tradeAccountingAccount = [];
}
