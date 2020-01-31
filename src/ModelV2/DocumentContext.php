<?php namespace Easybill\ZUGFeRD\ModelV2;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class DocumentContext
{
    /**
     * @var \Easybill\ZUGFeRD\ModelV2\ContextParameterID
     * @Type("Easybill\ZUGFeRD\ModelV2\ContextParameterID")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("BusinessProcessSpecifiedDocumentContextParameter")
     */
    private $bp_type;

    /**
     * @var \Easybill\ZUGFeRD\ModelV2\ContextParameterID
     * @Type("Easybill\ZUGFeRD\ModelV2\ContextParameterID")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("GuidelineSpecifiedDocumentContextParameter")
     */
    private $type;


    public function __construct($type)
    {
        $this->type = new ContextParameterID('urn:cen.eu:en16931:2017');
    }
}