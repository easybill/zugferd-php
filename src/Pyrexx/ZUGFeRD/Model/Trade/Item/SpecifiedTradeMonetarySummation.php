<?php namespace Pyrexx\ZUGFeRD\Model\Trade\Item;

use Pyrexx\ZUGFeRD\Model\Trade\Amount;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class SpecifiedTradeMonetarySummation
{

    /**
     * @var Amount
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("LineTotalAmount")
     */
    private $totalAmount;

    /**
     * SpecifiedMonetarySummation constructor.
     *
     * @param double $value
     * @param string $currency
     */
    public function __construct($value, $currency = 'EUR')
    {
        $this->totalAmount = new Amount($value, $currency);
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Amount
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Amount $totalAmount
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }


}