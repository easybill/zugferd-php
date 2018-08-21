<?php namespace Pyrexx\ZUGFeRD\Model\Trade\Item;

use Pyrexx\ZUGFeRD\Model\AllowanceCharge;
use Pyrexx\ZUGFeRD\Model\Trade\Amount;
use JMS\Serializer\Annotation as JMS;

class Price
{

    /**
     * @var Amount
     * @JMS\Type("Pyrexx\ZUGFeRD\Model\Trade\Amount")
     * @JMS\XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @JMS\SerializedName("ChargeAmount")
     */
    private $amount;

    /**
     * @var AllowanceCharge[]
     * @JMS\Type("array<Pyrexx\ZUGFeRD\Model\AllowanceCharge>")
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
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Amount $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\AllowanceCharge[]
     */
    public function getAllowanceCharges()
    {
        return $this->allowanceCharges;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\AllowanceCharge $allowanceCharge
     *
     * @return self
     */
    public function addAllowanceCharge(AllowanceCharge $allowanceCharge)
    {
        $this->allowanceCharges[] = $allowanceCharge;
        return $this;
    }


}