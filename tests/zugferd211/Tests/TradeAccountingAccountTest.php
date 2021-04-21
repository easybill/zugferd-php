<?php

namespace Easybill\ZUGFeRD211\Tests;

use PHPUnit\Framework\TestCase;
use Easybill\ZUGFeRD211\Builder;
use Easybill\ZUGFeRD211\Model\CrossIndustryInvoice;
use Easybill\ZUGFeRD211\Model\ExchangedDocumentContext;
use Easybill\ZUGFeRD211\Model\DocumentContextParameter;
use Easybill\ZUGFeRD211\Model\ExchangedDocument;
use Easybill\ZUGFeRD211\Model\DateTime;
use Easybill\ZUGFeRD211\Model\Id;
use Easybill\ZUGFeRD211\Model\Amount;
use Easybill\ZUGFeRD211\Model\SupplyChainTradeTransaction;
use Easybill\ZUGFeRD211\Model\HeaderTradeAgreement;
use Easybill\ZUGFeRD211\Model\TradeParty;
use Easybill\ZUGFeRD211\Model\HeaderTradeDelivery;
use Easybill\ZUGFeRD211\Model\HeaderTradeSettlement;
use Easybill\ZUGFeRD211\Model\TradeSettlementHeaderMonetarySummation;
use Easybill\ZUGFeRD211\Model\SupplyChainTradeLineItem;
use Easybill\ZUGFeRD211\Model\LineTradeSettlement;
use Easybill\ZUGFeRD211\Model\DocumentLineDocument;
use Easybill\ZUGFeRD211\Model\TradeProduct;
use Easybill\ZUGFeRD211\Model\LineTradeAgreement;
use Easybill\ZUGFeRD211\Model\TradePrice;
use Easybill\ZUGFeRD211\Model\TradeSettlementLineMonetarySummation;
use Easybill\ZUGFeRD211\Model\TradeAccountingAccount;

