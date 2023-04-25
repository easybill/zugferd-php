<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class DocumentLineDocument
{
    /**
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("LineID")
     */
    public string $lineId;

    /**
     * @var Note[]
     * @Type("array<Easybill\ZUGFeRD211\Model\Note>")
     * @XmlList(inline=true, entry="IncludedNote", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $notes = [];

    public static function create(string $lineId): self
    {
        $self = new self();
        $self->lineId = $lineId;
        return $self;
    }
}
