<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class SupplyChainConsignment
{
    #[Type(Id::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ID')]
    public ?Id $id = null;

    /** @var LogisticsTransportMovement[] */
    #[Type('array<Easybill\ZUGFeRD2\Model\LogisticsTransportMovement>')]
    #[XmlList(entry: 'SpecifiedLogisticsTransportMovement', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $specifiedLogisticsTransportMovement = [];
}
