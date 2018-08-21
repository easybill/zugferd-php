<?php namespace Pyrexx\ZUGFeRD\Model\Trade;

use Pyrexx\ZUGFeRD\Model\Address;
use Pyrexx\ZUGFeRD\Model\Trade\Tax\TaxRegistration;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class TradeParty
{

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("Name")
     */
    private $name;
    /**
     * @var Address
     * @Type("Pyrexx\ZUGFeRD\Model\Address")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("PostalTradeAddress")
     */
    private $address;
    /**
     * @var TaxRegistration[]
     * @Type("array<Pyrexx\ZUGFeRD\Model\Trade\Tax\TaxRegistration>")
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
     * @return \Pyrexx\ZUGFeRD\Model\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Address $address
     *
     * @return self
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Tax\TaxRegistration[]
     */
    public function getTaxRegistrations()
    {
        return $this->taxRegistrations;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Tax\TaxRegistration $taxRegistration
     *
     * @return self
     */
    public function addTaxRegistration(TaxRegistration $taxRegistration)
    {
        $this->taxRegistrations[] = $taxRegistration;
        return $this;
    }


}