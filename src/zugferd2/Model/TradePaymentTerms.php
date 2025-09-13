<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation as JMS;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

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

    #[Type(Id::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('DirectDebitMandateID')]
    public ?Id $directDebitMandateID = null;

    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('PartialPaymentAmount')]
    public ?Amount $partialPaymentAmount = null;

    #[JMS\Type(TradePaymentPenaltyTerms::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('ApplicableTradePaymentPenaltyTerms')]
    public ?TradePaymentPenaltyTerms $applicableTradePaymentPenaltyTerms = null;

    #[JMS\Type(TradePaymentDiscountTerms::class)]
    #[JMS\XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[JMS\SerializedName('ApplicableTradePaymentDiscountTerms')]
    public ?TradePaymentDiscountTerms $applicableTradePaymentDiscountTerms = null;

    #[Type(TradeParty::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('PayeeTradeParty')]
    public ?TradeParty $payeeTradeParty = null;
}
