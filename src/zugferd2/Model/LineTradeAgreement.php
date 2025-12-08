<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class LineTradeAgreement
{
    #[Type(TradeDeliveryTerms::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ApplicableTradeDeliveryTerms')]
    public ?TradeDeliveryTerms $applicableTradeDeliveryTerms = null;

    #[Type(ReferencedDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('SellerOrderReferencedDocument')]
    public ?ReferencedDocument $sellerOrderReferencedDocument = null;

    #[Type(ReferencedDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('BuyerOrderReferencedDocument')]
    public ?ReferencedDocument $buyerOrderReferencedDocument = null;

    #[Type(ReferencedDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('QuotationReferencedDocument')]
    public ?ReferencedDocument $quotationReferencedDocument = null;

    #[Type(ReferencedDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ContractReferencedDocument')]
    public ?ReferencedDocument $contractReferencedDocument = null;

    /** @var ReferencedDocument[] */
    #[Type('array<Easybill\ZUGFeRD2\Model\ReferencedDocument>')]
    #[XmlList(entry: 'AdditionalReferencedDocument', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $additionalReferencedDocuments = [];

    #[Type(TradePrice::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('GrossPriceProductTradePrice')]
    public ?TradePrice $grossPrice = null;

    #[Type(TradePrice::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('NetPriceProductTradePrice')]
    public TradePrice $netPrice;

    #[Type(TradeParty::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ItemSellerTradeParty')]
    public TradeParty $itemSellerTradeParty;

    /** @var ReferencedDocument[] */
    #[Type('array<Easybill\ZUGFeRD2\Model\ReferencedDocument>')]
    #[XmlList(entry: 'UltimateCustomerOrderReferencedDocument', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $ultimateCustomerOrderReferencedDocument = [];

}
