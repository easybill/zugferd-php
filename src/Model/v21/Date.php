<?php namespace Easybill\ZUGFeRD\Model\v21;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\Accessor;

class Date
{

    /**
     * @var DateTime
     * @Type("Easybill\ZUGFeRD\Model\v21\DateTime")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100")
     * @SerializedName("DateTimeString")
     * @Accessor(getter="getDate")
     */
    private $date;

    /**
     * Date constructor.
     *
     * @param \DateTime|string $date
     * @param int $format
     */
    public function __construct($date, $format = 102)
    {
        $this->date = new DateTime($date, $format);
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getFormat()
    {
        return $this->date->getFormat();
    }

}