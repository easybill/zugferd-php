<?php namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

/**
 * Class Amount
 *
 * @package Easybill\ZUGFeRD\Model\Trade
 */
class Amount
{

    /**
     * @var string
     * @Type("string")
     * @XmlValue(cdata = false)
     */
    private $value;

    /**
     * @var string
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("currencyID")
     */
    private $currency;

    /**
     * Amount constructor.
     *
     * @param double $value
     * @param string $currency
     * @param bool $isSum
     */
    public function __construct($value, $currency, $isSum = true)
    {
        $this->setValue($value, $isSum);
        $this->currency = $currency;
    }


    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @param bool $isSum
     */
    public function setValue($value, $isSum = true)
    {
        $this->value = number_format($value, ($isSum === true) ? 2 : 4, '.', '');
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }


}