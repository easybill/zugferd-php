<?php

namespace Easybill\ZUGFeRD;

use Easybill\ZUGFeRD\Model\Document;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class Reader
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    public function getDocument(string $xml): Document
    {
        return $this->serializer->deserialize($xml, Document::class, 'xml');
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
