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
use JMS\Serializer\Annotation\XmlList;

class TradeParty
{
    #[Type(Id::class)]
    #[SerializedName('ID')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?Id $id = null;

    /**
     * @var Id[]
     */
    #[Type('array<Easybill\ZUGFeRD\Model\Id>')]
    #[XmlList(inline: true, entry: 'GlobalID', namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $globalID = [];

    #[Type('string')]
    #[SerializedName('Name')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public string $name;

    #[Type('string')]
    #[SerializedName('RoleCode')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $roleCode = null;

    #[Type('string')]
    #[SerializedName('Description')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $description = null;

    #[Type(LegalOrganization::class)]
    #[SerializedName('SpecifiedLegalOrganization')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?LegalOrganization $specifiedLegalOrganization = null;

    #[Type(TradeContact::class)]
    #[SerializedName('DefinedTradeContact')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?TradeContact $definedTradeContact = null;

    #[Type(TradeAddress::class)]
    #[SerializedName('PostalTradeAddress')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?TradeAddress $postalTradeAddress = null;

    /**
     * @var TaxRegistration[]
     */
    #[Type('array<Easybill\ZUGFeRD\Model\TaxRegistration>')]
    #[XmlList(inline: true, entry: 'SpecifiedTaxRegistration', namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public $taxRegistrations = [];
}
