<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class LineTradeAgreement
{
    /**
     * @var TradePrice
     * @Type("Easybill\ZUGFeRD211\Model\TradePrice")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("GrossPriceProductTradePrice")
     */
    public $grossPrice;

    /**
     * @var TradePrice
     * @Type("Easybill\ZUGFeRD211\Model\TradePrice")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("NetPriceProductTradePrice")
     */
    public $netPrice;

}
