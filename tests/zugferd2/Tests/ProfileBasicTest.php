<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Tests;

use Easybill\ZUGFeRD2\Builder;
use Easybill\ZUGFeRD2\Model\Amount;
use Easybill\ZUGFeRD2\Model\CrossIndustryInvoice;
use Easybill\ZUGFeRD2\Model\DateTime;
use Easybill\ZUGFeRD2\Model\DocumentContextParameter;
use Easybill\ZUGFeRD2\Model\DocumentLineDocument;
use Easybill\ZUGFeRD2\Model\ExchangedDocument;
use Easybill\ZUGFeRD2\Model\ExchangedDocumentContext;
use Easybill\ZUGFeRD2\Model\HeaderTradeAgreement;
use Easybill\ZUGFeRD2\Model\HeaderTradeDelivery;
use Easybill\ZUGFeRD2\Model\HeaderTradeSettlement;
use Easybill\ZUGFeRD2\Model\Id;
use Easybill\ZUGFeRD2\Model\Indicator;
use Easybill\ZUGFeRD2\Model\LineTradeAgreement;
use Easybill\ZUGFeRD2\Model\LineTradeDelivery;
use Easybill\ZUGFeRD2\Model\LineTradeSettlement;
use Easybill\ZUGFeRD2\Model\Note;
use Easybill\ZUGFeRD2\Model\Quantity;
use Easybill\ZUGFeRD2\Model\SupplyChainEvent;
use Easybill\ZUGFeRD2\Model\SupplyChainTradeLineItem;
use Easybill\ZUGFeRD2\Model\SupplyChainTradeTransaction;
use Easybill\ZUGFeRD2\Model\TaxRegistration;
use Easybill\ZUGFeRD2\Model\TradeAddress;
use Easybill\ZUGFeRD2\Model\TradeAllowanceCharge;
use Easybill\ZUGFeRD2\Model\TradeParty;
use Easybill\ZUGFeRD2\Model\TradePaymentTerms;
use Easybill\ZUGFeRD2\Model\TradePrice;
use Easybill\ZUGFeRD2\Model\TradeProduct;
use Easybill\ZUGFeRD2\Model\TradeSettlementHeaderMonetarySummation;
use Easybill\ZUGFeRD2\Model\TradeSettlementLineMonetarySummation;
use Easybill\ZUGFeRD2\Model\TradeTax;
use Easybill\ZUGFeRD2\Tests\Traits\AssertXmlOutputTrait;
use Easybill\ZUGFeRD2\Validator;
use PHPUnit\Framework\TestCase;

class ProfileBasicTest extends TestCase
{
    use AssertXmlOutputTrait;

