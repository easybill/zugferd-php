<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model\Trade;

use Easybill\ZUGFeRD\Model\Trade\Tax\TradeTax;
use JMS\Serializer\Annotation\AccessorOrder;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlList;

#[AccessorOrder(order: 'custom', custom: ['description', 'appliedAmount', 'tradeTaxes'])]
/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class SpecifiedLogisticsServiceCharge
{
    /** @var TradeTax[] */
    #[Type('array<Easybill\ZUGFeRD\Model\Trade\Tax\TradeTax>')]
    #[XmlList(entry: 'AppliedTradeTax', inline: true, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
    private array $tradeTaxes = [];

    public function __construct(#[Type('string')]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('Description')]
        private string $description, #[Type(Amount::class)]
        #[XmlElement(cdata: false, namespace: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12')]
        #[SerializedName('AppliedAmount')]
        private Amount $appliedAmount) {}

    /**
     * Get the value of description.
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return self
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Amount
     */
    public function getAppliedAmount()
    {
        return $this->appliedAmount;
    }

    /**
     * @return self
     */
    public function setAppliedAmount(Amount $appliedAmount)
    {
        $this->appliedAmount = $appliedAmount;
        return $this;
    }

    /**
     * @return TradeTax[]
     */
    public function getTradeTaxes()
    {
        return $this->tradeTaxes;
    }

    /**
     * @return self
     */
    public function addTradeTax(TradeTax $tradeTax)
    {
        $this->tradeTaxes[] = $tradeTax;
        return $this;
    }
}
