<?php

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TradeContact
{
    /**
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("PersonName")
     */
    public ?string $personName;

    /**
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("DepartmentName")
     */
    public ?string $departmentName;

    /**
     * @Type("Easybill\ZUGFeRD\Model\Trade\UniversalCommunication")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("TelephoneUniversalCommunication")
     */
    public $telephoneUniversalCommunication;

    /**
     * @Type("Easybill\ZUGFeRD\Model\Trade\UniversalCommunication")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("FaxUniversalCommunication")
     */
    public $faxUniversalCommunication;

    /**
     * @Type("Easybill\ZUGFeRD\Model\Trade\UniversalCommunication")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("EmailURIUniversalCommunication")
     */
    public $emailURIUniversalCommunication;

    public function __construct(string $personName = null, string $departmentName = null, UniversalCommunication $telephoneUniversalCommunication = null, UniversalCommunication $faxUniversalCommunication = null, UniversalCommunication $emailURIUniversalCommunication = null)
    {
        $this->personName = $personName;
        $this->departmentName = $departmentName;
        $this->telephoneUniversalCommunication = $telephoneUniversalCommunication;
        $this->faxUniversalCommunication = $faxUniversalCommunication;
        $this->emailURIUniversalCommunication = $emailURIUniversalCommunication;
    }

    /**
     * @return string
     */
    public function getPersonName()
    {
        return $this->personName;
    }

    /**
     * @param string $personName
     * @return self
     */
    public function setPersonName($personName)
    {
        $this->personName = $personName;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepartmentName()
    {
        return $this->departmentName;
    }

    /**
     * @param string $departmentName
     * @return self
     */
    public function setDepartmentName($departmentName)
    {
        $this->departmentName = $departmentName;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\UniversalCommunication
     */
    public function getTelephoneUniversalCommunication()
    {
        return $this->telephoneUniversalCommunication;
    }

    /**
     * @return self
     */
    public function setTelephoneUniversalCommunication(UniversalCommunication $telephoneUniversalCommunication)
    {
        $this->telephoneUniversalCommunication = $telephoneUniversalCommunication;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\UniversalCommunication
     */
    public function getFaxUniversalCommunication()
    {
        return $this->faxUniversalCommunication;
    }

    /**
     * @return self
     */
    public function setFaxUniversalCommunication(UniversalCommunication $faxUniversalCommunication)
    {
        $this->faxUniversalCommunication = $faxUniversalCommunication;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\UniversalCommunication
     */
    public function getEmailURIUniversalCommunication()
    {
        return $this->emailURIUniversalCommunication;
    }

    /**
     * @return self
     */
    public function setEmailURIUniversalCommunication(UniversalCommunication $emailURIUniversalCommunication)
    {
        $this->emailURIUniversalCommunication = $emailURIUniversalCommunication;
        return $this;
    }
}
