<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class TradeParty
{
    /**
     * @Type("Easybill\ZUGFeRD211\Model\Id")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ID")
     */
    public ?Id $id = null;

    /**
     * @var Id[]
     * @Type("array<Easybill\ZUGFeRD211\Model\Id>")
     * @XmlList(inline = true, entry = "GlobalID", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $globalID = [];

    /**
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("Name")
     */
    public string $name;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\TradeContact")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("DefinedTradeContact")
     */
    public ?TradeContact $definedTradeContact = null;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\TradeAddress")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("PostalTradeAddress")
     */
    public ?TradeAddress $postalTradeAddress = null;

    /**
     * @var TaxRegistration[]
     * @Type("array<Easybill\ZUGFeRD211\Model\TaxRegistration>")
     * @XmlList(inline=true, entry="SpecifiedTaxRegistration", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public $taxRegistrations = [];
}
