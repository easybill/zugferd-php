<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class UniversalCommunication
{
    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('CompleteNumber')]
    public $completeNumber;

    #[Type('string')]
    #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    #[SerializedName('URIID')]
    public $uriid;

    public function __construct(?string $completeNumber = null, ?string $uriid = null)
    {
        $this->completeNumber = $completeNumber;
        $this->uriid = $uriid;
    }

    /**
     * @return string
     */
    public function getCompleteNumber()
    {
        return $this->completeNumber;
    }

    /**
     * @return self
     */
    public function setCompleteNumber(string $completeNumber)
    {
        $this->completeNumber = $completeNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getUriid()
    {
        return $this->uriid;
    }

    /**
     * @return self
     */
    public function setUriid(string $uriid)
    {
        $this->uriid = $uriid;
        return $this;
    }
}
