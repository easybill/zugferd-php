<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * @XmlRoot("rsm:CrossIndustryInvoice")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100", prefix="rsm")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:QualifiedDataType:100", prefix="qdt")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100", prefix="ram")
 * @XmlNamespace(uri="http://www.w3.org/2001/XMLSchema", prefix="xs")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100", prefix="udt")
 */
class CrossIndustryInvoice
{
    /**
     * @Type("Easybill\ZUGFeRD211\Model\ExchangedDocumentContext")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100")
     * @SerializedName("ExchangedDocumentContext")
     */
    public ExchangedDocumentContext $exchangedDocumentContext;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\ExchangedDocument")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100")
     * @SerializedName("ExchangedDocument")
     */
    public ExchangedDocument $exchangedDocument;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\SupplyChainTradeTransaction")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100")
     * @SerializedName("SupplyChainTradeTransaction")
     */
    public SupplyChainTradeTransaction $supplyChainTradeTransaction;
}