class TradeAccountingAccountTest extends TestCase
{
    public function testTradeAccountingAccount(): void
    {
        $invoice = $this->getMinimalInvoice();

        $item1 = new SupplyChainTradeLineItem();
        $item1->associatedDocumentLineDocument = DocumentLineDocument::create('1');
        $item1->specifiedTradeProduct = new TradeProduct();
        $item1->specifiedTradeProduct->name = 'Paper A4';
        $item1->tradeAgreement = new LineTradeAgreement();
        $item1->tradeAgreement->netPrice = TradePrice::create('10.00');
        $item1->specifiedLineTradeSettlement = new LineTradeSettlement();
        $item1->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('10.00');

        $tradeAccountingAccount = new TradeAccountingAccount();
        $tradeAccountingAccount->id = Id::create('123');
        $tradeAccountingAccount->typeCode = 'moo';
        $item1->specifiedLineTradeSettlement->tradeAccountingAccount[] = $tradeAccountingAccount;

        $invoice->supplyChainTradeTransaction->lineItems[] = $item1;

        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<rsm:CrossIndustryInvoice xmlns:a="urn:un:unece:uncefact:data:standard:QualifiedDataType:100" xmlns:rsm="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100" xmlns:qdt="urn:un:unece:uncefact:data:standard:QualifiedDataType:10" xmlns:ram="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:udt="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100">
  <rsm:ExchangedDocumentContext>
    <ram:GuidelineSpecifiedDocumentContextParameter>
      <ram:ID>urn:cen.eu:en16931:2017#compliant#urn:xoev-de:kosit:standard:xrechnung_1.2</ram:ID>
    </ram:GuidelineSpecifiedDocumentContextParameter>
  </rsm:ExchangedDocumentContext>
  <rsm:ExchangedDocument>
    <ram:ID>12345</ram:ID>
    <ram:TypeCode>380</ram:TypeCode>
    <ram:IssueDateTime>
      <udt:DateTimeString format="102">20180305</udt:DateTimeString>
    </ram:IssueDateTime>
  </rsm:ExchangedDocument>
  <rsm:SupplyChainTradeTransaction>
    <ram:IncludedSupplyChainTradeLineItem>
      <ram:AssociatedDocumentLineDocument>
        <ram:LineID>1</ram:LineID>
      </ram:AssociatedDocumentLineDocument>
      <ram:SpecifiedTradeProduct>
        <ram:Name>Paper A4</ram:Name>
      </ram:SpecifiedTradeProduct>
      <ram:SpecifiedLineTradeAgreement>
        <ram:NetPriceProductTradePrice>
          <ram:ChargeAmount>10.00</ram:ChargeAmount>
        </ram:NetPriceProductTradePrice>
      </ram:SpecifiedLineTradeAgreement>
      <ram:SpecifiedLineTradeSettlement>
        <ram:SpecifiedTradeSettlementLineMonetarySummation>
          <ram:LineTotalAmount>10.00</ram:LineTotalAmount>
        </ram:SpecifiedTradeSettlementLineMonetarySummation>
        <ram:ReceivableSpecifiedTradeAccountingAccount>
          <ram:ID>123</ram:ID>
          <ram:TypeCode>moo</ram:TypeCode>
        </ram:ReceivableSpecifiedTradeAccountingAccount>
      </ram:SpecifiedLineTradeSettlement>
    </ram:IncludedSupplyChainTradeLineItem>
    <ram:ApplicableHeaderTradeAgreement>
      <ram:SellerTradeParty>
        <ram:GlobalID schemeID="0088">00000123</ram:GlobalID>
        <ram:Name>Company GmbH</ram:Name>
      </ram:SellerTradeParty>
      <ram:BuyerTradeParty>
        <ram:ID>12345</ram:ID>
        <ram:Name>Foo Bar</ram:Name>
      </ram:BuyerTradeParty>
    </ram:ApplicableHeaderTradeAgreement>
    <ram:ApplicableHeaderTradeDelivery/>
    <ram:ApplicableHeaderTradeSettlement>
      <ram:InvoiceCurrencyCode>EUR</ram:InvoiceCurrencyCode>
      <ram:SpecifiedTradeSettlementHeaderMonetarySummation>
        <ram:DuePayableAmount>100.00</ram:DuePayableAmount>
      </ram:SpecifiedTradeSettlementHeaderMonetarySummation>
    </ram:ApplicableHeaderTradeSettlement>
  </rsm:SupplyChainTradeTransaction>
</rsm:CrossIndustryInvoice>
XML;
        $this->assertEquals(
            // Removes white-space
            preg_replace('/\s/', '', $xml),
            preg_replace('/\s/', '', Builder::create()->transform($invoice))
        );
    }

    /**
     * @return CrossIndustryInvoice
     */
    private function getMinimalInvoice(): CrossIndustryInvoice
    {
        $invoice = new CrossIndustryInvoice();
        $invoice->exchangedDocumentContext = new ExchangedDocumentContext();
        $invoice->exchangedDocumentContext->documentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->documentContextParameter->id = 'urn:cen.eu:en16931:2017#compliant#urn:xoev-de:kosit:standard:xrechnung_1.2';
        $invoice->exchangedDocument = new ExchangedDocument();
        $invoice->exchangedDocument->id = '12345';
        $invoice->exchangedDocument->issueDateTime = DateTime::create(102, '20180305');
        $invoice->exchangedDocument->typeCode = '380';

        $invoice->supplyChainTradeTransaction = new SupplyChainTradeTransaction();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement = new HeaderTradeAgreement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerTradeParty = new TradeParty();
        $sellerTradeParty->globalID[] = Id::create('00000123', '0088');
        $sellerTradeParty->name = 'Company GmbH';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerTradeParty = $buyerTradeParty = new TradeParty();
        $buyerTradeParty->id = Id::create('12345');
        $buyerTradeParty->name = 'Foo Bar';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery = new HeaderTradeDelivery();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement = new HeaderTradeSettlement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->currency = 'EUR';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = $summation = new TradeSettlementHeaderMonetarySummation();
        $summation->duePayableAmount = Amount::create('100.00');

        return $invoice;
    }
}
