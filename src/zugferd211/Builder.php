<?php

namespace Easybill\ZUGFeRD211;

use Easybill\ZUGFeRD211\Model\CrossIndustryInvoice;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class Builder
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
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
