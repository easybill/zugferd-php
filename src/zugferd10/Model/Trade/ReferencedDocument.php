<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;

#[AccessorOrder(order: 'custom', custom: ['issuedDateTime', 'typeCode', 'id'])]
/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class ReferencedDocument
{
    public function __construct(
        #[Type('string')]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('ID')]
        private string $id,
        #[Type('string')]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('IssueDateTime')]
        private ?string $issuedDateTime = null,
        #[Type('string')]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('TypeCode')]
        private ?string $typeCode = null
    ) {}

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

    /**
     * @return string
     */
    public function getIssuedDateTime()
    {
        return $this->issuedDateTime;
    }

    /**
     * @return self
     */
    public function setIssuedDateTime(string $issuedDateTime)
    {
        $this->issuedDateTime = $issuedDateTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getTypeCode()
    {
        return $this->typeCode;
    }

    /**
     * @return self
     */
    public function setTypeCode(string $typeCode)
    {
        $this->typeCode = $typeCode;
        return $this;
    }
}
