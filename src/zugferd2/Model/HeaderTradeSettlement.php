<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class HeaderTradeSettlement
{
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('CreditorReferenceID')]
    public ?string $creditorReferenceID = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('PaymentReference')]
    public ?string $paymentReference = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('TaxCurrencyCode')]
    public string $taxCurrencyCode;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('InvoiceCurrencyCode')]
    public string $invoiceCurrencyCode;

    #[Type(TradeParty::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('InvoiceeTradeParty')]
    public ?TradeParty $invoiceeTradeParty = null;

    #[Type(TradeParty::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('PayeeTradeParty')]
    public ?TradeParty $payeeTradeParty = null;

    /**
     * @var TradeCurrencyExchange[]
     */
    #[Type('array<Easybill\ZUGFeRD2\Model\TradeCurrencyExchange>')]
    #[XmlList(entry: 'TaxApplicableTradeCurrencyExchange', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $taxApplicableTradeCurrencyExchange = [];

    /**
     * @var TradeSettlementPaymentMeans[]
     */
    #[Type('array<Easybill\ZUGFeRD2\Model\TradeSettlementPaymentMeans>')]
    #[XmlList(entry: 'SpecifiedTradeSettlementPaymentMeans', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $specifiedTradeSettlementPaymentMeans = [];

    /**
     * @var TradeTax[]
     */
    #[Type('array<Easybill\ZUGFeRD2\Model\TradeTax>')]
    #[XmlList(entry: 'ApplicableTradeTax', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $tradeTaxes = [];

    #[Type(SpecifiedPeriod::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('BillingSpecifiedPeriod')]
    public ?SpecifiedPeriod $billingSpecifiedPeriod = null;

    /**
     * @var TradeAllowanceCharge[]
     */
    #[Type('array<Easybill\ZUGFeRD2\Model\TradeAllowanceCharge>')]
    #[XmlList(entry: 'SpecifiedTradeAllowanceCharge', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $specifiedTradeAllowanceCharge = [];

    /**
     * @var LogisticsServiceCharge[]
     */
    #[Type('array<Easybill\ZUGFeRD2\Model\LogisticsServiceCharge>')]
    #[XmlList(entry: 'SpecifiedLogisticsServiceCharge', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $specifiedLogisticsServiceCharge = [];

    /**
     * @var TradePaymentTerms[]
     */
    #[Type('array<Easybill\ZUGFeRD2\Model\TradePaymentTerms>')]
    #[XmlList(entry: 'SpecifiedTradePaymentTerms', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $specifiedTradePaymentTerms = [];

    #[Type(TradeSettlementHeaderMonetarySummation::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('SpecifiedTradeSettlementHeaderMonetarySummation')]
    public TradeSettlementHeaderMonetarySummation $specifiedTradeSettlementHeaderMonetarySummation;

    #[Type(ReferencedDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('InvoiceReferencedDocument')]
    public ?ReferencedDocument $invoiceReferencedDocument = null;

    /** @var TradeAccountingAccount[] */
    #[Type('array<Easybill\ZUGFeRD2\Model\TradeAccountingAccount>')]
    #[XmlList(entry: 'ReceivableSpecifiedTradeAccountingAccount', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $receivableSpecifiedTradeAccountingAccount = [];

    /** @var AdvancePayment[] */
    #[Type('array<Easybill\ZUGFeRD2\Model\AdvancePayment>')]
    #[XmlList(entry: 'SpecifiedAdvancePayment', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $specifiedAdvancePayment = [];
}
