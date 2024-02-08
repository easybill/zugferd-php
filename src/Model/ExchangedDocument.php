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
use JMS\Serializer\Annotation\XmlList;

class ExchangedDocument
{
    #[Type('string')]
    #[SerializedName('ID')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public string $id;

    #[Type('string')]
    #[SerializedName('Name')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public ?string $name = null;

    #[Type('string')]
    #[SerializedName('TypeCode')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public string $typeCode;

    #[Type(DateTime::class)]
    #[SerializedName('IssueDateTime')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public DateTime $issueDateTime;

    /**
     * @var string[]
     */
    #[Type('array<string>')]
    #[XmlElement(cdata: false)]
    #[XmlList(inline: true, entry: 'LanguageID', namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $languageId = [];

    /**
     * @var Note[]
     */
    #[Type('array<Easybill\ZUGFeRD\Model\Note>')]
    #[XmlList(inline: true, entry: 'IncludedNote', namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $notes = [];
}
