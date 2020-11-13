<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation as JMS;

/**
 * Class Indicator.
 */
class Indicator
{
    /**
     * @var bool
     * @JMS\Type("boolean")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15")
     * @JMS\SerializedName("Indicator")
     */
    private $indicator;

    /**
     * Indicator constructor.
     *
     * @param bool $indicator
     */
    public function __construct($indicator)
    {
        $this->indicator = $indicator;
    }

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
