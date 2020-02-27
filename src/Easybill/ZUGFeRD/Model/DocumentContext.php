<?php

namespace Easybill\ZUGFeRD\Model;

use Easybill\ZUGFeRD\Model\Indicator;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class DocumentContext
{
    /**
     * @var Easybill\ZUGFeRD\Model\Indicator,
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

    public function __construct($type, $testIndicator = false)
    {
        $this->type = new ContextParameterID('urn:ferd:CrossIndustryDocument:invoice:1p0:'.strtolower($type));
        $this->testIndicator = new Indicator($testIndicator);
    }

    public function getTestIndicator(): Indicator
    {
        return $this->testIndicator;
    }

    public function setTestIndicator($indicator)
    {
        $this->testIndicator = $indicator;

        return $this;
    }
}
