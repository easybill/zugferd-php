<?php

namespace Easybill\ZUGFeRD\Tests;

use PHPUnit\Framework\TestCase;
use Easybill\ZUGFeRD\Builder;
use Easybill\ZUGFeRD\Model\Amount;
use Easybill\ZUGFeRD\Model\CrossIndustryInvoice;
use Easybill\ZUGFeRD\Model\DateTime;
use Easybill\ZUGFeRD\Model\DocumentContextParameter;
use Easybill\ZUGFeRD\Model\DocumentLineDocument;
use Easybill\ZUGFeRD\Model\ExchangedDocument;
use Easybill\ZUGFeRD\Model\ExchangedDocumentContext;
use Easybill\ZUGFeRD\Model\HeaderTradeAgreement;
use Easybill\ZUGFeRD\Model\HeaderTradeDelivery;
use Easybill\ZUGFeRD\Model\HeaderTradeSettlement;
use Easybill\ZUGFeRD\Model\Id;
use Easybill\ZUGFeRD\Model\LineTradeAgreement;
use Easybill\ZUGFeRD\Model\LineTradeSettlement;
use Easybill\ZUGFeRD\Model\SupplyChainTradeLineItem;
use Easybill\ZUGFeRD\Model\SupplyChainTradeTransaction;
use Easybill\ZUGFeRD\Model\TradeAccountingAccount;
use Easybill\ZUGFeRD\Model\TradeParty;
use Easybill\ZUGFeRD\Model\TradePrice;
use Easybill\ZUGFeRD\Model\TradeProduct;
use Easybill\ZUGFeRD\Model\TradeSettlementHeaderMonetarySummation;
use Easybill\ZUGFeRD\Model\TradeSettlementLineMonetarySummation;

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

        $xml = <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<rsm:CrossIndustryInvoice xmlns:rsm="urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100" xmlns:qdt="urn:un:unece:uncefact:data:standard:QualifiedDataType:100" xmlns:ram="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:udt="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100">
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
