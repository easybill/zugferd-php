<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class TradeProduct
{
    #[Type(Id::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ID')]
    public ?Id $id = null;

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
    #[SerializedName('IndustryAssignedID')]
    public ?string $industryAssignedID = null;

    #[Type(Id::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ModelID')]
    public ?Id $modelID = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('Name')]
    public string $name;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('Description')]
    public ?string $description = null;

    /** @var Id[] */
    #[Type('array<Easybill\ZUGFeRD2\Model\Id>')]
    #[XmlList(entry: 'BatchID', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $batchID = [];

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('BrandName')]
    public ?string $brandName = null;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('ModelName')]
    public ?string $modelName = null;

    /** @var ProductCharacteristic[] */
    #[Type('array<Easybill\ZUGFeRD2\Model\ProductCharacteristic>')]
    #[XmlList(entry: 'ApplicableProductCharacteristic', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?array $applicableProductCharacteristic = [];

    /** @var ProductClassification[] */
    #[Type('array<Easybill\ZUGFeRD2\Model\ProductClassification>')]
    #[XmlList(entry: 'DesignatedProductClassification', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $designatedProductClassification = [];

    #[Type(TradeCountry::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('OriginTradeCountry')]
    public ?TradeCountry $tradeCountry = null;

    /** @var TradeProductInstance[] */
    #[Type('array<Easybill\ZUGFeRD2\Model\TradeProductInstance>')]
    #[XmlList(entry: 'IndividualTradeProductInstance', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?array $individualTradeProductInstance = [];

    /** @var ReferencedProduct[] */
    #[Type('array<Easybill\ZUGFeRD2\Model\ReferencedProduct>')]
    #[XmlList(entry: 'IncludedReferencedProduct', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $includedReferencedProduct = [];
}
