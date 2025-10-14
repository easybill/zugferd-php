<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Model;

use Easybill\ZUGFeRD\Model\Trade\Trade;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * Class Document.
 */
#[XmlRoot('rsm:CrossIndustryDocument')]
#[XmlNamespace(uri: 'http://www.w3.org/2001/XMLSchema-instance', prefix: 'xsi')]
#[XmlNamespace(uri: 'urn:ferd:CrossIndustryDocument:invoice:1p0', prefix: 'rsm')]
#[XmlNamespace(uri: 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12', prefix: 'ram')]
#[XmlNamespace(uri: 'urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15', prefix: 'udt')]
/**
 * @deprecated ZUGFeRD 1.0 is deprecated and will be removed in a future release. Please migrate to ZUGFeRD 2.0 (Easybill\ZUGFeRD2).
 */
class Document
{
    public const TYPE_BASIC = 'BASIC';
    public const TYPE_COMFORT = 'COMFORT';
    public const TYPE_EXTENDED = 'EXTENDED';

    #[Type(DocumentContext::class)]
    #[XmlElement(namespace: 'urn:ferd:CrossIndustryDocument:invoice:1p0')]
    #[SerializedName('SpecifiedExchangedDocumentContext')]
    private $context;

    #[Type(Header::class)]
    #[XmlElement(namespace: 'urn:ferd:CrossIndustryDocument:invoice:1p0')]
    #[SerializedName('HeaderExchangedDocument')]
    private $header;

    /**
     * @var Trade
     */
    #[Type(Trade::class)]
    #[XmlElement(cdata: false, namespace: 'urn:ferd:CrossIndustryDocument:invoice:1p0')]
    #[SerializedName('SpecifiedSupplyChainTradeTransaction')]
    private $trade;

    public function __construct($type = self::TYPE_BASIC, $testIndicator = false)
    {
        $this->context = new DocumentContext($type, $testIndicator);
        $this->header = new Header();
        $this->trade = new Trade();
    }

    /**
     * @return DocumentContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @return Header
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param Header $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @return Trade
     */
    public function getTrade()
    {
        return $this->trade;
    }

    public function setTrade(Trade $trade)
    {
        $this->trade = $trade;
    }
}
