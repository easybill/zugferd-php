<?php namespace Easybill\ZUGFeRD\Model\v21\Trade\Item;

use Easybill\ZUGFeRD\Model\v21\DateTime;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;
use JMS\Serializer\Annotation\Groups;

/**
 * Class Product
 *
 * @package Easybill\ZUGFeRD\Model\v21\Trade\Item
 */
class Product
{
    /**
     * @var GlobalID
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\Item\GlobalID")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("GlobalID")
     */
    private $globalID;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SellerAssignedID")
     * @XmlAttribute
     * @Groups({"extended"})
     */
    private $sellerAssignedID;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("BuyerAssignedID")
     * @XmlAttribute
     * @Groups({"extended"})
     */
    private $buyerAssignedID;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("Name")
     */
    private $name;

    /**
     * Product constructor.
     *
     * @param string $sellerAssignedID
     * @param string $name
     * @param string $globalID
     */
    public function __construct($sellerAssignedID, $name, $globalID)
    {
        $this->sellerAssignedID = $sellerAssignedID;
        $this->name = $name;
        $this->globalID = new GlobalID($globalID);
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
    public function getGlobalID()
    {
        return $this->globalID;
    }

    /**
     * @param string $globalID
     */
    public function setGlobalID($globalID)
    {
        $this->globalID = $globalID;
    }
}