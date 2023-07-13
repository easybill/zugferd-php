<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation as JMS;

class TradePaymentTerms
{
    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("Description")
     */
    public ?string $description = null;

    /**
     * @JMS\Type("Easybill\ZUGFeRD211\Model\DateTime")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("DueDateDateTime")
     */
    public ?DateTime $dueDate = null;

    /**
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @JMS\SerializedName("DirectDebitMandateID")
     */
    public ?string $directDebitMandateID = null;
}
