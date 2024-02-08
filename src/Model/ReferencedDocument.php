<?php

declare(strict_types=1);

/*
 * This file is part of the ZUGFeRD PHP package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class ReferencedDocument
{
    #[Type(Id::class)]
    #[SerializedName('IssuerAssignedID')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public Id $issuerAssignedID;

    #[Type(Id::class)]
    #[SerializedName('URIID')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?Id $uriid = null;

    #[Type('string')]
    #[SerializedName('TypeCode')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $typeCode = null;

    #[Type('string')]
    #[SerializedName('Name')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $name = null;

    #[Type(BinaryObject::class)]
    #[SerializedName('AttachmentBinaryObject')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?BinaryObject $attachmentBinaryObject = null;

    #[Type(FormattedDateTime::class)]
    #[SerializedName('FormattedIssueDateTime')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?FormattedDateTime $formattedIssueDateTime = null;

    public static function create(string $issuerAssignedID): self
    {
        $self = new self();
        $self->issuerAssignedID = Id::create($issuerAssignedID);

        return $self;
    }
}
