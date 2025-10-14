<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

#[AccessorOrder(order: 'custom', custom: ['personName', 'departmentName', 'telephoneUniversalCommunication', 'faxUniversalCommunication', 'emailURIUniversalCommunication'])]
/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class TradeContact
{
    #[Type(UniversalCommunication::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('TelephoneUniversalCommunication')]
    public $telephoneUniversalCommunication;

    #[Type(UniversalCommunication::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('FaxUniversalCommunication')]
    public $faxUniversalCommunication;

    #[Type(UniversalCommunication::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('EmailURIUniversalCommunication')]
    public $emailURIUniversalCommunication;

    public function __construct(#[Type('string')]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('PersonName')]
        public ?string $personName = null, #[Type('string')]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('DepartmentName')]
        public ?string $departmentName = null, ?UniversalCommunication $telephoneUniversalCommunication = null, ?UniversalCommunication $faxUniversalCommunication = null, ?UniversalCommunication $emailURIUniversalCommunication = null)
    {
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
     * @return UniversalCommunication
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
     * @return UniversalCommunication
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
     * @return UniversalCommunication
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
