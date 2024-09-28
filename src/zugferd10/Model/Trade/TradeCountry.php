<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

class TradeCountry
{
    /**
     * Trade Country constructor.
     */
    public function __construct(#[Type('string')]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('ID')]
        private string $id) {}

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return self
     */
    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }
}
