<?php

namespace Easybill\ZUGFeRD\Model\Trade\Item;

use Easybill\ZUGFeRD\Model\Trade\Amount;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

class Price
{

    /**
     * @var Amount
     * @Type("Easybill\ZUGFeRD\Model\Trade\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("ChargeAmount")
     */
    private $amount;

    /**
     * GrossPrice constructor.
     *
     * @param double $value
     * @param string $currency
     */
    public function __construct($value, $currency = 'EUR')
    {
        $this->amount = new Amount($value, $currency);
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

}