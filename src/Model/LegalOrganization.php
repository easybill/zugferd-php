<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation as JMS;

class LegalOrganization
{
    /**
     * @JMS\Type("Easybill\ZUGFeRD\Model\Id")
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
     * @JMS\Type("Easybill\ZUGFeRD\Model\TradeAddress")
     * @JMS\XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("PostalTradeAddress")
     */
    public ?TradeAddress $postalTradeAddress = null;
}
