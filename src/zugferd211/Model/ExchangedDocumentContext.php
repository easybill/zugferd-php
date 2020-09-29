<?php namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class ExchangedDocumentContext
{
    /**
     * @var DocumentContextParameter
     * @Type("Easybill\ZUGFeRD211\Model\DocumentContextParameter")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("GuidelineSpecifiedDocumentContextParameter")
     */
    public $documentContextParameter;
}
