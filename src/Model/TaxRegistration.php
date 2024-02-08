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

class TaxRegistration
{
    /**
     * @Type("Easybill\ZUGFeRD\Model\Id")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
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
