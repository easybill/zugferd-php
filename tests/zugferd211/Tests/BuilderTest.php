<?php

namespace Easybill\ZUGFeRD211\Tests;

use Easybill\ZUGFeRD211\Builder;
use Easybill\ZUGFeRD211\Model\Amount;
use Easybill\ZUGFeRD211\Model\CrossIndustryInvoice;
use Easybill\ZUGFeRD211\Model\DateTime;
use Easybill\ZUGFeRD211\Model\DocumentContextParameter;
use Easybill\ZUGFeRD211\Model\DocumentLineDocument;
use Easybill\ZUGFeRD211\Model\ExchangedDocument;
use Easybill\ZUGFeRD211\Model\ExchangedDocumentContext;
use Easybill\ZUGFeRD211\Model\HeaderTradeAgreement;
use Easybill\ZUGFeRD211\Model\HeaderTradeDelivery;
use Easybill\ZUGFeRD211\Model\HeaderTradeSettlement;
use Easybill\ZUGFeRD211\Model\Id;
use Easybill\ZUGFeRD211\Model\LineTradeAgreement;
use Easybill\ZUGFeRD211\Model\LineTradeSettlement;
use Easybill\ZUGFeRD211\Model\SupplyChainTradeLineItem;
use Easybill\ZUGFeRD211\Model\SupplyChainTradeTransaction;
use Easybill\ZUGFeRD211\Model\TradeParty;
use Easybill\ZUGFeRD211\Model\TradePrice;
use Easybill\ZUGFeRD211\Model\TradeProduct;
use Easybill\ZUGFeRD211\Model\TradeSettlementHeaderMonetarySummation;
use Easybill\ZUGFeRD211\Model\TradeSettlementLineMonetarySummation;
use Easybill\ZUGFeRD211\Model\TradeTax;
use Easybill\ZUGFeRD211\Validator;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    public function testBuildMinimal(): void
    {
        $invoice = new CrossIndustryInvoice();
        $invoice->exchangedDocumentContext = new ExchangedDocumentContext();
        $invoice->exchangedDocumentContext->documentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->documentContextParameter->id = 'urn:cen.eu:en16931:2017';

        $invoice->exchangedDocument = new ExchangedDocument();
        $invoice->exchangedDocument->id = '13908457';
        $invoice->exchangedDocument->issueDateTime = DateTime::create(102, '20201001');
        $invoice->exchangedDocument->typeCode = '308';

        $invoice->supplyChainTradeTransaction = new SupplyChainTradeTransaction();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement = new HeaderTradeAgreement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerTradeParty = $buyerTradeParty = new TradeParty();
        $buyerTradeParty->id = Id::create('1034567');
        $buyerTradeParty->name = 'Max Mustermann';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerTradeParty = new TradeParty();
        $sellerTradeParty->id = Id::create('1034567');
        $sellerTradeParty->name = 'Hans Zimmermann';

        $invoice->supplyChainTradeTransaction->lineItems[] = $item1 = new SupplyChainTradeLineItem();
        $item1->associatedDocumentLineDocument = new DocumentLineDocument();
        $item1->associatedDocumentLineDocument->lineId = '1';

        $item1->specifiedTradeProduct = new TradeProduct();
        $item1->specifiedTradeProduct->name = 'Klavier';

        $item1->tradeAgreement = new LineTradeAgreement();
        $item1->tradeAgreement->netPrice = new TradePrice();
        $item1->tradeAgreement->netPrice->chargeAmount = Amount::create('1500.00', 'EUR');

        $item1->specifiedLineTradeSettlement = new LineTradeSettlement();
        $item1->specifiedLineTradeSettlement->tradeTax[] = $item1tax = new TradeTax();
        $item1tax->typeCode = 'VAT';
        $item1tax->categoryCode = 'S';
        $item1tax->basisAmount = Amount::create('1500.00', 'EUR');
        $item1tax->calculatedAmount = Amount::create('285.00', 'EUR');
        $item1tax->rateApplicablePercent = '19.00';

        $item1->specifiedLineTradeSettlement->monetarySummation = new TradeSettlementLineMonetarySummation();
        $item1->specifiedLineTradeSettlement->monetarySummation->totalAmount = Amount::create('1785.00', 'EUR');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery = new HeaderTradeDelivery();

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement = new HeaderTradeSettlement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->currency = 'EUR';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->tradeTaxes[] = $headerTax = new TradeTax();
        $headerTax->typeCode = 'VAT';
        $headerTax->categoryCode = 'S';
        $headerTax->basisAmount = Amount::create('1500.00', 'EUR');
        $headerTax->calculatedAmount = Amount::create('285.00', 'EUR');
        $headerTax->rateApplicablePercent = '19.00';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = $summation = new TradeSettlementHeaderMonetarySummation();
        $summation->lineTotalAmount = Amount::create('1500.00', 'EUR');
        $summation->taxBasisTotalAmount[] = Amount::create('1500.00', 'EUR');
        $summation->taxTotalAmount[] = Amount::create('285.00', 'EUR');
        $summation->grandTotalAmount[] = Amount::create('1785.00', 'EUR');
        $summation->duePayableAmount = Amount::create('1785.00', 'EUR');

        $xml = Builder::create()->transform($invoice);
        file_put_contents(__DIR__.'/builder_test/reference1.xml', $xml);
        self::assertNotEmpty($xml);
        $result = (new Validator())->validateAgainstXsd($xml, __DIR__ . '/../../../src/zugferd211/Schema/EN16931/FACTUR-X_EN16931.xsd');
        self::assertNull($result, $result ?? '');
    }
}
