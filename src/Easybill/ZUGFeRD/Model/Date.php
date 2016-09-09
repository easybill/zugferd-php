<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Class IssueDate
 *
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12", prefix="ram")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15", prefix="udt")
 *
 * @package Easybill\ZUGFeRD\Model
 */
class Date
{

    public function __construct($date, $format = 102)
    {
        $this->date = new DateTime($date, $format);
    }

    /**
     * @var DateTime
     * @Type("Easybill\ZUGFeRD\Model\DateTime")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15")
     * @SerializedName("DateTimeString")
     */
    private $date;

    /**
     * @return \Easybill\ZUGFeRD\Model\DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


}