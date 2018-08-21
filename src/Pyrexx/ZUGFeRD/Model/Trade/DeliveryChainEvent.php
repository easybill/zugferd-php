<?php namespace Pyrexx\ZUGFeRD\Model\Trade;

use Pyrexx\ZUGFeRD\Model\Date;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class DeliveryChainEvent
{

    /**
     * @var Date
     * @Type("Pyrexx\ZUGFeRD\Model\Date")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("OccurrenceDateTime")
     */
    private $date;

    /**
     * ChainEvent constructor.
     *
     * @param string $date
     * @param int $format
     */
    public function __construct($date = '', $format)
    {
        $this->date = new Date($date, $format);
    }


    /**
     * @return \Pyrexx\ZUGFeRD\Model\Date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}