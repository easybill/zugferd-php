<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class ExchangedDocumentContext
{
    #[Type(Indicator::class)]
    #[XmlElement(namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('TestIndicator')]
    public ?Indicator $testIndicator = null;

    #[Type(DocumentContextParameter::class)]
    #[XmlElement(namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('BusinessProcessSpecifiedDocumentContextParameter')]
    public ?DocumentContextParameter $businessProcessSpecifiedDocumentContextParameter = null;

    #[Type(DocumentContextParameter::class)]
    #[XmlElement(namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('GuidelineSpecifiedDocumentContextParameter')]
    public DocumentContextParameter $documentContextParameter;
}
