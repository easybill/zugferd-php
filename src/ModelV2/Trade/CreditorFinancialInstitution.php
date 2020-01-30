<?php namespace Easybill\ZUGFeRD\ModelV2\Trade;

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
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("BICID")
     */
    private $bic;


    public function __construct($bic)
    {
        $this->bic = $bic;

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
        // deprecated in v2
    }

    /**
     * @param string $germanBLZ
     */
    public function setGermanBLZ($germanBLZ)
    {
        // deprecated in v2
    }

    /**
     * @return string
     */
    public function getName()
    {
        // deprecated in v2
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        // deprecated in v2
    }

}