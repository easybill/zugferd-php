<?php namespace Easybill\ZUGFeRD\ModelV2\Trade\Tax;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TaxRegistration
{

    /**
     * @var Registration
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\Tax\Registration")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ID")
     */
    private $registration;

    /**
     * TaxRegistration constructor.
     *
     * @param string $schemeID
     * @param string $value
     */
    public function __construct($schemeID, $value = '')
    {
        $this->registration = new Registration($schemeID, $value);
    }


    /**
     * @return \Easybill\ZUGFeRD\ModelV2\Trade\Tax\Registration
     */
    public function getRegistration()
    {
        return $this->registration;
    }

    /**
     * @param \Easybill\ZUGFeRD\ModelV2\Trade\Tax\Registration $registration
     */
    public function setRegistration(Registration $registration)
    {
        $this->registration = $registration;
    }




}