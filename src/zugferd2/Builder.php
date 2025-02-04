<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2;

use Easybill\ZUGFeRD2\Model\CrossIndustryInvoice;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class Builder
{
    public const GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_BASIC = 'urn:cen.eu:en16931:2017#compliant#urn:factur-x.eu:1p0:basic';
    public const GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_BASIC_WL = 'urn:factur-x.eu:1p0:basicwl';
    public const GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_MINIMUM = 'urn:factur-x.eu:1p0:minimum';
    public const GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_EN16931 = 'urn:cen.eu:en16931:2017';
    public const GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_XRECHNUNG = 'urn:cen.eu:en16931:2017#compliant#urn:xoev-de:kosit:standard:xrechnung_2.1';
    public const GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_EXTENDED = 'urn:cen.eu:en16931:2017#conformant#urn:factur-x.eu:1p0:extended';

    public function __construct(private readonly SerializerInterface $serializer) {}

    public function transform(CrossIndustryInvoice $crossIndustryInvoice): string
    {
        return $this->serializer->serialize($crossIndustryInvoice, 'xml');
    }

    public static function create(): Builder
    {
        $serializer = SerializerBuilder::create()
            ->setDebug(true)
            ->build()
        ;
        return new self($serializer);
    }
}
