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

class TradeContact
{
    /**
     * @Type("string")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("PersonName")
     */
    public ?string $personName = null;

    /**
     * @Type("string")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("DepartmentName")
     */
    public ?string $departmentName = null;

    /**
     * @Type("Easybill\ZUGFeRD\Model\UniversalCommunication")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("TelephoneUniversalCommunication")
     */
    public ?UniversalCommunication $telephoneUniversalCommunication = null;

    /**
     * @Type("Easybill\ZUGFeRD\Model\UniversalCommunication")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("FaxUniversalCommunication")
     */
    public ?UniversalCommunication $faxUniversalCommunication = null;

    /**
     * @Type("Easybill\ZUGFeRD\Model\UniversalCommunication")
     *
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     *
     * @SerializedName("EmailURIUniversalCommunication")
     */
    public ?UniversalCommunication $emailURIUniversalCommunication = null;
}
