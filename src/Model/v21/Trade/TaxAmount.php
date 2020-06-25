<?php namespace Easybill\ZUGFeRD\Model\v21\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Groups;

/**
 * Class Amount
 *
 * @package Easybill\ZUGFeRD\Model\v21\Trade
 */
class TaxAmount extends Amount
{
    /**
     * @var string
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("currencyID")
     * @Accessor(getter="getCurrency")
     */
    private $currency;
}