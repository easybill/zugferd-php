<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Model;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

class AdvancePayment
{
    #[Type(Amount::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('PaidAmount')]
    public ?Amount $paidAmount = null;

    #[Type(FormattedDateTime::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('FormattedReceivedDateTime')]
    public ?FormattedDateTime $formattedReceivedDateTime = null;

    /** @var TradeTax[] */
    #[Type('array<Easybill\ZUGFeRD2\Model\TradeTax>')]
    #[XmlList(entry: 'IncludedTradeTax', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    public array $includedTradeTax = [];

    #[Type(ReferencedDocument::class)]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100')]
    #[SerializedName('InvoiceSpecifiedReferencedDocument')]
    public ?ReferencedDocument $invoiceSpecifiedReferencedDocument = null;
}
