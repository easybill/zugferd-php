<?php namespace Easybill\ZUGFeRD\Model\v21;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\Accessor;
use Easybill\ZUGFeRD\Model\v21\Document;
use Easybill\ZUGFeRD\Model\v21\Indicator;

class DocumentContext
{
    /**
     * @var \Easybill\ZUGFeRD\Model\v21\Indicator
     * @Type("Easybill\ZUGFeRD\Model\v21\Indicator")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("Indicator")
     * @Accessor(getter="getTestIndicator")
     */
    private $testIndicator;

    /**
     * @var \Easybill\ZUGFeRD\Model\v21\ContextParameterID
     * @Type("Easybill\ZUGFeRD\Model\v21\ContextParameterID")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("GuidelineSpecifiedDocumentContextParameter")
     */
    private $type;

    public function __construct($type, bool $testIndicator = false)
    {
        $this->type = new ContextParameterID($this->getTypeID($type));
        if($type === Document::TYPE_EXTENDED) {
            $this->testIndicator = new Indicator($testIndicator);
        }
    }

    public function getTestIndicator()
    {
        return $this->testIndicator;
    }

    private function getTypeID($type)
    {
        switch ($type) {
            case Document::TYPE_BASIC:
                return 'urn:cen.eu:en16931:2017#compliant#urn:factur-x.eu:1p0:basic';
                break;
            case Document::TYPE_EN16931:
                return 'urn:cen.eu:en16931:2017';
                break;
            case Document::TYPE_EXTENDED:
                return 'urn:cen.eu:en16931:2017#conformant# urn:factur-x.eu:1p0:extended';
                break;
        }
    }
}