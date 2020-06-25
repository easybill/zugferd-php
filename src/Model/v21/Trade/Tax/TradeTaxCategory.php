<?php namespace Easybill\ZUGFeRD\Model\v21\Trade\Tax;

use Easybill\ZUGFeRD\Model\v21\Trade\Amount;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\Groups;

/**
 * @AccessorOrder("custom", custom = {"calculatedAmount", "code", "exemptionReason", "basisAmount", "category", "exemptionReasonCode", "percent"})
 */
class TradeTaxCategory extends TradeTaxItem
{
    //
}