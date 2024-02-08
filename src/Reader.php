<?php

declare(strict_types=1);

/*
 * This file is part of the ZUGFeRD PHP package.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Easybill\ZUGFeRD;

use Easybill\ZUGFeRD\Model\CrossIndustryInvoice;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

class Reader
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function transform(string $xml): CrossIndustryInvoice
    {
        return $this->serializer->deserialize($xml, CrossIndustryInvoice::class, 'xml');
    }

    public static function create(): self
    {
        $serializer = SerializerBuilder::create()
            ->setDebug(true)
            ->build()
        ;

        return new self($serializer);
    }
}
