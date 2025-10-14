<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD;

use Easybill\ZUGFeRD\Model\Document;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class Builder
{
    public function __construct(private readonly SerializerInterface $serializer) {}

    public function getXML(Document $document): string
    {
        return $this->serializer->serialize($document, 'xml');
    }

    public static function create(): Builder
    {
        @trigger_error('ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).', E_USER_DEPRECATED);
        $serializer = SerializerBuilder::create()
            ->setDebug(true)
            ->build()
        ;
        return new self($serializer);
    }
}
