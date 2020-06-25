<?php namespace Easybill\ZUGFeRD\Model\v21\Trade;

use Easybill\ZUGFeRD\Model\v21\Date;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class DeliveryChainEvent
{

    /**
     * @var Date
     * @Type("Easybill\ZUGFeRD\Model\v21\Date")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
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
     * @return \Easybill\ZUGFeRD\Model\v21\Date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\v21\Date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}