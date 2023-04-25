<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class Note
{
    /**
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ContentCode")
     */
    public ?string $contentCode = null;

    /**
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("Content")
     */
    public string $content;

    /**
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("SubjectCode")
     */
    public ?string $subjectCode = null;

    public static function create(string $content, ?string $subjectCode = null, ?string $contentCode = null): self
    {
        $self = new self();
        $self->content = $content;
        $self->subjectCode = $subjectCode;
        $self->contentCode = $contentCode;
        return $self;
    }
}
