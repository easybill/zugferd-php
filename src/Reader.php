<?php

namespace Easybill\ZUGFeRD;

use Easybill\ZUGFeRD\Model\Document;
use Easybill\ZUGFeRD\ModelV2\Invoice;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class Reader
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function getDocument(string $xml,string $standard='zugferd.1p0')
    {
        switch($standard) {
            case "zugferd.1p0":
                return $this->serializer->deserialize($xml, Document::class, 'xml');
                break;
            case "zugferd.2p0":
                return $this->serializer->deserialize($xml, Invoice::class, 'xml');
                break;

        }

    }

    public static function create(): Reader
    {
        $serializer = SerializerBuilder::create()
            ->setDebug(true)
            ->build();
        return new self($serializer);
    }
}