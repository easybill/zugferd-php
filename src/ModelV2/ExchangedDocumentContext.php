<?php namespace Easybill\ZUGFeRD\ModelV2;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class ExchangedDocumentContext
{
    /**
     * @var \Easybill\ZUGFeRD\ModelV2\DocumentContextParameterID
     * @Type("Easybill\ZUGFeRD\ModelV2\DocumentContextParameterID")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("GuidelineSpecifiedDocumentContextParameter")
     */
    private $type;

    /**
     * @var \Easybill\ZUGFeRD\ModelV2\DocumentContextParameterID
     * @Type("Easybill\ZUGFeRD\ModelV2\DocumentContextParameterID")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("BusinessProcessSpecifiedDocumentContextParameter")
     */
    private $bptype;

    public function __construct($type)
    {
        $this->type = new DocumentContextParameterID('urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100:' . strtolower($type));
    }
}