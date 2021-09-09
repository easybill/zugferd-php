<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class HeaderTradeAgreement
{
    /**
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("BuyerReference")
     */
    public ?string $buyerReference = null;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\TradeParty")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SellerTradeParty")
     */
    public TradeParty $sellerTradeParty;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\TradeParty")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("BuyerTradeParty")
     */
    public TradeParty $buyerTradeParty;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\ReferencedDocument")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("BuyerOrderReferencedDocument")
     */
    public ?ReferencedDocument $buyerOrderReferencedDocument = null;

    /**
     * @var ReferencedDocument[]
     * @Type("array<Easybill\ZUGFeRD211\Model\ReferencedDocument>")
     * @XmlList(inline = true, entry = "AdditionalReferencedDocument", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $additionalReferencedDocuments = [];

    /**
     * @Type("Easybill\ZUGFeRD211\Model\ProcuringProject")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SpecifiedProcuringProject")
     */
    public ?ProcuringProject $specifiedProcuringProject = null;
}
