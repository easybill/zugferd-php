<?php namespace Easybill\ZUGFeRD\ModelV2;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * Class ContextParameterID
 */
class DocumentContextParameterID
{

    /**
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("ID")
     */
    private $id;

    public function __construct($value)
    {
        $this->id = $value;
    }
}