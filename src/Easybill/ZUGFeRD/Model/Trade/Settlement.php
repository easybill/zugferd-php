<?php

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlList;

/**
 * Class Settlement
 *
 * @package Easybill\ZUGFeRD\Model\Trade
 */
class Settlement
{

    /**
     * @var string
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("PaymentReference")
     */
    private $paymentReference = '';

    /**
     * @var string
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("InvoiceCurrencyCode")
     */
    private $currency = 'EUR';


    /**
     * @var PaymentMeans
     * @Type("Easybill\ZUGFeRD\Model\Trade\PaymentMeans")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SpecifiedTradeSettlementPaymentMeans")
     */
    private $paymentMeans;

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
     *
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
     *
     * @return self
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\PaymentMeans
     */
    public function getPaymentMeans()
    {
        return $this->paymentMeans;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\PaymentMeans $paymentMeans
     *
     * @return self;
     */
    public function setPaymentMeans(PaymentMeans $paymentMeans)
    {
        $this->paymentMeans = $paymentMeans;
        return $this;
    }




}