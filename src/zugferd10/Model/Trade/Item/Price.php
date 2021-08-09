<?php

namespace Easybill\ZUGFeRD\Model\Trade\Item;

use Easybill\ZUGFeRD\Model\AllowanceCharge;
use Easybill\ZUGFeRD\Model\Trade\Amount;
use JMS\Serializer\Annotation as JMS;

class Price
{
    /**
     * @var Amount
     * @JMS\Type("Easybill\ZUGFeRD\Model\Trade\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("ChargeAmount")
     */
    private $amount;

    /**
     * @var Quantity
     * @JMS\Type("Easybill\ZUGFeRD\Model\Trade\Item\Quantity")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("BasisQuantity")
     */
    private $quantity;

    /**
     * @var AllowanceCharge[]
     * @JMS\Type("array<Easybill\ZUGFeRD\Model\AllowanceCharge>")
     * @JMS\XmlList(inline = true, entry = "AppliedTradeAllowanceCharge", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     */
    private $allowanceCharges = [];

    /**
     * GrossPrice constructor.
     *
     * @param float $value
     * @param string $currency
     * @param bool $isSum
     */
    public function __construct($value, $currency = 'EUR', $isSum = true)
    {
        $this->amount = new Amount($value, $currency, $isSum);
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\Amount $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\AllowanceCharge[]
     */
    public function getAllowanceCharges()
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
     * @return Quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return self
     */
    public function setQuantity(Quantity $quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }
}
