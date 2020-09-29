<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation as JMS;

class TradePaymentTerms
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("Description")
     */
    public $description;

    /**
     * @var DateTime
     * @JMS\Type("Easybill\ZUGFeRD211\Model\DateTime")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("DueDateDateTime")
     */
    public $dueDate;
}
