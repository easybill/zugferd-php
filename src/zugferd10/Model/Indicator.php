<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * Class Indicator.
 */
/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class Indicator
{
    /**
     * Indicator constructor.
     *
     * @param bool $indicator
     */
    public function __construct(#[Type('boolean')]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15')]
        #[SerializedName('Indicator')]
        private $indicator) {}

    /**
     * @return bool
     */
    public function getIndicator()
    {
        return $this->indicator;
    }

    /**
     * @param bool $indicator
     */
    public function setIndicator($indicator)
    {
        $this->indicator = $indicator;
    }
}
