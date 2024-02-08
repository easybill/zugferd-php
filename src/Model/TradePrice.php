<?php

declare(strict_types=1);

/*
 * This file is part of the ZUGFeRD PHP package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation as JMS;

class TradePrice
{
    /**
     * @JMS\Type("Easybill\ZUGFeRD\Model\Amount")
     *
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @JMS\SerializedName("ChargeAmount")
     */
    public Amount $chargeAmount;

    /**
     * @JMS\Type("Easybill\ZUGFeRD\Model\Quantity")
     *
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @JMS\SerializedName("BasisQuantity")
     */
    public ?Quantity $basisQuantity = null;

    /**
     * @JMS\Type("Easybill\ZUGFeRD\Model\TradeAllowanceCharge")
     *
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @JMS\SerializedName("AppliedTradeAllowanceCharge")
     */
    public ?TradeAllowanceCharge $appliedTradeAllowanceCharge = null;

    public static function create(string $amount, ?Quantity $quantity = null, ?TradeAllowanceCharge $appliedTradeAllowanceCharge = null): self
    {
        $self = new self();
        $self->chargeAmount = Amount::create($amount);
        $self->basisQuantity = $quantity;
        $self->appliedTradeAllowanceCharge = $appliedTradeAllowanceCharge;

        return $self;
    }
}
