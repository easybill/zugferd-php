<?php namespace Easybill\ZUGFeRD\Model\Trade;

use Easybill\ZUGFeRD\Model\Address;
use Easybill\ZUGFeRD\Model\Trade\Tax\TaxRegistration;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;
use Easybill\ZUGFeRD\Model\Schema;

class TradeParty
{
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("ID")
     */
    private $id;
    /**
     * @var TradePartyGlobalId
     * @Type("Easybill\ZUGFeRD\Model\Schema")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("GlobalID")
     */
    private $globalId;
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("Name")
     */
    private $name;
    /**
     * @var Address
     * @Type("Easybill\ZUGFeRD\Model\Address")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("PostalTradeAddress")
     */
    private $address;
    /**
     * @var TaxRegistration[]
     * @Type("array<Easybill\ZUGFeRD\Model\Trade\Tax\TaxRegistration>")
     * @XmlList(inline = true, entry = "SpecifiedTaxRegistration", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     */
    private $taxRegistrations;

    public function __construct($name = '', Address $address, array $taxRegistrations = array())
    {
        $this->name = $name;
        $this->address = $address;
        $this->taxRegistrations = $taxRegistrations;
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
     * @return \Easybill\ZUGFeRD\Model\Schema
     */
    public function getGlobalId()
    {
        return $this->globalId;
    }

    /**
     * @param string $globalId
     *
     * @return self
     */
    public function setGlobalId($globalId)
    {
        $this->globalId = new Schema("0088", $globalId);
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
     * @return \Easybill\ZUGFeRD\Model\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Address $address
     *
     * @return self
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\Tax\TaxRegistration[]
     */
    public function getTaxRegistrations()
    {
        return $this->taxRegistrations;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\Tax\TaxRegistration $taxRegistration
     *
     * @return self
     */
    public function addTaxRegistration(TaxRegistration $taxRegistration)
    {
        $this->taxRegistrations[] = $taxRegistration;
        return $this;
    }
}
