<?php

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

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
    public function __construct($value, $currency)
    {
        $this->value = doubleval($value);
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
     */
    public function setValue($value)
    {
        $this->value = doubleval($value);
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