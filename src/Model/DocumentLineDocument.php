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
use JMS\Serializer\Annotation\XmlList;

class DocumentLineDocument
{
    /**
     * @Type("string")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("LineID")
     */
    public string $lineId;

    /**
     * @var Note[]
     *
     * @Type("array<Easybill\ZUGFeRD\Model\Note>")
     *
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
