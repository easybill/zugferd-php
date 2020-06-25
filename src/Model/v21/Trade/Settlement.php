<?php namespace Easybill\ZUGFeRD\Model\v21\Trade;

use Easybill\ZUGFeRD\Model\v21\AllowanceCharge;
use Easybill\ZUGFeRD\Model\v21\Trade\Tax\TradeTax;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;
use JMS\Serializer\Annotation\Groups;

/**
 * @AccessorOrder("custom", custom = {
 *     "creditorReferenceID",
 *     "paymentReference",
 *     "currency",
 *     "paymentMeans",
 *     "tradeTaxes",
 *     "billingPeriod",
 *     "allowanceCharges",
 *     "paymentTerms",
 *     "monetarySummation"
 * })
 */
class Settlement
{

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("CreditorReferenceID")
     */
    private $creditorReferenceID;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("PaymentReference")
     */
    private $paymentReference;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("InvoiceCurrencyCode")
     */
    private $currency;

    /**
     * @var PaymentMeans
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\PaymentMeans")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedTradeSettlementPaymentMeans")
     */
    private $paymentMeans;

    /**
     * @var TradeTax[]
     * @Type("array<Easybill\ZUGFeRD\Model\v21\Trade\Tax\TradeTax>")
     * @XmlList(inline = true, entry = "ApplicableTradeTax", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    private $tradeTaxes = [];

    /**
     * @var AllowanceCharge[]
     * @Type("array<Easybill\ZUGFeRD\Model\v21\AllowanceCharge>")
     * @XmlList(inline = true, entry = "SpecifiedTradeAllowanceCharge", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    private $allowanceCharges = [];

    /**
     * @var BillingPeriod
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\BillingPeriod")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("BillingSpecifiedPeriod")
     * @Groups({"EN16931", "extended"})
     */
    private $billingPeriod;

    /**
     * @var MonetarySummation
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\MonetarySummation")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedTradeSettlementHeaderMonetarySummation")
     */
    private $monetarySummation;

    /**
     * @var PaymentTerms
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\PaymentTerms")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
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
     * @param PaymentMeans $paymentMeans
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
     * @param TradeTax $tradeTax
     *
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
     * @param AllowanceCharge $allowanceCharge
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

}