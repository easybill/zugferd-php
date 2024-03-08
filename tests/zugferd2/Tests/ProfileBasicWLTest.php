<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Tests;

use Easybill\ZUGFeRD2\Builder;
use Easybill\ZUGFeRD2\Model\Amount;
use Easybill\ZUGFeRD2\Model\CrossIndustryInvoice;
use Easybill\ZUGFeRD2\Model\DateTime;
use Easybill\ZUGFeRD2\Model\DocumentContextParameter;
use Easybill\ZUGFeRD2\Model\ExchangedDocument;
use Easybill\ZUGFeRD2\Model\ExchangedDocumentContext;
use Easybill\ZUGFeRD2\Model\HeaderTradeAgreement;
use Easybill\ZUGFeRD2\Model\HeaderTradeDelivery;
use Easybill\ZUGFeRD2\Model\HeaderTradeSettlement;
use Easybill\ZUGFeRD2\Model\Note;
use Easybill\ZUGFeRD2\Model\SupplyChainEvent;
use Easybill\ZUGFeRD2\Model\SupplyChainTradeTransaction;
use Easybill\ZUGFeRD2\Model\TaxRegistration;
use Easybill\ZUGFeRD2\Model\TradeAddress;
use Easybill\ZUGFeRD2\Model\TradeParty;
use Easybill\ZUGFeRD2\Model\TradePaymentTerms;
use Easybill\ZUGFeRD2\Model\TradeSettlementHeaderMonetarySummation;
use Easybill\ZUGFeRD2\Model\TradeTax;
use Easybill\ZUGFeRD2\Tests\Traits\AssertXmlOutputTrait;
use Easybill\ZUGFeRD2\Validator;
use PHPUnit\Framework\TestCase;

class ProfileBasicWLTest extends TestCase
{
    use AssertXmlOutputTrait;

    public function testBuildBASICWLEinfach(): void
    {
        $invoice = new CrossIndustryInvoice();
        $invoice->exchangedDocumentContext = new ExchangedDocumentContext();
        $invoice->exchangedDocumentContext->documentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->documentContextParameter->id = Builder::GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_BASIC_WL;

        $invoice->exchangedDocument = new ExchangedDocument();
        $invoice->exchangedDocument->id = 'TX-471102';
        $invoice->exchangedDocument->typeCode = '380';
        $invoice->exchangedDocument->issueDateTime = DateTime::create(102, '20191030');
        $invoice->exchangedDocument->notes[] = Note::create('Rechnung gemäß Taxifahrt vom 29.10.2019');
        $invoice->exchangedDocument->notes[] = Note::create('Taxiunternehmen TX GmbH
                Lieferantenstraße 20
                10369 Berlin
                Deutschland
                Geschäftsführer: Hans Mustermann
                Handelsregisternummer: H A 123
            ');
        $invoice->exchangedDocument->notes[] = Note::create('Unsere GLN: 4000001123452
                Ihre GLN: 4000001987658
                Ihre Kundennummer: GE2020211
            ');

        $invoice->supplyChainTradeTransaction = new SupplyChainTradeTransaction();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement = new HeaderTradeAgreement();

        // Seller Trade Party
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerTradeParty = new TradeParty();
        $sellerTradeParty->name = 'Taxiunternehmen TX GmbH';
        $sellerTradeParty->postalTradeAddress = new TradeAddress();
        $sellerTradeParty->postalTradeAddress->postcode = '10369';
        $sellerTradeParty->postalTradeAddress->lineOne = 'Lieferantenstraße 20';
        $sellerTradeParty->postalTradeAddress->city = 'Berlin';
        $sellerTradeParty->postalTradeAddress->countryCode = 'DE';
        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('DE123456789', 'VA');

        // Buyer Trade Party
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerTradeParty = $buyerTradeParty = new TradeParty();
        $buyerTradeParty->name = 'Taxi-Gast AG Mitte';
        $buyerTradeParty->postalTradeAddress = new TradeAddress();
        $buyerTradeParty->postalTradeAddress->postcode = '13351';
        $buyerTradeParty->postalTradeAddress->lineOne = 'Hans Mustermann';
        $buyerTradeParty->postalTradeAddress->lineTwo = 'Kundenstraße 15';
        $buyerTradeParty->postalTradeAddress->city = 'Berlin';
        $buyerTradeParty->postalTradeAddress->countryCode = 'DE';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery = new HeaderTradeDelivery();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->chainEvent = $chainEvent = new SupplyChainEvent();
        $chainEvent->date = DateTime::create(102, '20191029');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement = new HeaderTradeSettlement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->currency = 'EUR';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->tradeTaxes[] = $headerTax1 = new TradeTax();
        $headerTax1->typeCode = 'VAT';
        $headerTax1->categoryCode = 'S';
        $headerTax1->basisAmount = Amount::create('16.90');
        $headerTax1->calculatedAmount = Amount::create('1.18');
        $headerTax1->rateApplicablePercent = '7';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradePaymentTerms[] = $paymentTerms = new TradePaymentTerms();
        $paymentTerms->dueDate = DateTime::create(102, '20191129');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = $monetarySummation = new TradeSettlementHeaderMonetarySummation();
        $monetarySummation->lineTotalAmount = Amount::create('16.90');
        $monetarySummation->chargeTotalAmount = Amount::create('0.00');
        $monetarySummation->allowanceTotalAmount = Amount::create('0.00');
        $monetarySummation->taxBasisTotalAmount[] = Amount::create('16.90');
        $monetarySummation->taxTotalAmount[] = Amount::create('1.18', 'EUR');
        $monetarySummation->grandTotalAmount[] = Amount::create('18.08');
        $monetarySummation->duePayableAmount = Amount::create('18.08');

        $this->buildAndAssertXmlFromCII(
            $invoice,
            __DIR__ . '/Examples/BASIC WL/BASIC-WL_Einfach.xml',
            Validator::SCHEMA_BASIC_WL
        );
    }
}
