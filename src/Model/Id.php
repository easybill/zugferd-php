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
use JMS\Serializer\Annotation\XmlAttribute;
use JMS\Serializer\Annotation\XmlValue;

class Id
{
    /**
     * @var string
     *
     * @Type("string")
     *
     * @XmlAttribute
     *
     * @SerializedName("schemeID")
     */
    public $schemeID;

    /**
     * @var string
     *
     * @Type("string")
     *
     * @XmlValue(cdata=false)
     */
    public $value;

    public static function create(string $id, ?string $schemeID = null): self
    {
        $self = new self();
        $self->value = $id;
        $self->schemeID = $schemeID;

        return $self;
    }
}
