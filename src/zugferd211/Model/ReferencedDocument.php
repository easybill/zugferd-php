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

    /**
     * @Type("Easybill\ZUGFeRD211\Model\Id")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("URIID")
     */
    public ?Id $uriid = null;

    /**
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("TypeCode")
     */
    public ?string $typeCode = null;

    /**
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("Name")
     */
    public ?string $name = null;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\BinaryObject")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("AttachmentBinaryObject")
     */
    public ?BinaryObject $attachmentBinaryObject = null;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\FormattedDateTime")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("FormattedIssueDateTime")
     */
    public ?FormattedDateTime $formattedIssueDateTime = null;

    public static function create(string $issuerAssignedID): self
    {
        $self = new self();
        $self->issuerAssignedID = Id::create($issuerAssignedID);
        return $self;
    }
}
