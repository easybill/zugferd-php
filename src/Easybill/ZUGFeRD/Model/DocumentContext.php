<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\XmlNamespace;

/**
 * Class DocumentContext
 *
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12", prefix="ram")
 */
class DocumentContext
{
    /**
     * @var \Easybill\ZUGFeRD\Model\ContextParameterID
     * @Type("Easybill\ZUGFeRD\Model\ContextParameterID")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("GuidelineSpecifiedDocumentContextParameter")
     */
    private $type;

    function __construct($type)
    {
        $this->type = new ContextParameterID('urn:ferd:CrossIndustryDocument:invoice:1p0:' . strtolower($type));
    }
}