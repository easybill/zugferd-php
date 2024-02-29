<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD;

use Easybill\ZUGFeRD\Model\Document;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class Builder
{
    public function __construct(private readonly SerializerInterface $serializer)
    {
    }

    public function getXML(Document $document): string
    {
        return $this->serializer->serialize($document, 'xml');
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
