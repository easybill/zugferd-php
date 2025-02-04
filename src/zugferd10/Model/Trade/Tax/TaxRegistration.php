<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade\Tax;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TaxRegistration
{
    /**
     * @var Registration
     */
    #[Type(Registration::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('ID')]
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
     * @return Registration
     */
    public function getRegistration()
    {
        return $this->registration;
    }

    public function setRegistration(Registration $registration)
    {
        $this->registration = $registration;
    }
}
