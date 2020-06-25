<?php

namespace Easybill\ZUGFeRD\v21;

use Easybill\ZUGFeRD\Model\v21\Document;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializationContext;

class Builder
{

    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function getXML(Document $document): string
    {
        return $this->serializer->serialize(
            $document,
            'xml',
            SerializationContext::create()->setGroups([
                $document->getSerializationContext()
            ])
        );
    }

    public static function create(): Builder
    {
        $serializer = SerializerBuilder::create()
            ->setDebug(true)
            ->build();
        return new self($serializer);
    }
}