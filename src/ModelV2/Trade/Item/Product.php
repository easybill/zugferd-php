<?php namespace Easybill\ZUGFeRD\ModelV2\Trade\Item;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * Class Product
 *
 * @package Easybill\ZUGFeRD\ModelV2\Trade\Item
 */
class Product
{
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SellerAssignedID")
     */
    private $sellerAssignedID;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("BuyerAssignedID")
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
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("Description")
     */
    private $description;

    /**
     * Product constructor.
     *
     * @param string $sellerAssignedID
     * @param string $name
     * @param string $buyerAssignedID
     */
    public function __construct($sellerAssignedID, $name ,$buyerAssignedID = null)
    {
        $this->sellerAssignedID = $sellerAssignedID;
        $this->name = $name;
        $this->buyerAssignedID = $buyerAssignedID;
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
}