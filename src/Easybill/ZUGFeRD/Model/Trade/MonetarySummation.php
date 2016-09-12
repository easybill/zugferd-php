<?php

namespace Easybill\ZUGFeRD\Model\Trade;

use Easybill\ZUGFeRD\Model\Trade\Amount;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * Class MonetarySummation
 *
 * @package Easybill\ZUGFeRD\Model\Trade
 */
class MonetarySummation
{

    /**
     * Total amount of all invoice positions.
     *
     * @var Amount
     * @Type("Easybill\ZUGFeRD\Model\Trade\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("LineTotalAmount")
     */
    private $lineTotal;

    /**
     * Total amount of the supplements.
     *
     * @var Amount
     * @Type("Easybill\ZUGFeRD\Model\Trade\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("ChargeTotalAmount")
     */
    private $chargeTotal;

    /**
     * Total amount of the reductions.
     *
     * @var Amount
     * @Type("Easybill\ZUGFeRD\Model\Trade\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("AllowanceTotalAmount")
     */
    private $allowanceTotal;

    /**
     * Invoice amount WITHOUT taxes.
     *
     * @var Amount
     * @Type("Easybill\ZUGFeRD\Model\Trade\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("TaxBasisTotalAmount")
     */
    private $taxBasisTotal;

    /**
     * Total amount of taxes.
     *
     * @var Amount
     * @Type("Easybill\ZUGFeRD\Model\Trade\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("TaxTotalAmount")
     */
    private $taxTotal;

    /**
     * Gross amount.
     *
     * @var Amount
     * @Type("Easybill\ZUGFeRD\Model\Trade\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("GrandTotalAmount")
     */
    private $grandTotal;

    /**
     * MonetarySummation constructor.
     *
     * @param double $lineTotal
     * @param double $chargeTotal
     * @param double $allowanceTotal
     * @param double $taxBasisTotal
     * @param double $taxTotal
     * @param double $grandTotal
     * @param string $currency
     */
    public function __construct($lineTotal,
                                $chargeTotal,
                                $allowanceTotal,
                                $taxBasisTotal,
                                $taxTotal,
                                $grandTotal,
                                $currency = 'EUR')
    {
        $this->lineTotal = new Amount($lineTotal, $currency);
        $this->chargeTotal = new Amount($chargeTotal, $currency);
        $this->allowanceTotal = new Amount($allowanceTotal, $currency);
        $this->taxBasisTotal = new Amount($taxBasisTotal, $currency);
        $this->taxTotal = new Amount($taxTotal, $currency);
        $this->grandTotal = new Amount($grandTotal, $currency);
    }

    /**
     * @return mixed
     */
    public function getLineTotal()
    {
        return $this->lineTotal;
    }

    /**
     * @param mixed $lineTotal
     */
    public function setLineTotal($lineTotal)
    {
        $this->lineTotal = $lineTotal;
    }

    /**
     * @return mixed
     */
    public function getChargeTotal()
    {
        return $this->chargeTotal;
    }

    /**
     * @param mixed $chargeTotal
     */
    public function setChargeTotal($chargeTotal)
    {
        $this->chargeTotal = $chargeTotal;
    }

    /**
     * @return mixed
     */
    public function getAllowanceTotal()
    {
        return $this->allowanceTotal;
    }

    /**
     * @param mixed $allowanceTotal
     */
    public function setAllowanceTotal($allowanceTotal)
    {
        $this->allowanceTotal = $allowanceTotal;
    }

    /**
     * @return mixed
     */
    public function getTaxBasisTotal()
    {
        return $this->taxBasisTotal;
    }

    /**
     * @param mixed $taxBasisTotal
     */
    public function setTaxBasisTotal($taxBasisTotal)
    {
        $this->taxBasisTotal = $taxBasisTotal;
    }

    /**
     * @return mixed
     */
    public function getTaxTotal()
    {
        return $this->taxTotal;
    }

    /**
     * @param mixed $taxTotal
     */
    public function setTaxTotal($taxTotal)
    {
        $this->taxTotal = $taxTotal;
    }

    /**
     * @return mixed
     */
    public function getGrandTotal()
    {
        return $this->grandTotal;
    }

    /**
     * @param mixed $grandTotal
     */
    public function setGrandTotal($grandTotal)
    {
        $this->grandTotal = $grandTotal;
    }

}