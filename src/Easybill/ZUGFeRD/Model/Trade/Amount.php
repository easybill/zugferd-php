<?php

namespace Easybill\ZUGFeRD\Model\Trade;

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
     * @var double
     * @Type("double")
     * @XmlValue(cdata = false)
     */
    private $value = '';

    /**
     * @var string
     * @Type("string")
     * @XmlAttribute
     * @SerializedName("currencyID")
     */
    private $currency = '';

    /**
     * Amount constructor.
     *
     * @param double $value
     * @param string $currency
     */
    public function __construct($value, $currency, $isDiscount = false)
    {
        $this->setValue($value, $isDiscount);
        $this->currency = $currency;
    }


    /**
     * @return double
     */
    public function getValue()
    {
        return doubleval($this->value);
    }

    /**
     * @param string $value
     */
    public function setValue($value, $isDiscount = false)
    {
        $this->value = str_replace(',', '', number_format($value, ($isDiscount === false) ? 2 : 4));
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