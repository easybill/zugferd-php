<?php namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class TradeParty
{
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("Name")
     */
    public $name;

    /**
     * @var Address
     * @Type("Easybill\ZUGFeRD211\Model\Address")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("PostalTradeAddress")
     */
    public $postalTradeAddress;

    /**
     * @var TaxRegistration[]
     * @Type("array<Easybill\ZUGFeRD211\Model\TaxRegistration>")
     * @XmlList(inline=true, entry="SpecifiedTaxRegistration", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public $taxRegistrations;

}
