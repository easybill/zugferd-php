<?php

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class CreditorFinancialInstitution
{
    /**
     * BIC (Bank Cdentifier Code) of a credit institution.
     *
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("BICID")
     */
    private $bic;

    /**
     * The german 'Bankleitzahl'.
     *
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("GermanBankleitzahlID")
     */
    private $germanBLZ;

    /**
     * Name of the credit institution.
     *
     * @var string
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12")
     * @SerializedName("Name")
     */
    private $name;

    /**
     * CreditorFinancialInstitution constructor.
     *
     * @param string $bic
     * @param string $germanBLZ
     * @param string $name
     */
    public function __construct($bic, $germanBLZ, $name)
    {
        $this->bic = $bic;
        $this->germanBLZ = $germanBLZ;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * @param string $bic
     */
    public function setBic($bic)
    {
        $this->bic = $bic;
    }

    /**
     * @return string
     */
    public function getGermanBLZ()
    {
        return $this->germanBLZ;
    }

    /**
     * @param string $germanBLZ
     */
    public function setGermanBLZ($germanBLZ)
    {
        $this->germanBLZ = $germanBLZ;
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
