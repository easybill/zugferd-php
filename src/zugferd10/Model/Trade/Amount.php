<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

/**
 * Class Amount.
 */
class Amount
{
    /**
     * @var string
     */
    #[Type('string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Amount constructor.
     *
     * @param float $value
     * @param string $currency
     */
    public function __construct($value, #[Type('string')]
        #[XmlAttribute]
        #[SerializedName('currencyID')]
        private $currency, bool $isSum = true)
    {
        $this->setValue($value, $isSum);
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
     * @return self
     */
    public function setValue($value, bool $isSum = true)
    {
        $this->value = number_format($value, $isSum ? 2 : 4, '.', '');
        return $this;
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
     * @return self
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }
}
