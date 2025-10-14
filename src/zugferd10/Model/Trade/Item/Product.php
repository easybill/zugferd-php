<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade\Item;

use Easybill\ZUGFeRD\Model\Trade\TradeCountry;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

#[AccessorOrder(order: 'custom', custom: ['sellerAssignedID', 'name', 'description', 'tradeCountries'])]
/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class Product
{
    /**
     * @var string
     */
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('BuyerAssignedID')]
    private $buyerAssignedID;

    /**
     * @var TradeCountry[]
     */
    #[Type('array<Easybill\ZUGFeRD\Model\Trade\TradeCountry>')]
    #[XmlList(entry: 'OriginTradeCountry', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    private $tradeCountries = [];

    public function __construct(#[Type('string')]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('SellerAssignedID')]
        private ?string $sellerAssignedID, #[Type('string')]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('Name')]
        private string $name, #[Type('string')]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('Description')]
        private mixed $description = null) {}

    /**
     * @return string
     */
    public function getSellerAssignedID()
    {
        return $this->sellerAssignedID;
    }

    /**
     * @param string $sellerAssignedID
     */
    public function setSellerAssignedID($sellerAssignedID)
    {
        $this->sellerAssignedID = $sellerAssignedID;
    }

    /**
     * @return string
     */
    public function getBuyerAssignedID()
    {
        return $this->buyerAssignedID;
    }

    /**
     * @return self
     */
    public function setBuyerAssignedID(string $buyerAssignedID)
    {
        $this->buyerAssignedID = $buyerAssignedID;
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
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return self
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return TradeCountry[]
     */
    public function getTradeCountries()
    {
        return $this->tradeCountries;
    }

    /**
     * @param TradeCountry[] $tradeCountry
     * @return self
     */
    public function addTradeCountry(TradeCountry $tradeCountry)
    {
        $this->tradeCountries[] = $tradeCountry;
        return $this;
    }
}
