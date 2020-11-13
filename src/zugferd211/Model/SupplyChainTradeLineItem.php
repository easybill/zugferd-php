<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class SupplyChainTradeLineItem
{
    /**
     * @Type("Easybill\ZUGFeRD211\Model\DocumentLineDocument")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("AssociatedDocumentLineDocument")
     */
    public DocumentLineDocument $associatedDocumentLineDocument;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\TradeProduct")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedTradeProduct")
     */
    public TradeProduct $specifiedTradeProduct;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\LineTradeAgreement")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedLineTradeAgreement")
     */
    public LineTradeAgreement $tradeAgreement;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\LineTradeDelivery")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedLineTradeDelivery")
     */
    public ?LineTradeDelivery $delivery = null;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\LineTradeSettlement")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedLineTradeSettlement")
     */
    public LineTradeSettlement $specifiedLineTradeSettlement;
}
