<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation as JMS;

class LegalOrganization
{
    /**
     * @JMS\Type("Easybill\ZUGFeRD211\Model\Id")
     * @JMS\XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("ID")
     */
    public Id $id;

    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("TradingBusinessName")
     */
    public ?string $tradingBusinessName = null;

    /**
     * @JMS\Type("Easybill\ZUGFeRD211\Model\TradeAddress")
     * @JMS\XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("PostalTradeAddress")
     */
    public ?TradeAddress $postalTradeAddress = null;
}
