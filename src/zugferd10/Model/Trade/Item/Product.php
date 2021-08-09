<?php

namespace Easybill\ZUGFeRD\Model\Trade\Item;

use Easybill\ZUGFeRD\Model\Trade\TradeCountry;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

/**
 * Class Product.
 */
class Product
{
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("SellerAssignedID")
     */
    private $sellerAssignedID;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("BuyerAssignedID")
     */
    private $buyerAssignedID;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("Name")
     */
    private $name;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("Description")
     */
    private $description;

    /**
     * @var TradeCountry[]
     * @Type("array<Easybill\ZUGFeRD\Model\Trade\TradeCountry>")
     * @XmlList(inline = true, entry = "OriginTradeCountry", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     */
    private $tradeCountries = [];

    /**
     * Product constructor.
     *
     * @param string $sellerAssignedID
     * @param string $name
     * @param null|mixed $description
     */
    public function __construct($sellerAssignedID, $name, $description = null)
    {
        $this->sellerAssignedID = $sellerAssignedID;
        $this->name = $name;
        $this->description = $description;
    }

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
