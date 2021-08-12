<?php

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class ReferencedDocument
{
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("IssueDateTime")
     */
    private $issuedDateTime;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("TypeCode")
     */
    private $typeCode;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("ID")
     */
    private $id;

    public function __construct(string $id, string $issuedDateTime = null, string $typeCode = null)
    {
        $this->issuedDateTime = $issuedDateTime;
        $this->typeCode = $typeCode;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return self
     */
    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getIssuedDateTime()
    {
        return $this->issuedDateTime;
    }

    /**
     * @return self
     */
    public function setIssuedDateTime(string $issuedDateTime)
    {
        $this->issuedDateTime = $issuedDateTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getTypeCode()
    {
        return $this->typeCode;
    }

    /**
     * @return self
     */
    public function setTypeCode(string $typeCode)
    {
        $this->typeCode = $typeCode;
        return $this;
    }
}
