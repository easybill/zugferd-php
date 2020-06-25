<?php namespace Easybill\ZUGFeRD\Model\v21\Trade\Item;

use Easybill\ZUGFeRD\Model\v21\Trade\Tax\TradeTaxItem;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class SpecifiedTradeSettlement
{

    /**
     * @var TradeTaxItem
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\Tax\TradeTaxItem")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ApplicableTradeTax")
     */
    private $tradeTax;

    /**
     * @var SpecifiedTradeMonetarySummation
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\Item\SpecifiedTradeMonetarySummation")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedTradeSettlementLineMonetarySummation")
     */
    private $monetarySummation;

    /**
     * @return \Easybill\ZUGFeRD\Model\v21\Trade\Tax\TradeTaxItem
     */
    public function getTradeTax()
    {
        return $this->tradeTax;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Trade\Tax\TradeTaxItem $tradeTax
     *
     * @return self
     */
    public function setTradeTax($tradeTax)
    {
        $this->tradeTax = $tradeTax;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\v21\Trade\Item\SpecifiedTradeMonetarySummation
     */
    public function getMonetarySummation()
    {
        return $this->monetarySummation;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Trade\Item\SpecifiedTradeMonetarySummation $monetarySummation
     *
     * @return self
     */
    public function setMonetarySummation($monetarySummation)
    {
        $this->monetarySummation = $monetarySummation;
        return $this;
    }

}