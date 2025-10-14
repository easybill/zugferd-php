<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade\Item;

use Easybill\ZUGFeRD\Model\Trade\Tax\TradeTax;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class SpecifiedTradeSettlement
{
    /**
     * @var TradeTax
     */
    #[Type(TradeTax::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('ApplicableTradeTax')]
    private $tradeTax;

    /**
     * @var SpecifiedTradeMonetarySummation
     */
    #[Type(SpecifiedTradeMonetarySummation::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('SpecifiedTradeSettlementMonetarySummation')]
    private $monetarySummation;

    /**
     * @return TradeTax
     */
    public function getTradeTax()
    {
        return $this->tradeTax;
    }

    /**
     * @param TradeTax $tradeTax
     *
     * @return self
     */
    public function setTradeTax($tradeTax)
    {
        $this->tradeTax = $tradeTax;
        return $this;
    }

    /**
     * @return SpecifiedTradeMonetarySummation
     */
    public function getMonetarySummation()
    {
        return $this->monetarySummation;
    }

    /**
     * @param SpecifiedTradeMonetarySummation $monetarySummation
     *
     * @return self
     */
    public function setMonetarySummation($monetarySummation)
    {
        $this->monetarySummation = $monetarySummation;
        return $this;
    }
}
