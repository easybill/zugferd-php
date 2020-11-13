<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class SupplyChainTradeTransaction
{
    /**
     * @var SupplyChainTradeLineItem[]
     * @Type("array<Easybill\ZUGFeRD211\Model\SupplyChainTradeLineItem>")
     * @XmlList(inline=true, entry="IncludedSupplyChainTradeLineItem", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $lineItems = [];

    /**
     * @Type("Easybill\ZUGFeRD211\Model\HeaderTradeAgreement")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ApplicableHeaderTradeAgreement")
     */
    public HeaderTradeAgreement $applicableHeaderTradeAgreement;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\HeaderTradeDelivery")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ApplicableHeaderTradeDelivery")
     */
    public HeaderTradeDelivery $applicableHeaderTradeDelivery;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\HeaderTradeSettlement")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ApplicableHeaderTradeSettlement")
     */
    public HeaderTradeSettlement $applicableHeaderTradeSettlement;
}
