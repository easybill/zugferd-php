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

class BinaryObject
{
    /**
     * @JMS\Type("string")
     *
     * @JMS\XmlAttribute
     *
     * @JMS\SerializedName("mimeCode")
     */
    public string $mimeCode;

    /**
     * @JMS\Type("string")
     *
     * @JMS\XmlAttribute
     *
     * @JMS\SerializedName("filename")
     */
    public string $filename;

    /**
     * @JMS\Type("string")
     *
     * @JMS\XmlValue(cdata=false)
     */
    public string $value;
}