    public function testBuildBASICEinfach(): void
    {
        $invoice = new CrossIndustryInvoice();
        $invoice->exchangedDocumentContext = new ExchangedDocumentContext();
        $invoice->exchangedDocumentContext->documentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->documentContextParameter->id = Builder::GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_BASIC;

        $invoice->exchangedDocument = new ExchangedDocument();
        $invoice->exchangedDocument->id = '471102';
        $invoice->exchangedDocument->issueDateTime = DateTime::create(102, '20200305');
        $invoice->exchangedDocument->typeCode = '380';
        $invoice->exchangedDocument->notes[] = Note::create('Rechnung gemäß Bestellung vom 01.03.2020.');
        $invoice->exchangedDocument->notes[] = Note::create('Lieferant GmbH
                Lieferantenstraße 20
                80333 München
                Deutschland
                Geschäftsführer: Hans Muster
                Handelsregisternummer: H A 123
            ');
        $invoice->exchangedDocument->notes[] = Note::create('Unsere GLN: 4000001123452
                Ihre GLN: 4000001987658
                Ihre Kundennummer: GE2020211


                Zahlbar innerhalb 30 Tagen netto bis 04.04.2020, 3% Skonto innerhalb 10 Tagen bis 15.03.2020.
            ');

        $invoice->supplyChainTradeTransaction = new SupplyChainTradeTransaction();

        $item1 = new SupplyChainTradeLineItem();
        $item1->associatedDocumentLineDocument = DocumentLineDocument::create('1');
        $item1->specifiedTradeProduct = new TradeProduct();
        $item1->specifiedTradeProduct->globalID = Id::create('4012345001235', '0160');
        $item1->specifiedTradeProduct->name = 'GTIN: 4012345001235
                    Unsere Art.-Nr.: TB100A4
                    Trennblätter A4
                ';
        $item1->tradeAgreement = new LineTradeAgreement();
        $item1->tradeAgreement->netPrice = TradePrice::create('9.90');

        $item1->delivery = new LineTradeDelivery();
        $item1->delivery->billedQuantity = Quantity::create('20.0000', 'H87');

        $item1->specifiedLineTradeSettlement = new LineTradeSettlement();
        $item1->specifiedLineTradeSettlement->tradeTax[] = $item1tax = new TradeTax();
        $item1tax->typeCode = 'VAT';
        $item1tax->categoryCode = 'S';
        $item1tax->rateApplicablePercent = '19';
        $item1->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('198.00');

        $invoice->supplyChainTradeTransaction->lineItems[] = $item1;

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement = new HeaderTradeAgreement();

        // Buyer Trade Party
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerTradeParty = $buyerTradeParty = new TradeParty();
        $buyerTradeParty->name = 'Kunden AG Mitte';
        $buyerTradeParty->postalTradeAddress = new TradeAddress();
        $buyerTradeParty->postalTradeAddress->postcode = '69876';
        $buyerTradeParty->postalTradeAddress->lineOne = 'Hans Muster';
        $buyerTradeParty->postalTradeAddress->lineTwo = 'Kundenstraße 15';
        $buyerTradeParty->postalTradeAddress->city = 'Frankfurt';
        $buyerTradeParty->postalTradeAddress->countryCode = 'DE';

        // Seller Trade Party
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerTradeParty = new TradeParty();
        $sellerTradeParty->name = 'Lieferant GmbH';
        $sellerTradeParty->postalTradeAddress = new TradeAddress();
        $sellerTradeParty->postalTradeAddress->postcode = '80333';
        $sellerTradeParty->postalTradeAddress->lineOne = 'Lieferantenstraße 20';
        $sellerTradeParty->postalTradeAddress->city = 'München';
        $sellerTradeParty->postalTradeAddress->countryCode = 'DE';
        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('201/113/40209', 'FC');
        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('DE123456789', 'VA');

        // Header Trade Delivery
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery = new HeaderTradeDelivery();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->chainEvent = new SupplyChainEvent();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->chainEvent->date = DateTime::create(102, '20200305');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement = new HeaderTradeSettlement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->currency = 'EUR';

        // Tax
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->tradeTaxes[] = $headerTax1 = new TradeTax();
        $headerTax1->typeCode = 'VAT';
        $headerTax1->categoryCode = 'S';
        $headerTax1->basisAmount = Amount::create('198.00');
        $headerTax1->calculatedAmount = Amount::create('37.62');
        $headerTax1->rateApplicablePercent = '19.00';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradePaymentTerms[] = $paymentTerms = new TradePaymentTerms();
        $paymentTerms->dueDate = DateTime::create(102, '20200404');

        // Summary
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = $summation = new TradeSettlementHeaderMonetarySummation();
        $summation->lineTotalAmount = Amount::create('198.00');
        $summation->chargeTotalAmount = Amount::create('0.00');
        $summation->allowanceTotalAmount = Amount::create('0.00');
        $summation->taxBasisTotalAmount[] = Amount::create('198.00');
        $summation->taxTotalAmount[] = Amount::create('37.62', 'EUR');
        $summation->grandTotalAmount[] = Amount::create('235.62');
        $summation->duePayableAmount = Amount::create('235.62');

        $this->buildAndAssertXmlFromCII(
            $invoice,
            __DIR__ . '/Examples/BASIC/BASIC_Einfach.xml',
            Validator::SCHEMA_BASIC
        );
    }

    public function testBuildBASICRechnungskorrektur(): void
    {
        $invoice = new CrossIndustryInvoice();
        $invoice->exchangedDocumentContext = new ExchangedDocumentContext();
        $invoice->exchangedDocumentContext->documentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->documentContextParameter->id = Builder::GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_BASIC;

        $invoice->exchangedDocument = new ExchangedDocument();
        $invoice->exchangedDocument->id = 'RK21012345';
        $invoice->exchangedDocument->issueDateTime = DateTime::create(102, '20190916');
        $invoice->exchangedDocument->typeCode = '384';
        $invoice->exchangedDocument->notes[] = Note::create('Es bestehen Rabatt- oder Bonusvereinbarungen.');
        $invoice->exchangedDocument->notes[] = Note::create('MUSTERLIEFERANT GMBH
                BAHNHOFSTRASSE 99
                99199 MUSTERHAUSEN
                Geschäftsführung:
                Max Mustermann
                USt-IdNr: DE123456789
                Telefon: +49 932 431 0
                www.musterlieferant.de
                HRB Nr. 372876
                Amtsgericht Musterstadt
                GLN 4304171000002
            ');
        $invoice->exchangedDocument->notes[] = Note::create('Bei Rückfragen:
                Telefon: +49 932 431 500
                E-Mail : max.muster@musterlieferant.de
            ');
        $invoice->exchangedDocument->notes[] = Note::create('Warenempfänger
                GLN 430417088093
                MUSTER-MARKT

                HAUPTSTRASSE 44
                31157 SARSTEDT

                Abteilung : 8211
            ');
        $invoice->exchangedDocument->notes[] = Note::create('
                Bestell-Nr         : B123456789
                Bestell-Datum      : 01.08.2019

                Lieferschein-Nr    : L87654321012345
                Lieferschein-Datum : 05.08.2019
                Ursprungsbeleg-Nr  : R87654321012345
                Reklamationsnummer : REKLA-2018-235
            ');
        $invoice->exchangedDocument->notes[] = Note::create('Rechnungsempfänger
                GLN 4304171000002
                MUSTER-KUNDE GMBH

                KUNDENWEG 88
                40235 DUESSELDORF
                Kunden-Nr. : 009420
            ');

        $invoice->supplyChainTradeTransaction = new SupplyChainTradeTransaction();

        // Line Item 1
        $item1 = new SupplyChainTradeLineItem();
        $item1->associatedDocumentLineDocument = DocumentLineDocument::create('1');
        $item1->specifiedTradeProduct = new TradeProduct();
        $item1->specifiedTradeProduct->name = 'GTIN 4123456000014
                    Art-Nr-Lieferant ZS9997
                    Zitronensäure 100ml
                    Verpackung: Flasche
                    VKE/Geb: 1
                ';

        $item1->tradeAgreement = new LineTradeAgreement();
        $item1->tradeAgreement->netPrice = TradePrice::create('1.00');

        $item1->delivery = new LineTradeDelivery();
        $item1->delivery->billedQuantity = Quantity::create('-5.0000', 'H87');

        $item1->specifiedLineTradeSettlement = new LineTradeSettlement();

        $item1->specifiedLineTradeSettlement->tradeTax[] = $item1tax = new TradeTax();
        $item1tax->typeCode = 'VAT';
        $item1tax->categoryCode = 'S';
        $item1tax->rateApplicablePercent = '19.00';

        $item1->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('-5.00');

        $invoice->supplyChainTradeTransaction->lineItems[] = $item1;

        // Line Item 2
        $item2 = new SupplyChainTradeLineItem();
        $item2->associatedDocumentLineDocument = DocumentLineDocument::create('2');
        $item2->specifiedTradeProduct = new TradeProduct();
        $item2->specifiedTradeProduct->name = 'GTIN 4123456000021
                    Art-Nr-Lieferant GZ250
                    Gelierzucker Extra 250g
                    Verpackung: Karton
                    VKE/Geb: 1
                ';

        $item2->tradeAgreement = new LineTradeAgreement();
        $item2->tradeAgreement->netPrice = TradePrice::create('1.45');

        $item2->delivery = new LineTradeDelivery();
        $item2->delivery->billedQuantity = Quantity::create('-2.0000', 'C62');

        $item2->specifiedLineTradeSettlement = new LineTradeSettlement();

        $item2->specifiedLineTradeSettlement->tradeTax[] = $item2tax = new TradeTax();
        $item2tax->typeCode = 'VAT';
        $item2tax->categoryCode = 'S';
        $item2tax->rateApplicablePercent = '7.00';

        $item2->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('-2.90');

        $invoice->supplyChainTradeTransaction->lineItems[] = $item2;

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement = new HeaderTradeAgreement();

        // Seller Trade Party
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerTradeParty = new TradeParty();
        $sellerTradeParty->name = 'GLN 4333741000005
                    Lief-Nr: 549910
                    MUSTERLIEFERANT GMBH
                ';
        $sellerTradeParty->postalTradeAddress = new TradeAddress();
        $sellerTradeParty->postalTradeAddress->postcode = '99199';
        $sellerTradeParty->postalTradeAddress->lineOne = 'BAHNHOFSTRASSE 99';
        $sellerTradeParty->postalTradeAddress->city = 'MUSTERHAUSEN';
        $sellerTradeParty->postalTradeAddress->countryCode = 'DE';
        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('DE123456789', 'VA');

        // Buyer Trade Party
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerTradeParty = $buyerTradeParty = new TradeParty();
        $buyerTradeParty->name = 'GLN 4304171000002
                    Kunden-Nr. : 009420
                    MUSTER-KUNDE GMBH
                ';
        $buyerTradeParty->postalTradeAddress = new TradeAddress();
        $buyerTradeParty->postalTradeAddress->postcode = '40235';
        $buyerTradeParty->postalTradeAddress->lineOne = 'KUNDENWEG 88';
        $buyerTradeParty->postalTradeAddress->city = 'DUESSELDORF';
        $buyerTradeParty->postalTradeAddress->countryCode = 'DE';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery = new HeaderTradeDelivery();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->chainEvent = $chainEvent = new SupplyChainEvent();

        $chainEvent->date = DateTime::create(102, '20190805');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement = new HeaderTradeSettlement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->currency = 'EUR';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->tradeTaxes[] = $headerTax1 = new TradeTax();

        $headerTax1->typeCode = 'VAT';
        $headerTax1->categoryCode = 'S';
        $headerTax1->basisAmount = Amount::create('-4.85');
        $headerTax1->calculatedAmount = Amount::create('-0.92');
        $headerTax1->rateApplicablePercent = '19.00';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->tradeTaxes[] = $headerTax2 = new TradeTax();

        $headerTax2->typeCode = 'VAT';
        $headerTax2->categoryCode = 'S';
        $headerTax2->basisAmount = Amount::create('-2.82');
        $headerTax2->calculatedAmount = Amount::create('-0.20');
        $headerTax2->rateApplicablePercent = '7.00';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeAllowanceCharge[] = $allowanceCharge1 = new TradeAllowanceCharge();
        $allowanceCharge1->actualAmount = Amount::create('-0.15');
        $allowanceCharge1->reason = 'Rechnungsrabatt';
        $allowanceCharge1->indicator = new Indicator();
        $allowanceCharge1->indicator->indicator = false;
        $allowanceCharge1->tradeTax = [
            TradeTax::create(
                typeCode: 'VAT',
                categoryCode: 'S',
                rateApplicablePercent: '19',
            ),
        ];

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeAllowanceCharge[] = $allowanceCharge2 = new TradeAllowanceCharge();
        $allowanceCharge2->actualAmount = Amount::create('-0.08');
        $allowanceCharge2->reason = 'Rechnungsrabatt';
        $allowanceCharge2->indicator = new Indicator();
        $allowanceCharge2->indicator->indicator = false;
        $allowanceCharge2->tradeTax = [
            TradeTax::create(
                typeCode: 'VAT',
                categoryCode: 'S',
                rateApplicablePercent: '7',
            ),
        ];

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = $monetarySummation = new TradeSettlementHeaderMonetarySummation();
        $monetarySummation->lineTotalAmount = Amount::create('-7.90');
        $monetarySummation->chargeTotalAmount = Amount::create('0.00');
        $monetarySummation->allowanceTotalAmount = Amount::create('-0.23');
        $monetarySummation->taxBasisTotalAmount[] = Amount::create('-7.67');
        $monetarySummation->taxTotalAmount[] = Amount::create('-1.12', 'EUR');
        $monetarySummation->grandTotalAmount[] = Amount::create('-8.79');
        $monetarySummation->duePayableAmount = Amount::create('-8.79');

        $this->buildAndAssertXmlFromCII(
            $invoice,
            __DIR__ . '/Examples/BASIC/BASIC_Rechnungskorrektur.xml',
            Validator::SCHEMA_BASIC
        );
    }

    public function testBuildBASICTaxifahrt(): void
    {
        $invoice = new CrossIndustryInvoice();
        $invoice->exchangedDocumentContext = new ExchangedDocumentContext();
        $invoice->exchangedDocumentContext->documentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->documentContextParameter->id = Builder::GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_BASIC;

        $invoice->exchangedDocument = new ExchangedDocument();
        $invoice->exchangedDocument->id = 'TX-471102';
        $invoice->exchangedDocument->issueDateTime = DateTime::create(102, '20191030');
        $invoice->exchangedDocument->typeCode = '380';
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

        $item1 = new SupplyChainTradeLineItem();
        $item1->associatedDocumentLineDocument = DocumentLineDocument::create('1');
        $item1->specifiedTradeProduct = new TradeProduct();
        $item1->specifiedTradeProduct->name = 'Grundpreis (Pauschale)';
        $item1->tradeAgreement = new LineTradeAgreement();
        $item1->tradeAgreement->netPrice = TradePrice::create('3.90');

        $item1->delivery = new LineTradeDelivery();
        $item1->delivery->billedQuantity = Quantity::create('1', 'C62');

        $item1->specifiedLineTradeSettlement = new LineTradeSettlement();
        $item1->specifiedLineTradeSettlement->tradeTax[] = $item1tax = new TradeTax();
        $item1tax->typeCode = 'VAT';
        $item1tax->categoryCode = 'S';
        $item1tax->rateApplicablePercent = '7';
        $item1->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('3.90');
        $item1->specifiedLineTradeSettlement->monetarySummation->lineTotalAmount = Amount::create('3.90');

        $invoice->supplyChainTradeTransaction->lineItems[] = $item1;

        $item2 = new SupplyChainTradeLineItem();
        $item2->associatedDocumentLineDocument = DocumentLineDocument::create('2');
        $item2->specifiedTradeProduct = new TradeProduct();
        $item2->specifiedTradeProduct->name = 'Stadtfahrt - 2,00 Euro je gefahrene Kilometer';
        $item2->tradeAgreement = new LineTradeAgreement();
        $item2->tradeAgreement->netPrice = TradePrice::create('2.00');

        $item2->delivery = new LineTradeDelivery();
        $item2->delivery->billedQuantity = Quantity::create('6.50', 'KMT');

        $item2->specifiedLineTradeSettlement = new LineTradeSettlement();
        $item2->specifiedLineTradeSettlement->tradeTax[] = $item2tax = new TradeTax();
        $item2tax->typeCode = 'VAT';
        $item2tax->categoryCode = 'S';
        $item2tax->rateApplicablePercent = '7';
        $item2->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('3.90');
        $item2->specifiedLineTradeSettlement->monetarySummation->lineTotalAmount = Amount::create('13');

        $invoice->supplyChainTradeTransaction->lineItems[] = $item2;

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
            __DIR__ . '/Examples/BASIC/BASIC_Taxifahrt.xml',
            Validator::SCHEMA_BASIC
        );
    }
}
