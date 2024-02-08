<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TaxRegistration
{
    /**
     * @Type("Easybill\ZUGFeRD\Model\Id")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ID")
     */
    public Id $registration;

    public static function create(string $id, ?string $schemeID = null): self
    {
        $self = new self();
        $self->registration = Id::create($id, $schemeID);
        return $self;
    }
}
