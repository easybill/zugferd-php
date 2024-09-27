<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation as JMS;

class TradePaymentTerms
{
    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('Description')]
    public ?string $description = null;

    #[JMS\Type(DateTime::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('DueDateDateTime')]
    public ?DateTime $dueDate = null;

    #[JMS\Type('string')]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('DirectDebitMandateID')]
    public ?string $directDebitMandateID = null;

    #[JMS\Type(Amount::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('PartialPaymentAmount')]
    public ?Amount $partialPaymentAmount = null;

    #[JMS\Type(TradePaymentPenaltyTerms::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('ApplicableTradePaymentPenaltyTerms')]
    public ?TradePaymentPenaltyTerms $applicableTradePaymentPenaltyTerms = null;

    #[JMS\Type(TradePaymentDiscountTerms::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('ApplicableTradePaymentDiscountTerms')]
    public ?TradePaymentDiscountTerms $applicableTradePaymentDiscountTerms = null;

    #[JMS\Type(TradeParty::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('PayeeTradeParty')]
    public ?TradeParty $payeeTradeParty = null;
}
