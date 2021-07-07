<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class HeaderTradeSettlement
{
    /**
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("InvoiceCurrencyCode")
     */
    public string $currency;

    /**
     * @var TradeSettlementPaymentMeans[]
     * @Type("array<Easybill\ZUGFeRD211\Model\TradeSettlementPaymentMeans>")
     * @XmlList(inline = true, entry = "SpecifiedTradeSettlementPaymentMeans", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $specifiedTradeSettlementPaymentMeans = [];

    /**
     * @var TradeTax[]
     * @Type("array<Easybill\ZUGFeRD211\Model\TradeTax>")
     * @XmlList(inline = true, entry = "ApplicableTradeTax", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $tradeTaxes = [];

    /**
     * @var TradeAllowanceCharge[]
     * @Type("array<Easybill\ZUGFeRD211\Model\TradeAllowanceCharge>")
     * @XmlList(inline = true, entry = "SpecifiedTradeAllowanceCharge", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $specifiedTradeAllowanceCharge = [];

    /**
     * @var TradePaymentTerms[]
     * @Type("array<Easybill\ZUGFeRD211\Model\TradePaymentTerms>")
     * @XmlList(inline = true, entry = "SpecifiedTradePaymentTerms", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $specifiedTradePaymentTerms = [];

    /**
     * @Type("Easybill\ZUGFeRD211\Model\TradeSettlementHeaderMonetarySummation")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedTradeSettlementHeaderMonetarySummation")
     */
    public TradeSettlementHeaderMonetarySummation $specifiedTradeSettlementHeaderMonetarySummation;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\ReferencedDocument")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("InvoiceReferencedDocument")
     */
    public ?ReferencedDocument $invoiceReferencedDocument = null;
}
