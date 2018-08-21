<?php namespace Pyrexx\ZUGFeRD\Model;

use Pyrexx\ZUGFeRD\Model\Trade\Trade;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * Class Document
 *
 * @XmlRoot("rsm:CrossIndustryDocument")
 * @XmlNamespace(uri="http://www.w3.org/2001/XMLSchema-instance", prefix="xsi")
 * @XmlNamespace(uri="urn:ferd:CrossIndustryDocument:invoice:1p0", prefix="rsm")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12", prefix="ram")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15", prefix="udt")
 */
class Document
{
    const TYPE_BASIC = 'BASIC';
    const TYPE_COMFORT = 'COMFORT';
    const TYPE_EXTENDED = 'EXTENDED';

    /**
     * @Type("Pyrexx\ZUGFeRD\Model\DocumentContext")
     * @XmlElement(namespace="urn:ferd:CrossIndustryDocument:invoice:1p0")
     * @SerializedName("SpecifiedExchangedDocumentContext")
     */
    private $context;

    /**
     * @Type("Pyrexx\ZUGFeRD\Model\Header")
     * @XmlElement(namespace="urn:ferd:CrossIndustryDocument:invoice:1p0")
     * @SerializedName("HeaderExchangedDocument")
     */
    private $header;

    /**
     * @var Trade
     * @Type("Pyrexx\ZUGFeRD\Model\Trade\Trade")
     * @XmlElement(cdata = false, namespace = "urn:ferd:CrossIndustryDocument:invoice:1p0")
     * @SerializedName("SpecifiedSupplyChainTradeTransaction")
     */
    private $trade;

    public function __construct($type = self::TYPE_BASIC)
    {
        $this->context = new DocumentContext($type);
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
     * @return \Pyrexx\ZUGFeRD\Model\Trade\Trade
     */
    public function getTrade()
    {
        return $this->trade;
    }

    /**
     * @param \Pyrexx\ZUGFeRD\Model\Trade\Trade $trade
     *
     */
    public function setTrade(Trade $trade)
    {
        $this->trade = $trade;
    }


}