<?php

namespace Pyrexx\ZUGFeRD;

use Pyrexx\ZUGFeRD\Model\Document;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

class Builder
{

    private $serializer;

    function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function getXML(Document $document)
    {
        return $this->serializer->serialize($document, 'xml');
    }

    public static function create()
    {
        $serializer = SerializerBuilder::create()
            ->setDebug(true)
            ->build();
        return new self($serializer);
    }
}