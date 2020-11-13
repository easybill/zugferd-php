<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation as JMS;

class DateTime
{
    /**
     * @var int
     * @JMS\Type("integer")
     * @JMS\XmlAttribute
     */
    private $format;
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlValue(cdata=false)
     */
    private $time;

    /**
     * DateTime constructor.
     *
     * @param \DateTime|string $time
     * @param int $format
     */
    public function __construct($time, $format = 102)
    {
        if ($format !== 102 && $format !== 610 && $format !== 616) {
            throw new \RuntimeException('Invalid format! Please set it to: 102, 610 or 616');
        }

        if ($time instanceof \DateTime) {
            $dateTime = $time;
        } elseif (is_string($time)) {
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
