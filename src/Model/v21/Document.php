<?php namespace Easybill\ZUGFeRD\Model\v21;

use Easybill\ZUGFeRD\Model\v21\Trade\Trade;
use Easybill\ZUGFeRD\Model\v21\DocumentContext;
use Easybill\ZUGFeRD\Model\v21\DocumentHeader;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;
use JMS\Serializer\Annotation\Exclude;

/**
 * Class Document
 *
 * @XmlRoot("rsm:CrossIndustryInvoice")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:QualifiedDataType:100", prefix="qdt")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100", prefix="ram")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100", prefix="rsm")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100", prefix="udt")
 * @XmlNamespace(uri="http://www.w3.org/2001/XMLSchema", prefix="xs")
 */
class Document
{
    const TYPE_BASIC = 'BASIC';
    const TYPE_EN16931 = 'EN16931';
    const TYPE_EXTENDED = 'EXTENDED';

    /**
     * @var string
     * @Type("string")
     * @Exclude
     */
    private $type;

    /**
     * @Type("Easybill\ZUGFeRD\Model\v21\DocumentContext")
     * @XmlElement(cdata=false, namespace="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100")
     * @SerializedName("ExchangedDocumentContext")
     */
    private $context;

    /**
     * @Type("Easybill\ZUGFeRD\Model\v21\DocumentHeader")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100")
     * @SerializedName("ExchangedDocument")
     */
    private $header;

    /**
     * @var Trade
     * @Type("Easybill\ZUGFeRD\Model\v21\Trade\Trade")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100")
     * @SerializedName("SupplyChainTradeTransaction")
     */
    private $trade;

    public function __construct($type = self::TYPE_BASIC)
    {
        $this->type = $type;
        $this->context = new DocumentContext($this->type);
        $this->header = new DocumentHeader();
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
     * @return DocumentHeader
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param DocumentHeader $header
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

    /**
     * @param Trade $trade
     */
    public function setTrade(Trade $trade)
    {
        $this->trade = $trade;
    }

    /**
     * @return Document Type as XML Context
     */
    public function getSerializationContext()
    {
        switch ($this->type) {
            case Document::TYPE_BASIC:
                return 'Default';
                break;
            case Document::TYPE_EN16931:
                return Document::TYPE_EN16931;
                break;
            case Document::TYPE_EXTENDED:
                return Document::TYPE_EXTENDED;
                break;
        }
    }
}