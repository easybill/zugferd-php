<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Class Document
 *
 * @XmlRoot("rsm:CrossIndustryDocument")
 * @XmlNamespace(uri="http://www.w3.org/2001/XMLSchema-instance", prefix="xsi")
 * @XmlNamespace(uri="urn:ferd:CrossIndustryDocument:invoice:1p0", prefix="rsm")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12", prefix="ram")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15", prefix="udt")
 */
class Document
{
    const TYPE_BASIC = 'BASIC';

    /**
     * @Type("Easybill\ZUGFeRD\Model\DocumentContext")
     * @XmlElement(namespace="urn:ferd:CrossIndustryDocument:invoice:1p0")
     * @SerializedName("SpecifiedExchangedDocumentContext")
     */
    private $context;

    /**
     * @Type("Easybill\ZUGFeRD\Model\Header")
     * @XmlElement(namespace="urn:ferd:CrossIndustryDocument:invoice:1p0")
     * @SerializedName("HeaderExchangedDocument")
     */
    private $header;

    function __construct($type = self::TYPE_BASIC)
    {
        $this->context = new DocumentContext($type);
        $this->header = new Header();
    }

    /**
     * @return DocumentContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @return Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param Header $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

}