<?php namespace Easybill\ZUGFeRD\Model\v21;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * Class Indicator
 *
 * @package Easybill\ZUGFeRD\Model
 */
class Indicator
{
    /**
     * @var boolean
     * @Type("boolean")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100")
     * @SerializedName("Indicator")
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
     * @return boolean
     */
    public function getIndicator()
    {
        return $this->indicator;
    }

    /**
     * @param boolean $indicator
     */
    public function setIndicator($indicator)
    {
        $this->indicator = $indicator;
    }

}