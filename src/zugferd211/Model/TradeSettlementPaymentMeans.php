<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TradeSettlementPaymentMeans
{
    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("TypeCode")
     */
    public $typeCode;

    /**
     * @var string
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("Information")
     */
    public $information;

    /**
     * @var CreditorFinancialAccountType
     * @Type("Easybill\ZUGFeRD211\Model\CreditorFinancialAccountType")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("PayeePartyCreditorFinancialAccount")
     */
    public $payeePartyCreditorFinancialAccount;

    /**
     * @var CreditorFinancialInstitution
     * @Type("Easybill\ZUGFeRD211\Model\CreditorFinancialInstitution")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("PayeeSpecifiedCreditorFinancialInstitution")
     */
    public $payeeSpecifiedCreditorFinancialInstitution;
}
