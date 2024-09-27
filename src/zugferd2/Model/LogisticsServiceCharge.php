<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class LogisticsServiceCharge
{
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('Description')]
    public string $description;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('AppliedAmount')]
    public Amount $appliedAmount;

    /** @var TradeTax[] */
    #[Type('array<' . TradeTax::class . '>')]
    #[XmlList(entry: 'AppliedTradeTax', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $tradeTaxes = [];
}
