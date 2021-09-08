<?php

namespace Easybill\ZUGFeRD211\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class ExchangedDocument
{
    /**
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("ID")
     */
    public string $id;

    /**
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("Name")
     */
    public ?string $name = null;

    /**
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("TypeCode")
     */
    public string $typeCode;

    /**
     * @Type("Easybill\ZUGFeRD211\Model\DateTime")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     * @SerializedName("IssueDateTime")
     */
    public DateTime $issueDateTime;

    /**
     * @var string[]
     * @Type("array<string>")
     * @XmlElement(cdata=false)
     * @XmlList(inline = true, entry = "LanguageID", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $languageId = [];

    /**
     * @var Note[]
     * @Type("array<Easybill\ZUGFeRD211\Model\Note>")
     * @XmlList(inline = true, entry = "IncludedNote", namespace="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100")
     */
    public array $notes = [];
}
