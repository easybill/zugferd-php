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

class ExchangedDocumentContext
{
    /**
     * @Type("Easybill\ZUGFeRD\Model\DocumentContextParameter")
     *
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("GuidelineSpecifiedDocumentContextParameter")
     */
    public DocumentContextParameter $documentContextParameter;
}
