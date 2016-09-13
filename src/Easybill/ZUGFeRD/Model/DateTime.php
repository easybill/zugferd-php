<?php


namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;
use JMS\Serializer\Annotation\Type;

/**
 * Class DateTime
 *
 * @package Easybill\ZUGFeRD\Model
 */
class DateTime
{
    /**
     * DateTime constructor.
     *
     * @param string $time
     * @param int    $format
     */
    public function __construct($time, $format = 102)
    {
        $this->time = $time;
        $this->format = $format;
    }

    /**
     * @var int
     * @Type("integer")
     * @XmlAttribute
     */
    private $format;

    /**
     * @var string
     * @Type("string")
     * @XmlValue(cdata=false)
     */
    private $time;

    /**
     * @return int
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param int $format
     *
     * @return self
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string $time
     *
     * @return self
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }


}