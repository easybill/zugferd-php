<?php

namespace Easybill\ZUGFeRD\Model\Trade;

use Easybill\ZUGFeRD\Model\AllowanceCharge;
use Easybill\ZUGFeRD\Model\Trade\Tax\TradeTax;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

/**
 * @AccessorOrder("custom", custom = {"paymentReference", "currency", "invoiceeTradeParty", "payeeTradeParty", "paymentMeans", "tradeTaxes", "billingPeriod", "allowanceCharges", "logisticsServiceCharge", "paymentTerms", "monetarySummation"})
 */
class Settlement
{
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("PaymentReference")
     */
    private $paymentReference;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("InvoiceCurrencyCode")
     */
    private $currency;

    /**
     * @var TradeParty
     * @Type("Easybill\ZUGFeRD\Model\Trade\TradeParty")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("InvoiceeTradeParty")
     */
    private $invoiceeTradeParty;

    /**
     * @var TradeParty
     * @Type("Easybill\ZUGFeRD\Model\Trade\TradeParty")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("PayeeTradeParty")
     */
    private $payeeTradeParty;

    /**
     * @var PaymentMeans
     * @Type("Easybill\ZUGFeRD\Model\Trade\PaymentMeans")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SpecifiedTradeSettlementPaymentMeans")
     */
    private $paymentMeans;

    /**
     * @var TradeTax[]
     * @Type("array<Easybill\ZUGFeRD\Model\Trade\Tax\TradeTax>")
     * @XmlList(inline = true, entry = "ApplicableTradeTax", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     */
    private $tradeTaxes = [];

    /**
     * @var AllowanceCharge[]
     * @Type("array<Easybill\ZUGFeRD\Model\AllowanceCharge>")
     * @XmlList(inline = true, entry = "SpecifiedTradeAllowanceCharge", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     */
    private $allowanceCharges = [];

    /**
     * @var SpecifiedLogisticsServiceCharge[]
     * @Type("array<Easybill\ZUGFeRD\Model\Trade\SpecifiedLogisticsServiceCharge>")
     * @XmlList(inline = true, entry = "SpecifiedLogisticsServiceCharge", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     */
    private $logisticsServiceCharge = [];

    /**
     * @var BillingPeriod
     * @Type("Easybill\ZUGFeRD\Model\Trade\BillingPeriod")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("BillingSpecifiedPeriod")
     */
    private $billingPeriod;

    /**
     * @var MonetarySummation
     * @Type("Easybill\ZUGFeRD\Model\Trade\MonetarySummation")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SpecifiedTradeSettlementMonetarySummation")
     */
    private $monetarySummation;

    /**
     * @var PaymentTerms
     * @Type("Easybill\ZUGFeRD\Model\Trade\PaymentTerms")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SpecifiedTradePaymentTerms")
     */
    private $paymentTerms;

    /**
     * Settlement constructor.
     *
     * @param string $paymentReference
     * @param string $currency
     */
    public function __construct($paymentReference = '', $currency = 'EUR')
    {
        $this->paymentReference = $paymentReference;
        $this->currency = $currency;
        $this->paymentMeans = new PaymentMeans();
    }

    /**
     * @return string
     */
    public function getPaymentReference()
    {
        return $this->paymentReference;
    }

    /**
     * @param string $paymentReference
     * @return self
     */
    public function setPaymentReference($paymentReference)
    {
        $this->paymentReference = $paymentReference;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return self
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return PaymentMeans
     */
    public function getPaymentMeans()
    {
        return $this->paymentMeans;
    }

    /**
     * @return self
     */
    public function setPaymentMeans(PaymentMeans $paymentMeans)
    {
        $this->paymentMeans = $paymentMeans;
        return $this;
    }

    /**
     * @return TradeTax[]
     */
    public function getTradeTaxes()
    {
        return $this->tradeTaxes;
    }

    /**
     * @return self
     */
    public function addTradeTax(TradeTax $tradeTax)
    {
        $this->tradeTaxes[] = $tradeTax;
        return $this;
    }

    /**
     * @return AllowanceCharge[]
     */
    public function getAllowanceCharges(): array
    {
        return $this->allowanceCharges;
    }

    /**
     * @return self
     */
    public function addAllowanceCharge(AllowanceCharge $allowanceCharge)
    {
        $this->allowanceCharges[] = $allowanceCharge;
        return $this;
    }

    /**
     * @return MonetarySummation
     */
    public function getMonetarySummation()
    {
        return $this->monetarySummation;
    }

    /**
     * @param MonetarySummation $monetarySummation
     * @return self
     */
    public function setMonetarySummation($monetarySummation)
    {
        $this->monetarySummation = $monetarySummation;
        return $this;
    }

    /**
     * @return PaymentTerms
     */
    public function getPaymentTerms()
    {
        return $this->paymentTerms;
    }

    /**
     * @param PaymentTerms $paymentTerms
     * @return self
     */
    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = $paymentTerms;
        return $this;
    }

    /**
     * @return BillingPeriod
     */
    public function getBillingPeriod()
    {
        return $this->billingPeriod;
    }

    /**
     * @param BillingPeriod $billingPeriod
     * @return self
     */
    public function setBillingPeriod($billingPeriod)
    {
        $this->billingPeriod = $billingPeriod;
        return $this;
    }

    /**
     * @return SpecifiedLogisticsServiceCharge[]
     */
    public function getLogisticsServiceCharge()
    {
        return $this->logisticsServiceCharge;
    }

    /**
     * @return self
     */
    public function addLogisticsServiceCharge(SpecifiedLogisticsServiceCharge $logisticsServiceCharge)
    {
        $this->logisticsServiceCharge[] = $logisticsServiceCharge;
        return $this;
    }

    /**
     * @return TradeParty
     */
    public function getInvoiceeTradeParty()
    {
        return $this->invoiceeTradeParty;
    }

    /**
     * @return self
     */
    public function setInvoiceeTradeParty(TradeParty $invoiceeTradeParty)
    {
        $this->invoiceeTradeParty = $invoiceeTradeParty;
        return $this;
    }

    /**
     * @return TradeParty
     */
    public function getPayeeTradeParty()
    {
        return $this->payeeTradeParty;
    }

    /**
     * @return self
     */
    public function setPayeeTradeParty(TradeParty $payeeTradeParty)
    {
        $this->payeeTradeParty = $payeeTradeParty;
        return $this;
    }
}
