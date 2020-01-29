<?php namespace Easybill\ZUGFeRD\ModelV2\Trade\Item;

use Easybill\ZUGFeRD\ModelV2\Trade\Amount;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class SpecifiedTradeMonetarySummation
{

    /**
     * @var Amount
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\Amount")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
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
     * @return \Easybill\ZUGFeRD\ModelV2\Trade\Amount
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Trade\Amount $totalAmount
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }


}