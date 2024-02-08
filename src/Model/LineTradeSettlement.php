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

class LineTradeSettlement
{
    /**
     * @var TradeTax[]
     *
     * @Type("array<Easybill\ZUGFeRD\Model\TradeTax>")
     *
     * @XmlList(inline = true, entry = "ApplicableTradeTax", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $tradeTax = [];

    /**
     * @var TradeAllowanceCharge[]
     *
     * @Type("array<Easybill\ZUGFeRD\Model\TradeAllowanceCharge>")
     *
     * @XmlList(inline = true, entry = "SpecifiedTradeAllowanceCharge", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $specifiedTradeAllowanceCharge = [];

    /**
     * @Type("Easybill\ZUGFeRD\Model\Period")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("BillingSpecifiedPeriod")
     */
    public ?Period $billingSpecifiedPeriod = null;

    /**
     * @Type("Easybill\ZUGFeRD\Model\TradeSettlementLineMonetarySummation")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("SpecifiedTradeSettlementLineMonetarySummation")
     */
    public TradeSettlementLineMonetarySummation $monetarySummation;

    /**
     * @var TradeAccountingAccount[]
     *
     * @Type("array<Easybill\ZUGFeRD\Model\TradeAccountingAccount>")
     *
     * @XmlList(inline = true, entry = "ReceivableSpecifiedTradeAccountingAccount", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $tradeAccountingAccount = [];
}
