<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2;

use Easybill\ZUGFeRD2\Model\CrossIndustryInvoice;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class Reader
{
    public function __construct(private readonly SerializerInterface $serializer) {}

    public function transform(string $xml): CrossIndustryInvoice
    {
        // @phpstan-ignore-next-line
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
