<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class Schema
{
    /**
     * TaxRegistration constructor.
     *
     * @param string $schemeID
     * @param string $value
     */
    public function __construct(#[Type('string')]
        #[XmlAttribute]
        #[SerializedName('schemeID')]
        private $schemeID, #[Type('string')]
        #[XmlValue(cdata: false)]
        private $value = '') {}

    /**
     * @return string
     */
    public function getSchemeID()
    {
        return $this->schemeID;
    }

    /**
     * @param string $schemeID
     */
    public function setSchemeID($schemeID)
    {
        $this->schemeID = $schemeID;
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
        $this->value = $value;
    }
}
