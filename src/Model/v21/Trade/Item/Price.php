<?php namespace Easybill\ZUGFeRD\Model\v21\Trade\Item;

use Easybill\ZUGFeRD\Model\v21\AllowanceCharge;
use Easybill\ZUGFeRD\Model\v21\Trade\Amount;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class Price
{

    /**
     * @var Amount
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ChargeAmount")
     */
    private $amount;

    /**
     * @var AllowanceCharge[]
     * @Type("array<Easybill\ZUGFeRD\Model\v21\AllowanceCharge>")
     * @XmlList(inline = true, entry = "AppliedTradeAllowanceCharge", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
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
     * @return \Easybill\ZUGFeRD\Model\v21\Trade\Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Trade\Amount $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\v21\AllowanceCharge[]
     */
    public function getAllowanceCharges()
    {
        return $this->allowanceCharges;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\AllowanceCharge $allowanceCharge
     *
     * @return self
     */
    public function addAllowanceCharge(AllowanceCharge $allowanceCharge)
    {
        $this->allowanceCharges[] = $allowanceCharge;
        return $this;
    }


}