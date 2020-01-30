<?php namespace Easybill\ZUGFeRD\ModelV2\Trade;

use Easybill\ZUGFeRD\ModelV2\Date;
use Easybill\ZUGFeRD\ModelV2\DateTime;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class DeliveryChainEvent
{

    /**
     * @var DateTime
     * @Type("Easybill\ZUGFeRD\ModelV2\Date")
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
     * @return \Easybill\ZUGFeRD\ModelV2\Date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}