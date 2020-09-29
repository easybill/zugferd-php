<?php

namespace Easybill\ZUGFeRD211\Model;

use Easybill\ZUGFeRD\Model\Trade\Tax\TradeTax;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class LineTradeSettlement
{
    /**
     * @var TradeTax
     * @Type("Easybill\ZUGFeRD211\Model\TradeTax")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ApplicableTradeTax")
     */
    public $tradeTax;

    /**
     * @var TradeSettlementLineMonetarySummation
     * @Type("Easybill\ZUGFeRD211\Model\TradeSettlementLineMonetarySummation")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedTradeSettlementLineMonetarySummation")
     */
    public $monetarySummation;
}
