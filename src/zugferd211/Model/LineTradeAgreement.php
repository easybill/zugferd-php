<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class LineTradeAgreement
{
    /**
     * @Type("Easybill\ZUGFeRD211\Model\TradePrice")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("GrossPriceProductTradePrice")
     */
    public ?TradePrice $grossPrice = null;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\TradePrice")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("NetPriceProductTradePrice")
     */
    public TradePrice $netPrice;
}
