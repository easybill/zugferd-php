<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class HeaderTradeSettlement
{
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("InvoiceCurrencyCode")
     */
    public $currency;

    /**
     * @var TradeTax[]
     * @Type("array<Easybill\ZUGFeRD211\Model\TradeTax>")
     * @XmlList(inline = true, entry = "ApplicableTradeTax", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public $tradeTaxes;

    /**
     * @var TradePaymentTerms
     * @Type("Easybill\ZUGFeRD211\Model\TradePaymentTerms")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedTradePaymentTerms")
     */
    public $specifiedTradePaymentTerms;

    /**
     * @var TradeSettlementHeaderMonetarySummation
     * @Type("Easybill\ZUGFeRD211\Model\TradeSettlementHeaderMonetarySummation")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedTradeSettlementHeaderMonetarySummation")
     */
    public $specifiedTradeSettlementHeaderMonetarySummation;

}
