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

class TradeSettlementPaymentMeans
{
    #[Type('string')]
    #[SerializedName('TypeCode')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public string $typeCode;

    #[Type('string')]
    #[SerializedName('Information')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $information = null;

    #[Type(CreditorFinancialAccount::class)]
    #[SerializedName('PayeePartyCreditorFinancialAccount')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?CreditorFinancialAccount $payeePartyCreditorFinancialAccount = null;

    #[Type(CreditorFinancialInstitution::class)]
    #[SerializedName('PayeeSpecifiedCreditorFinancialInstitution')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?CreditorFinancialInstitution $payeeSpecifiedCreditorFinancialInstitution = null;

    #[Type(DebtorFinancialAccount::class)]
    #[SerializedName('PayerPartyDebtorFinancialAccount')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?DebtorFinancialAccount $payerPartyDebtorFinancialAccount = null;
    #[Type(TradeSettlementFinancialCard::class)]
    #[SerializedName('ApplicableTradeSettlementFinancialCard')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?TradeSettlementFinancialCard $applicableTradeSettlementFinancialCard = null;
}
