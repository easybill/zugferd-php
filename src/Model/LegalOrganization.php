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

class LegalOrganization
{
    /**
     * @JMS\Type("Easybill\ZUGFeRD\Model\Id")
     *
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @JMS\SerializedName("ID")
     */
    public Id $id;

    /**
     * @JMS\Type("string")
     *
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @JMS\SerializedName("TradingBusinessName")
     */
    public ?string $tradingBusinessName = null;

    /**
     * @JMS\Type("Easybill\ZUGFeRD\Model\TradeAddress")
     *
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @JMS\SerializedName("PostalTradeAddress")
     */
    public ?TradeAddress $postalTradeAddress = null;
}
