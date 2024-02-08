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

class DateTime
{
    /**
     * @Type("Easybill\ZUGFeRD\Model\DateTimeString")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100")
     *
     * @SerializedName("DateTimeString")
     */
    public DateTimeString $dateTimeString;

    public static function create(int $format, string $value): self
    {
        $self = new self();
        $self->dateTimeString = DateTimeString::create($format, $value);

        return $self;
    }
}
