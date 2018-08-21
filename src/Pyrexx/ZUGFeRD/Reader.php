<?php

namespace Pyrexx\ZUGFeRD;

use Pyrexx\ZUGFeRD\Model\Document;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

class Reader
{
    private $serializer;

    function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param $xml
     *
     * @return mixed|Document
     */
    public function getDocument($xml)
    {
        return $this->serializer->deserialize($xml, 'Pyrexx\ZUGFeRD\Model\Document', 'xml');
    }

    public static function create()
    {
        $serializer = SerializerBuilder::create()
            ->setDebug(true)
            ->build();
        return new self($serializer);
    }
}