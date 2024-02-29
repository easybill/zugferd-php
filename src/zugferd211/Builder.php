<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD211;

use Easybill\ZUGFeRD211\Model\CrossIndustryInvoice;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class Builder
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

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
