<?php namespace Easybill\ZUGFeRD\Model\v21;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class DateTime
{
    /**
     * @var int
     * @Type("integer")
     * @XmlAttribute
     * @Accessor(getter="getFormat")
     */
    private $format;
    /**
     * @var string
     * @Type("string")
     * @XmlValue(cdata=false)
     * @Accessor(getter="getTime")
     */
    private $time;

    /**
     * DateTime constructor.
     *
     * @param \DateTime|string $time
     * @param int              $format
     */
    public function __construct($time, $format = 102)
    {

        if ($format !== 102 && $format !== 610 && $format !== 616) {
            throw new \RuntimeException('Invalid format! Please set it to: 102, 610 or 616');
        }

        if ($time instanceof \DateTime) {
            $dateTime = $time;
        } else if (is_string($time)) {
            $dateTime = new \DateTime($time);
        } else {
            throw new \RuntimeException('Invalid date! it must be an instance of \DateTime or must be a string!');
        }

        switch ($format) {
            case 616:
                $formatStr = 'YW';
                break;

            case 610:
                $formatStr = 'Ym';
                break;

            case 102:
            default:
                $formatStr = 'Ymd';

        }

        $this->time = $dateTime->format($formatStr);
        $this->format = $format;
    }

    /**
     * @return int
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

}