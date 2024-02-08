<?php

declare(strict_types=1);

/*
 * This file is part of the ZUGFeRD PHP package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TradeContact
{
    #[Type('string')]
    #[SerializedName('PersonName')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $personName = null;

    #[Type('string')]
    #[SerializedName('DepartmentName')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $departmentName = null;

    #[Type(UniversalCommunication::class)]
    #[SerializedName('TelephoneUniversalCommunication')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?UniversalCommunication $telephoneUniversalCommunication = null;

    #[Type(UniversalCommunication::class)]
    #[SerializedName('FaxUniversalCommunication')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?UniversalCommunication $faxUniversalCommunication = null;

    #[Type(UniversalCommunication::class)]
    #[SerializedName('EmailURIUniversalCommunication')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?UniversalCommunication $emailURIUniversalCommunication = null;
}
