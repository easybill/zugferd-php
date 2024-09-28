<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class TradeParty
{
    #[Type(Id::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ID')]
    public ?Id $id = null;

    /** @var Id[] */
    #[Type('array<' . Id::class . '>')]
    #[XmlList(entry: 'GlobalID', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $globalID = [];

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('Name')]
    public string $name;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('RoleCode')]
    public ?string $roleCode = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('Description')]
    public ?string $description = null;

    #[Type(LegalOrganization::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('SpecifiedLegalOrganization')]
    public ?LegalOrganization $specifiedLegalOrganization = null;

    #[Type(TradeContact::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('DefinedTradeContact')]
    public ?TradeContact $definedTradeContact = null;

    #[Type(TradeAddress::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('PostalTradeAddress')]
    public ?TradeAddress $postalTradeAddress = null;

    #[Type(UniversalCommunication::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('URIUniversalCommunication')]
    public ?UniversalCommunication $uriUniversalCommunication = null;

    /** @var TaxRegistration[] */
    #[Type('array<' . TaxRegistration::class . '>')]
    #[XmlList(entry: 'SpecifiedTaxRegistration', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $taxRegistrations = [];
}
