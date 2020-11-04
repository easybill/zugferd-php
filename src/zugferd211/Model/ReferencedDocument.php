<?php

namespace Easybill\ZUGFeRD211\Model;

    use JMS\Serializer\Annotation\SerializedName;
    use JMS\Serializer\Annotation\Type;
    use JMS\Serializer\Annotation\XmlElement;

class ReferencedDocument
{
    /**
     * @Type("Easybill\ZUGFeRD211\Model\Id")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("IssuerAssignedID")
     */
    public Id $issuerAssignedID;

    public static function create(string $orderNumber): self
    {
        $self = new self();
        $self->issuerAssignedID = Id::create($orderNumber);
        return $self;
    }
}
