<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class DocumentContext
{
    /**
     * @var \Easybill\ZUGFeRD\Model\Indicator,
     * @Type("Easybill\ZUGFeRD\Model\Indicator")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("TestIndicator")
     */
    private $testIndicator;

    /**
     * @var \Easybill\ZUGFeRD\Model\ContextParameterID
     * @Type("Easybill\ZUGFeRD\Model\ContextParameterID")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("GuidelineSpecifiedDocumentContextParameter")
     */
    private $type;

    public function __construct($type, bool $testIndicator = false)
    {
        $this->type = new ContextParameterID('urn:ferd:CrossIndustryDocument:invoice:1p0:' . strtolower($type));
        if ($testIndicator) {
            $this->setTestIndicator($testIndicator);
        }
    }

    /**
     * @return null|Indicator
     */
    public function getTestIndicator()
    {
        return $this->testIndicator;
    }

    public function setTestIndicator(bool $bool)
    {
        $this->testIndicator = new Indicator($bool);
    }
}
