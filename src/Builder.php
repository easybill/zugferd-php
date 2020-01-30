<?php

namespace Easybill\ZUGFeRD;

use Easybill\ZUGFeRD\Model\Document;
use Easybill\ZUGFeRD\ModelV2\Invoice;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class Builder
{

    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function getXML(Document $document): string
    {
        return $this->serializer->serialize($document, 'xml');
    }
    public function getXMLv2(Invoice $document): string
    {
        return $this->serializer->serialize($document, 'xml');
    }

    public static function create(): Builder
    {
        $serializer = SerializerBuilder::create()
            ->setDebug(true)
            ->build();
        return new self($serializer);
    }
}