<?php

namespace Easybill\ZUGFeRD\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TradeSettlementPaymentMeans
{
    /**
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("TypeCode")
     */
    public string $typeCode;

    /**
     * @Type("string")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("Information")
     */
    public ?string $information = null;

    /**
     * @Type("Easybill\ZUGFeRD\Model\CreditorFinancialAccount")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("PayeePartyCreditorFinancialAccount")
     */
    public ?CreditorFinancialAccount $payeePartyCreditorFinancialAccount = null;

    /**
     * @Type("Easybill\ZUGFeRD\Model\CreditorFinancialInstitution")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("PayeeSpecifiedCreditorFinancialInstitution")
     */
    public ?CreditorFinancialInstitution $payeeSpecifiedCreditorFinancialInstitution = null;

    /**
     * @Type("Easybill\ZUGFeRD\Model\DebtorFinancialAccount")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("PayerPartyDebtorFinancialAccount")
     */
    public ?DebtorFinancialAccount $payerPartyDebtorFinancialAccount = null;
    /**
     * @Type("Easybill\ZUGFeRD\Model\TradeSettlementFinancialCard")
     * @XmlElement(cdata=false,namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ApplicableTradeSettlementFinancialCard")
     */
    public ?TradeSettlementFinancialCard $applicableTradeSettlementFinancialCard = null;
}
