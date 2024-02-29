<?php

namespace Easybill\ZUGFeRD211;

use Easybill\ZUGFeRD211\Model\CrossIndustryInvoice;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class Reader
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    public function transform(string $xml): CrossIndustryInvoice
    {
        return $this->serializer->deserialize($xml, CrossIndustryInvoice::class, 'xml');
    }

    public static function create(): Reader
    {
        $serializer = SerializerBuilder::create()
            ->setDebug(true)
            ->build()
        ;
        return new self($serializer);
    }
}
