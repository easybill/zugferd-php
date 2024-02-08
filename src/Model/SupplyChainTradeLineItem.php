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

class SupplyChainTradeLineItem
{
    /**
     * @Type("Easybill\ZUGFeRD\Model\DocumentLineDocument")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("AssociatedDocumentLineDocument")
     */
    public DocumentLineDocument $associatedDocumentLineDocument;

    /**
     * @Type("Easybill\ZUGFeRD\Model\TradeProduct")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("SpecifiedTradeProduct")
     */
    public TradeProduct $specifiedTradeProduct;

    /**
     * @Type("Easybill\ZUGFeRD\Model\LineTradeAgreement")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("SpecifiedLineTradeAgreement")
     */
    public LineTradeAgreement $tradeAgreement;

    /**
     * @Type("Easybill\ZUGFeRD\Model\LineTradeDelivery")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("SpecifiedLineTradeDelivery")
     */
    public ?LineTradeDelivery $delivery = null;

    /**
     * @Type("Easybill\ZUGFeRD\Model\LineTradeSettlement")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("SpecifiedLineTradeSettlement")
     */
    public LineTradeSettlement $specifiedLineTradeSettlement;
}
