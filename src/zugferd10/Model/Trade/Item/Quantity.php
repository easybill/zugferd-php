<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade\Item;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class Quantity
{
    /**
     * @var string
     */
    #[Type('string')]
    #[XmlValue(cdata: false)]
    private $value;

    /**
     * Quantity constructor.
     *
     * @param string $unitCode
     * @param float $value
     */
    public function __construct(#[Type('string')]
        #[XmlAttribute]
        #[SerializedName('unitCode')]
        private $unitCode, $value)
    {
        $this->setValue($value);
    }

    /**
     * @return string
     */
    public function getUnitCode()
    {
        return $this->unitCode;
    }

    /**
     * @param string $unitCode
     */
    public function setUnitCode($unitCode)
    {
        $this->unitCode = $unitCode;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue($value)
    {
        $this->value = number_format($value, 4, '.', '');
    }
}
