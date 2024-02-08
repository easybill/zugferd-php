<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class LogisticsServiceCharge
{
    /**
     * @Type("string")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("Description")
     */
    public string $description;

    /**
     * @Type("Easybill\ZUGFeRD\Model\Amount")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("AppliedAmount")
     */
    public Amount $appliedAmount;

    /**
     * @var TradeTax[]
     * @Type("array<Easybill\ZUGFeRD\Model\TradeTax>")
     * @XmlList(inline = true, entry = "AppliedTradeTax", namespace = "urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $tradeTaxes = [];
}
