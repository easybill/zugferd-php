<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class DocumentContext
{
    /**
     * @var \Easybill\ZUGFeRD\Model\Indicator,
     */
    #[Type(Indicator::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('TestIndicator')]
    private $testIndicator;

    /**
     * @var ContextParameterID
     */
    #[Type(ContextParameterID::class)]
    #[XmlElement(namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('GuidelineSpecifiedDocumentContextParameter')]
    private $type;

    public function __construct($type, bool $testIndicator = false)
    {
        $this->type = new ContextParameterID('urn:ferd:CrossIndustryDocument:invoice:1p0:' . strtolower((string)$type));
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
