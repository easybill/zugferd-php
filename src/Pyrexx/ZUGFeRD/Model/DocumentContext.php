<?php namespace Pyrexx\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class DocumentContext
{
    /**
     * @var \Pyrexx\ZUGFeRD\Model\ContextParameterID
     * @Type("Pyrexx\ZUGFeRD\Model\ContextParameterID")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("GuidelineSpecifiedDocumentContextParameter")
     */
    private $type;

    public function __construct($type)
    {
        $this->type = new ContextParameterID('urn:ferd:CrossIndustryDocument:invoice:1p0:' . strtolower($type));
    }
}