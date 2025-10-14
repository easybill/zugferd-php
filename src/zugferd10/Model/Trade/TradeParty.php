<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use Easybill\ZUGFeRD\Model\Address;
use Easybill\ZUGFeRD\Model\Trade\Tax\TaxRegistration;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;
use Easybill\ZUGFeRD\Model\Schema;

#[AccessorOrder(order: 'custom', custom: ['id', 'globalId', 'name', 'definedTradeContact', 'postalTradeAddress', 'specifiedTaxRegistration'])]
/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class TradeParty
{
    /**
     * @var string
     */
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('ID')]
    private $id;
    /**
     * @var TradePartyGlobalId
     */
    #[Type(Schema::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('GlobalID')]
    private $globalId;

    #[Type(TradeContact::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('DefinedTradeContact')]
    public $definedTradeContact;

    public function __construct(#[Type('string')]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('Name')]
        private string $name, #[Type(Address::class)]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('PostalTradeAddress')]
        private Address $address, /**
     * @var TaxRegistration[]
     */
        #[Type('array<Easybill\ZUGFeRD\Model\Trade\Tax\TaxRegistration>')]
        #[XmlList(inline: true, entry: 'SpecifiedTaxRegistration', namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        private array $taxRegistrations = [], ?TradeContact $definedTradeContact = null)
    {
        $this->definedTradeContact = $definedTradeContact;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Schema
     */
    public function getGlobalId()
    {
        return $this->globalId;
    }

    /**
     * @return self
     */
    public function setGlobalId(Schema $schema)
    {
        $this->globalId = $schema;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return self
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return TaxRegistration[]
     */
    public function getTaxRegistrations()
    {
        return $this->taxRegistrations;
    }

    /**
     * @return self
     */
    public function addTaxRegistration(TaxRegistration $taxRegistration)
    {
        $this->taxRegistrations[] = $taxRegistration;
        return $this;
    }

    /**
     * @return Tax\TradeContact
     */
    public function getDefinedTradeContact()
    {
        return $this->definedTradeContact;
    }

    /**
     * @return self
     */
    public function setDefinedTradeContact(TradeContact $definedTradeContact)
    {
        $this->definedTradeContact = $definedTradeContact;
        return $this;
    }
}
