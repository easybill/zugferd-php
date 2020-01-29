<?php namespace Easybill\ZUGFeRD\ModelV2;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\XmlElement;
use JMS\Serializer\Annotation\XmlNamespace;
use JMS\Serializer\Annotation\XmlRoot;

/**
 * Class Document
 *
 * @XmlRoot("rsm:CrossIndustryInvoice")
 * @XmlNamespace(uri="http://www.w3.org/2001/XMLSchema-instance", prefix="xsi")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100", prefix="rsm")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100", prefix="ram")
 * @XmlNamespace(uri="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100", prefix="udt")
 */
class Invoice
{
    const TYPE_BASIC = 'BASIC';
    const TYPE_COMFORT = 'COMFORT';
    const TYPE_EXTENDED = 'EXTENDED';

    /**
     * @Type("Easybill\ZUGFeRD\ModelV2\ExchangedDocumentContext")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100")
     * @SerializedName("ExchangedDocumentContext")
     */
    private $context;

    /**
     * @Type("Easybill\ZUGFeRD\ModelV2\ExchangedDocument")
     * @XmlElement(namespace="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100")
     * @SerializedName("ExchangedDocument")
     */
    private $document;

    /**
     * @var Trade
     * @Type("Easybill\ZUGFeRD\ModelV2\Trade\Trade")
     * @XmlElement(cdata = false, namespace = "urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100")
     * @SerializedName("SupplyChainTradeTransaction")
     */
    private $trade;

    public function __construct($type = self::TYPE_BASIC)
    {
        $this->context = new ExchangedDocumentContext($type);
        $this->document = new ExchangedDocument();
        $this->trade = new Trade();
    }

    /**
     * @return ExchangedDocumentContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @return ExchangedDocument
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param ExchangedDocument $document
     */
    public function setHeader($document)
    {
        $this->document = $document;
    }

    /**
     * @return \Easybill\ZUGFeRD\Model\Trade\Trade
     */
    public function getTrade()
    {
        return $this->trade;
    }

    /**
     * @param \Easybill\ZUGFeRD\Model\Trade\Trade $trade
     *
     */
    public function setTrade(Trade $trade)
    {
        $this->trade = $trade;
    }


}