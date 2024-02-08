<?php

declare(strict_types=1);

/*
 * This file is part of the ZUGFeRD PHP package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation as JMS;

class Indicator
{
    /**
     * @JMS\Type("boolean")
     *
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100")
     *
     * @JMS\SerializedName("Indicator")
     */
    public bool $indicator;
}
