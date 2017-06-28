<?php namespace Easybill\ZUGFeRD\Model\Trade\Item;

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
     * @var AllowanceCharge[]
     * @JMS\Type("array<Easybill\ZUGFeRD\Model\AllowanceCharge>")
     * @JMS\XmlList(inline = true, entry = "AppliedTradeAllowanceCharge", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     */
    private $allowanceCharges = array();

    /**
     * GrossPrice constructor.
     *
     * @param double $value
     * @param string $currency
     * @param bool   $isSum
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
     * @param \Easybill\ZUGFeRD\Model\AllowanceCharge $allowanceCharge
     *
     * @return self
     */
    public function addAllowanceCharge(AllowanceCharge $allowanceCharge)
    {
        $this->allowanceCharges[] = $allowanceCharge;
        return $this;
    }


}