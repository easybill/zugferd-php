<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TradeContact
{
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("PersonName")
     */
    public $personName;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("DepartmentName")
     */
    public $departmentName;

    /**
     * @var UniversalCommunication
     * @Type("Easybill\ZUGFeRD211\Model\UniversalCommunication")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("TelephoneUniversalCommunication")
     */
    public $telephoneUniversalCommunication;

    /**
     * @var UniversalCommunication
     * @Type("Easybill\ZUGFeRD211\Model\UniversalCommunication")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("EmailURIUniversalCommunication")
     */
    public $emailURIUniversalCommunication;
}
