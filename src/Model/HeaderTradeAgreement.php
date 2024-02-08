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
use JMS\Serializer\Annotation\XmlList;

class HeaderTradeAgreement
{
    /**
     * @Type("string")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("BuyerReference")
     */
    public ?string $buyerReference = null;

    /**
     * @Type("Easybill\ZUGFeRD\Model\TradeParty")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("SellerTradeParty")
     */
    public TradeParty $sellerTradeParty;

    /**
     * @Type("Easybill\ZUGFeRD\Model\TradeParty")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("BuyerTradeParty")
     */
    public TradeParty $buyerTradeParty;

    /**
     * @Type("Easybill\ZUGFeRD\Model\ReferencedDocument")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("BuyerOrderReferencedDocument")
     */
    public ?ReferencedDocument $buyerOrderReferencedDocument = null;

    /**
     * @Type("Easybill\ZUGFeRD\Model\ReferencedDocument")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("ContractReferencedDocument")
     */
    public ?ReferencedDocument $contractReferencedDocument = null;

    /**
     * @var ReferencedDocument[]
     *
     * @Type("array<Easybill\ZUGFeRD\Model\ReferencedDocument>")
     *
     * @XmlList(inline = true, entry = "AdditionalReferencedDocument", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $additionalReferencedDocuments = [];

    /**
     * @Type("Easybill\ZUGFeRD\Model\ProcuringProject")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("SpecifiedProcuringProject")
     */
    public ?ProcuringProject $specifiedProcuringProject = null;
}
