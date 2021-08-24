<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TradeContact
{
    /**
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("PersonName")
     */
    public ?string $personName = null;

    /**
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("DepartmentName")
     */
    public ?string $departmentName = null;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\UniversalCommunication")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("TelephoneUniversalCommunication")
     */
    public ?UniversalCommunication $telephoneUniversalCommunication = null;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\UniversalCommunication")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("FaxUniversalCommunication")
     */
    public ?UniversalCommunication $faxUniversalCommunication = null;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\UniversalCommunication")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("EmailURIUniversalCommunication")
     */
    public ?UniversalCommunication $emailURIUniversalCommunication = null;
}
