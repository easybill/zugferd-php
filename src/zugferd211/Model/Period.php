<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class Period
{
    /**
     * @Type("Easybill\ZUGFeRD211\Model\DateTime")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("StartDateTime")
     */
    public DateTime $startDatetime;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\DateTime")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("EndDateTime")
     */
    public DateTime $endDatetime;
}
