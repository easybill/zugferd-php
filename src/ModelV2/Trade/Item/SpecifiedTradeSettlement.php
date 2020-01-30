<?php namespace Easybill\ZUGFeRD\ModelV2\Trade\Item;

use Easybill\ZUGFeRD\ModelV2\Trade\Tax\TradeTax;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class SpecifiedTradeSettlement
{

    /**
     * @var TradeTax
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\Tax\TradeTax")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ApplicableTradeTax")
     */
    private $tradeTax;

    /**
     * @var SpecifiedTradeMonetarySummation
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\Item\SpecifiedTradeMonetarySummation")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedTradeSettlementLineMonetarySummation")
     */
    private $monetarySummation;

    /**
     * @return \Easybill\ZUGFeRD\ModelV2\Trade\Tax\TradeTax
     */
    public function getTradeTax()
    {
        return $this->tradeTax;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Trade\Tax\TradeTax $tradeTax
     *
     * @return self
     */
    public function setTradeTax($tradeTax)
    {
        $this->tradeTax = $tradeTax;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\ModelV2\Trade\Item\SpecifiedTradeMonetarySummation
     */
    public function getMonetarySummation()
    {
        return $this->monetarySummation;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Trade\Item\SpecifiedTradeMonetarySummation $monetarySummation
     *
     * @return self
     */
    public function setMonetarySummation($monetarySummation)
    {
        $this->monetarySummation = $monetarySummation;
        return $this;
    }

}