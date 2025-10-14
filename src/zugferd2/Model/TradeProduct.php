<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

#[AccessorOrder(order: 'custom', custom: ['globalID', 'sellerAssignedID', 'buyerAssignedID', 'name', 'description', 'applicableProductCharacteristic', 'designatedProductClassification', 'tradeCountry', 'includedReferencedProduct'])]
class TradeProduct
{
    #[Type(Id::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('GlobalID')]
    public ?Id $globalID = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('SellerAssignedID')]
    public ?string $sellerAssignedID = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('BuyerAssignedID')]
    public ?string $buyerAssignedID = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('Name')]
    public string $name;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('Description')]
    public ?string $description = null;

    #[Type(TradeCountry::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('OriginTradeCountry')]
    public ?TradeCountry $tradeCountry = null;

    /** @var ProductCharacteristic[] */
    #[Type('array<Easybill\ZUGFeRD2\Model\ProductCharacteristic>')]
    #[XmlList(entry: 'ApplicableProductCharacteristic', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?array $applicableProductCharacteristic = [];

    #[Type(ProductClassification::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('DesignatedProductClassification')]
    public ?ProductClassification $designatedProductClassification = null;

    /** @var ReferencedProduct[] */
    #[Type('array<Easybill\ZUGFeRD2\Model\ReferencedProduct>')]
    #[XmlList(entry: 'IncludedReferencedProduct', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $includedReferencedProduct = [];
}
