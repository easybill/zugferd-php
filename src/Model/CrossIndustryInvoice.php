<?php

declare(strict_types=1);

/*
 * This file is part of the ZUGFeRD PHP package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * @XmlRoot("rsm:CrossIndustryInvoice")
 *
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100", prefix="rsm")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:QualifiedDataType:100", prefix="qdt")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100", prefix="ram")
 * @XmlNamespace(uri="http://www.w3.org/2001/XMLSchema", prefix="xs")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100", prefix="udt")
 */
class CrossIndustryInvoice
{
    #[Type(ExchangedDocumentContext::class)]
    #[SerializedName('ExchangedDocumentContext')]
    #[XmlElement(namespace: 'urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100')]
    public ExchangedDocumentContext $exchangedDocumentContext;

    #[Type(ExchangedDocument::class)]
    #[SerializedName('ExchangedDocument')]
    #[XmlElement(namespace: 'urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100')]
    public ExchangedDocument $exchangedDocument;

    #[Type(SupplyChainTradeTransaction::class)]
    #[SerializedName('SupplyChainTradeTransaction')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100')]
    public SupplyChainTradeTransaction $supplyChainTradeTransaction;
}
