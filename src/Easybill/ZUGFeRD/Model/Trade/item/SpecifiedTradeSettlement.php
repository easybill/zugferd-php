<?php

namespace Easybill\ZUGFeRD\Model\Trade\Item;

use Easybill\ZUGFeRD\Model\Trade\Tax\TradeTax;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlList;

/**
 * Class SpecifiedTradeSettlement
 *
 * @package Easybill\ZUGFeRD\Model\Trade\Item
 */
class SpecifiedTradeSettlement
{

    /**
     * @var TradeTax
     * @Type("Easybill\ZUGFeRD\Model\Trade\Tax\TradeTax")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("ApplicableTradeTax")
     */
    private $tradeTax;

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\Tax\TradeTax
     */
    public function getTradeTax()
    {
        return $this->tradeTax;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\Tax\TradeTax $tradeTax
     */
    public function setTradeTax($tradeTax)
    {
        $this->tradeTax = $tradeTax;
    }

}