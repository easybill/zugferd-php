<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class LineTradeAgreement
{
    /**
     * @Type("Easybill\ZUGFeRD\Model\TradePrice")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("GrossPriceProductTradePrice")
     */
    public ?TradePrice $grossPrice = null;

    /**
     * @Type("Easybill\ZUGFeRD\Model\TradePrice")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("NetPriceProductTradePrice")
     */
    public TradePrice $netPrice;
}
