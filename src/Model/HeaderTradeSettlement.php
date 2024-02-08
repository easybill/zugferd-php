<?php

declare(strict_types=1);

/*
 * This file is part of the ZUGFeRD PHP package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class HeaderTradeSettlement
{
    /**
     * @Type("string")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("CreditorReferenceID")
     */
    public ?string $creditorReferenceID = null;

    /**
     * @Type("string")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("PaymentReference")
     */
    public ?string $paymentReference = null;

    /**
     * @Type("string")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("InvoiceCurrencyCode")
     */
    public string $currency;

    /**
     * @Type("Easybill\ZUGFeRD\Model\TradeParty")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("PayeeTradeParty")
     */
    public ?TradeParty $payeeTradeParty = null;

    /**
     * @var TradeSettlementPaymentMeans[]
     *
     * @Type("array<Easybill\ZUGFeRD\Model\TradeSettlementPaymentMeans>")
     *
     * @XmlList(inline = true, entry = "SpecifiedTradeSettlementPaymentMeans", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $specifiedTradeSettlementPaymentMeans = [];

    /**
     * @var TradeTax[]
     *
     * @Type("array<Easybill\ZUGFeRD\Model\TradeTax>")
     *
     * @XmlList(inline = true, entry = "ApplicableTradeTax", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $tradeTaxes = [];

    /**
     * @var TradeAllowanceCharge[]
     *
     * @Type("array<Easybill\ZUGFeRD\Model\TradeAllowanceCharge>")
     *
     * @XmlList(inline = true, entry = "SpecifiedTradeAllowanceCharge", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $specifiedTradeAllowanceCharge = [];

    /**
     * @var LogisticsServiceCharge[]
     *
     * @Type("array<Easybill\ZUGFeRD\Model\LogisticsServiceCharge>")
     *
     * @XmlList(inline = true, entry = "SpecifiedLogisticsServiceCharge", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $specifiedLogisticsServiceCharge = [];

    /**
     * @var TradePaymentTerms[]
     *
     * @Type("array<Easybill\ZUGFeRD\Model\TradePaymentTerms>")
     *
     * @XmlList(inline = true, entry = "SpecifiedTradePaymentTerms", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $specifiedTradePaymentTerms = [];

    /**
     * @Type("Easybill\ZUGFeRD\Model\TradeSettlementHeaderMonetarySummation")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("SpecifiedTradeSettlementHeaderMonetarySummation")
     */
    public TradeSettlementHeaderMonetarySummation $specifiedTradeSettlementHeaderMonetarySummation;

    /**
     * @Type("Easybill\ZUGFeRD\Model\ReferencedDocument")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("InvoiceReferencedDocument")
     */
    public ?ReferencedDocument $invoiceReferencedDocument = null;
}
