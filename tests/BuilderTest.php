<?php

namespace Easybill\ZUGFeRD\Tests;

use Easybill\ZUGFeRD\Model\LegalOrganization;
use Easybill\ZUGFeRD\Model\LogisticsServiceCharge;
use PHPUnit\Framework\TestCase;
use Easybill\ZUGFeRD\Builder;
use Easybill\ZUGFeRD\Model\Amount;
use Easybill\ZUGFeRD\Model\CreditorFinancialAccount;
use Easybill\ZUGFeRD\Model\CreditorFinancialInstitution;
use Easybill\ZUGFeRD\Model\CrossIndustryInvoice;
use Easybill\ZUGFeRD\Model\DateTime;
use Easybill\ZUGFeRD\Model\DocumentContextParameter;
use Easybill\ZUGFeRD\Model\DocumentLineDocument;
use Easybill\ZUGFeRD\Model\ExchangedDocument;
use Easybill\ZUGFeRD\Model\ExchangedDocumentContext;
use Easybill\ZUGFeRD\Model\FormattedDateTime;
use Easybill\ZUGFeRD\Model\HeaderTradeAgreement;
use Easybill\ZUGFeRD\Model\HeaderTradeDelivery;
use Easybill\ZUGFeRD\Model\HeaderTradeSettlement;
use Easybill\ZUGFeRD\Model\Id;
use Easybill\ZUGFeRD\Model\Indicator;
use Easybill\ZUGFeRD\Model\LineTradeAgreement;
use Easybill\ZUGFeRD\Model\LineTradeDelivery;
use Easybill\ZUGFeRD\Model\LineTradeSettlement;
use Easybill\ZUGFeRD\Model\Note;
use Easybill\ZUGFeRD\Model\ProcuringProject;
use Easybill\ZUGFeRD\Model\Quantity;
use Easybill\ZUGFeRD\Model\ReferencedDocument;
use Easybill\ZUGFeRD\Model\SupplyChainEvent;
use Easybill\ZUGFeRD\Model\SupplyChainTradeLineItem;
use Easybill\ZUGFeRD\Model\SupplyChainTradeTransaction;
use Easybill\ZUGFeRD\Model\TaxRegistration;
use Easybill\ZUGFeRD\Model\TradeAddress;
use Easybill\ZUGFeRD\Model\TradeAllowanceCharge;
use Easybill\ZUGFeRD\Model\TradeContact;
use Easybill\ZUGFeRD\Model\TradeCountry;
use Easybill\ZUGFeRD\Model\TradeParty;
use Easybill\ZUGFeRD\Model\TradePaymentTerms;
use Easybill\ZUGFeRD\Model\TradePrice;
use Easybill\ZUGFeRD\Model\TradeProduct;
use Easybill\ZUGFeRD\Model\TradeSettlementHeaderMonetarySummation;
use Easybill\ZUGFeRD\Model\TradeSettlementLineMonetarySummation;
use Easybill\ZUGFeRD\Model\TradeSettlementPaymentMeans;
use Easybill\ZUGFeRD\Model\TradeTax;
use Easybill\ZUGFeRD\Model\UniversalCommunication;
use Easybill\ZUGFeRD\Validator;

class BuilderTest extends TestCase
{
    public function testBuildXRechnungExample(): void
    {
        $invoice = new CrossIndustryInvoice();
        $invoice->exchangedDocumentContext = new ExchangedDocumentContext();
        $invoice->exchangedDocumentContext->documentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->documentContextParameter->id = 'urn:cen.eu:en16931:2017#compliant#urn:xoev-de:kosit:standard:xrechnung_1.2';

        $invoice->exchangedDocument = new ExchangedDocument();
        $invoice->exchangedDocument->id = '471102';
        $invoice->exchangedDocument->issueDateTime = DateTime::create(102, '20180305');
        $invoice->exchangedDocument->typeCode = '380';
        $invoice->exchangedDocument->notes[] = Note::create('Rechnung gemäß Bestellung vom 01.03.2018.');
        $invoice->exchangedDocument->notes[] = Note::create('Lieferant GmbH				
Lieferantenstraße 20				
80333 München				
Deutschland				
Geschäftsführer: Hans Muster
Handelsregisternummer: H A 123
      ', 'REG');

        $invoice->supplyChainTradeTransaction = new SupplyChainTradeTransaction();
        $invoice->supplyChainTradeTransaction->lineItems[] = $item1 = new SupplyChainTradeLineItem();
        $item1->associatedDocumentLineDocument = DocumentLineDocument::create('1');

        $item1->specifiedTradeProduct = new TradeProduct();
        $item1->specifiedTradeProduct->name = 'Trennblätter A4';
        $item1->specifiedTradeProduct->sellerAssignedID = 'TB100A4';
        $item1->specifiedTradeProduct->globalID = Id::create('4012345001235', '0160');

        $item1->tradeAgreement = new LineTradeAgreement();
        $item1->tradeAgreement->netPrice = TradePrice::create('9.9000');
        $item1->tradeAgreement->grossPrice = TradePrice::create('9.9000');

        $item1->delivery = new LineTradeDelivery();
        $item1->delivery->billedQuantity = Quantity::create('20.0000', 'H87');

        $item1->specifiedLineTradeSettlement = new LineTradeSettlement();
        $item1->specifiedLineTradeSettlement->tradeTax[] = $item1tax = new TradeTax();
        $item1tax->typeCode = 'VAT';
        $item1tax->categoryCode = 'S';
        $item1tax->rateApplicablePercent = '19.00';

        $item1->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('198.00');

        $invoice->supplyChainTradeTransaction->lineItems[] = $item2 = new SupplyChainTradeLineItem();
        $item2->associatedDocumentLineDocument = DocumentLineDocument::create('2');

        $item2->specifiedTradeProduct = new TradeProduct();
        $item2->specifiedTradeProduct->name = 'Joghurt Banane';
        $item2->specifiedTradeProduct->sellerAssignedID = 'ARNR2';
        $item2->specifiedTradeProduct->globalID = Id::create('4000050986428', '0160');

        $item2->tradeAgreement = new LineTradeAgreement();
        $item2->tradeAgreement->netPrice = TradePrice::create('5.5000');
        $item2->tradeAgreement->grossPrice = TradePrice::create('5.5000');

        $item2->delivery = new LineTradeDelivery();
        $item2->delivery->billedQuantity = Quantity::create('50.0000', 'H87');

        $item2->specifiedLineTradeSettlement = new LineTradeSettlement();
        $item2->specifiedLineTradeSettlement->tradeTax[] = $item2tax = new TradeTax();
        $item2tax->typeCode = 'VAT';
        $item2tax->categoryCode = 'S';
        $item2tax->rateApplicablePercent = '7.00';

        $item2->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('275.00');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement = new HeaderTradeAgreement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerReference = '04011000-12345-34';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerTradeParty = $buyerTradeParty = new TradeParty();
        $buyerTradeParty->id = Id::create('1034567');
        $buyerTradeParty->name = 'Max Mustermann';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerTradeParty = new TradeParty();
        $sellerTradeParty->globalID[] = Id::create('4000001123452', '0088');
        $sellerTradeParty->name = 'Lieferant GmbH';
        $sellerTradeParty->definedTradeContact = new TradeContact();
        $sellerTradeParty->definedTradeContact->personName = 'Max Mustermann';
        $sellerTradeParty->definedTradeContact->departmentName = 'Muster-Einkauf';
        $sellerTradeParty->definedTradeContact->telephoneUniversalCommunication = new UniversalCommunication();
        $sellerTradeParty->definedTradeContact->telephoneUniversalCommunication->completeNumber = '+49891234567';
        $sellerTradeParty->definedTradeContact->emailURIUniversalCommunication = new UniversalCommunication();
        $sellerTradeParty->definedTradeContact->emailURIUniversalCommunication->uriid = Id::create('Max@Mustermann.de');

        $sellerTradeParty->postalTradeAddress = new TradeAddress();
        $sellerTradeParty->postalTradeAddress->postcode = '80333';
        $sellerTradeParty->postalTradeAddress->lineOne = 'Lieferantenstraße 20';
        $sellerTradeParty->postalTradeAddress->city = 'München';
        $sellerTradeParty->postalTradeAddress->countryCode = 'DE';

        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('201/113/40209', 'FC');
        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('DE123456789', 'VA');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerTradeParty = $buyerTradeParty = new TradeParty();
        $buyerTradeParty->id = Id::create('GE2020211');
        $buyerTradeParty->name = 'Kunden AG Mitte';

        $buyerTradeParty->postalTradeAddress = new TradeAddress();
        $buyerTradeParty->postalTradeAddress->postcode = '69876';
        $buyerTradeParty->postalTradeAddress->lineOne = 'Kundenstraße 15';
        $buyerTradeParty->postalTradeAddress->city = 'Frankfurt';
        $buyerTradeParty->postalTradeAddress->countryCode = 'DE';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery = new HeaderTradeDelivery();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->chainEvent = new SupplyChainEvent();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->chainEvent->date = DateTime::create(102, '20180305');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement = new HeaderTradeSettlement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->currency = 'EUR';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementPaymentMeans[] = $paymentMeans1 = new TradeSettlementPaymentMeans();
        $paymentMeans1->typeCode = '58';
        $paymentMeans1->information = 'Zahlung per SEPA Überweisung.';
        $paymentMeans1->payeePartyCreditorFinancialAccount = new CreditorFinancialAccount();
        $paymentMeans1->payeePartyCreditorFinancialAccount->ibanId = Id::create('DE02120300000000202051');
        $paymentMeans1->payeePartyCreditorFinancialAccount->AccountName = 'Kunden AG';
        $paymentMeans1->payeeSpecifiedCreditorFinancialInstitution = new CreditorFinancialInstitution();
        $paymentMeans1->payeeSpecifiedCreditorFinancialInstitution->bicId = Id::create('BYLADEM1001');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->tradeTaxes[] = $headerTax1 = new TradeTax();
        $headerTax1->typeCode = 'VAT';
        $headerTax1->categoryCode = 'S';
        $headerTax1->basisAmount = Amount::create('275.00');
        $headerTax1->calculatedAmount = Amount::create('19.25');
        $headerTax1->rateApplicablePercent = '7.00';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->tradeTaxes[] = $headerTax2 = new TradeTax();
        $headerTax2->typeCode = 'VAT';
        $headerTax2->categoryCode = 'S';
        $headerTax2->basisAmount = Amount::create('198.00');
        $headerTax2->calculatedAmount = Amount::create('37.62');
        $headerTax2->rateApplicablePercent = '19.00';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradePaymentTerms[] = $paymentTerms = new TradePaymentTerms();
        $paymentTerms->description = 'Zahlbar innerhalb 30 Tagen netto bis 04.04.2018, 3% Skonto innerhalb 10 Tagen bis 15.03.2018';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = $summation = new TradeSettlementHeaderMonetarySummation();
        $summation->lineTotalAmount = Amount::create('473.00');
        $summation->chargeTotalAmount = Amount::create('0.00');
        $summation->allowanceTotalAmount = Amount::create('0.00');
        $summation->taxBasisTotalAmount[] = Amount::create('473.00');
        $summation->taxTotalAmount[] = Amount::create('56.87', 'EUR');
        $summation->grandTotalAmount[] = Amount::create('529.87');
        $summation->totalPrepaidAmount = Amount::create('0.00');
        $summation->duePayableAmount = Amount::create('529.87');

        $xml = Builder::create()->transform($invoice);
        self::assertNotEmpty($xml);
        $referenceFile = file_get_contents(__DIR__ . '/data/official_example_xml/zugferd_2p1_XRECHNUNG_Einfach.xml');
        $referenceFile = ReaderAndBuildTest::reformatXml($referenceFile);
        $xml = ReaderAndBuildTest::reformatXml($xml);
        self::assertEquals($referenceFile, $xml);

        $result = (new Validator())->validateAgainstXsd($xml, Validator::SCHEMA_EN16931);
        self::assertNull($result, $result ?? '');
    }

    public function testBuildXRechnungExtendedExample(): void
    {
        $invoice = new CrossIndustryInvoice();
        $invoice->exchangedDocumentContext = new ExchangedDocumentContext();
        $invoice->exchangedDocumentContext->documentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->documentContextParameter->id = 'urn:cen.eu:en16931:2017#conformant#urn:zugferd.de:2p1:extended';

        $invoice->exchangedDocument = new ExchangedDocument();
        $invoice->exchangedDocument->id = '471102';
        $invoice->exchangedDocument->name = 'Rechnung';
        $invoice->exchangedDocument->issueDateTime = DateTime::create(102, '20180305');
        $invoice->exchangedDocument->typeCode = '380';
        $invoice->exchangedDocument->languageId[] = 'de';
        $invoice->exchangedDocument->notes[] = Note::create('Rechnung gemäß Bestellung vom 01.03.2018.');
        $invoice->exchangedDocument->notes[] = Note::create('Lieferant GmbH				
Lieferantenstraße 20				
80333 München				
Deutschland				
Geschäftsführer: Hans Muster
Handelsregisternummer: H A 123
      ', 'REG');

        $invoice->supplyChainTradeTransaction = new SupplyChainTradeTransaction();
        $invoice->supplyChainTradeTransaction->lineItems[] = $item1 = new SupplyChainTradeLineItem();
        $item1->associatedDocumentLineDocument = DocumentLineDocument::create('1');
        $item1->associatedDocumentLineDocument->notes[] = Note::create('Neutrale Umverpackung', 'AAI', 'Umverpackung');

        $item1->specifiedTradeProduct = new TradeProduct();
        $item1->specifiedTradeProduct->name = 'Trennblätter A4';
        $item1->specifiedTradeProduct->sellerAssignedID = 'TB100A4';
        $item1->specifiedTradeProduct->globalID = Id::create('4012345001235', '0160');
        $item1->specifiedTradeProduct->tradeCountry = TradeCountry::create('DE');

        $item1->tradeAgreement = new LineTradeAgreement();
        $item1->tradeAgreement->netPrice = TradePrice::create('9.9000', Quantity::create('1', 'C62'));
        $item1->tradeAgreement->grossPrice = TradePrice::create('9.9000');

        $item1->delivery = new LineTradeDelivery();
        $item1->delivery->billedQuantity = Quantity::create('20.0000', 'H87');
        $item1->delivery->chainEvent = new SupplyChainEvent();
        $item1->delivery->chainEvent->date = DateTime::create(102, '20180305');

        $item1->specifiedLineTradeSettlement = new LineTradeSettlement();
        $item1->specifiedLineTradeSettlement->tradeTax[] = $item1tax = new TradeTax();
        $item1tax->typeCode = 'VAT';
        $item1tax->categoryCode = 'S';
        $item1tax->rateApplicablePercent = '19.00';

        $item1->specifiedLineTradeSettlement->specifiedTradeAllowanceCharge[] = $allowanceCharge = new TradeAllowanceCharge();
        $allowanceCharge->indicator = new Indicator();
        $allowanceCharge->indicator->indicator = false;
        $allowanceCharge->basisAmount = Amount::create('198.00');
        $allowanceCharge->actualAmount = Amount::create('8.00');
        $allowanceCharge->reason = 'Artikelrabatt';

        $item1->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('190.00', '8.00');

        $invoice->supplyChainTradeTransaction->lineItems[] = $item2 = new SupplyChainTradeLineItem();
        $item2->associatedDocumentLineDocument = DocumentLineDocument::create('2');

        $item2->specifiedTradeProduct = new TradeProduct();
        $item2->specifiedTradeProduct->name = 'Joghurt Banane';
        $item2->specifiedTradeProduct->sellerAssignedID = 'ARNR2';
        $item2->specifiedTradeProduct->globalID = Id::create('4000050986428', '0160');

        $item2->tradeAgreement = new LineTradeAgreement();
        $item2->tradeAgreement->netPrice = TradePrice::create('5.5000');
        $item2->tradeAgreement->grossPrice = TradePrice::create('5.5000');

        $item2->delivery = new LineTradeDelivery();
        $item2->delivery->billedQuantity = Quantity::create('50.0000', 'H87');

        $item2->specifiedLineTradeSettlement = new LineTradeSettlement();
        $item2->specifiedLineTradeSettlement->tradeTax[] = $item2tax = new TradeTax();
        $item2tax->typeCode = 'VAT';
        $item2tax->categoryCode = 'S';
        $item2tax->rateApplicablePercent = '7.00';

        $item2->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('275.00');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement = new HeaderTradeAgreement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerReference = '04011000-12345-34';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerTradeParty = $buyerTradeParty = new TradeParty();
        $buyerTradeParty->id = Id::create('1034567');
        $buyerTradeParty->name = 'Max Mustermann';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerTradeParty = new TradeParty();
        $sellerTradeParty->globalID[] = Id::create('4000001123452', '0088');
        $sellerTradeParty->name = 'Lieferant GmbH';
        $sellerTradeParty->definedTradeContact = new TradeContact();
        $sellerTradeParty->definedTradeContact->personName = 'Max Mustermann';
        $sellerTradeParty->definedTradeContact->departmentName = 'Muster-Einkauf';
        $sellerTradeParty->definedTradeContact->telephoneUniversalCommunication = new UniversalCommunication();
        $sellerTradeParty->definedTradeContact->telephoneUniversalCommunication->completeNumber = '+49891234567';
        $sellerTradeParty->definedTradeContact->emailURIUniversalCommunication = new UniversalCommunication();
        $sellerTradeParty->definedTradeContact->emailURIUniversalCommunication->uriid = Id::create('Max@Mustermann.de');

        $sellerTradeParty->postalTradeAddress = new TradeAddress();
        $sellerTradeParty->postalTradeAddress->postcode = '80333';
        $sellerTradeParty->postalTradeAddress->lineOne = 'Lieferantenstraße 20';
        $sellerTradeParty->postalTradeAddress->city = 'München';
        $sellerTradeParty->postalTradeAddress->countryCode = 'DE';

        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('201/113/40209', 'FC');
        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('DE123456789', 'VA');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerTradeParty = $buyerTradeParty = new TradeParty();
        $buyerTradeParty->id = Id::create('GE2020211');
        $buyerTradeParty->name = 'Kunden AG Mitte';

        $buyerTradeParty->postalTradeAddress = new TradeAddress();
        $buyerTradeParty->postalTradeAddress->postcode = '69876';
        $buyerTradeParty->postalTradeAddress->lineOne = 'Kundenstraße 15';
        $buyerTradeParty->postalTradeAddress->city = 'Frankfurt';
        $buyerTradeParty->postalTradeAddress->countryCode = 'DE';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->specifiedProcuringProject = ProcuringProject::create('1234', 'Projekt');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery = new HeaderTradeDelivery();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->shipToTradeParty = $buyerTradeParty;
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->chainEvent = new SupplyChainEvent();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->chainEvent->date = DateTime::create(102, '20180305');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->deliveryNoteReferencedDocument = ReferencedDocument::create('123456');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->deliveryNoteReferencedDocument->formattedIssueDateTime = FormattedDateTime::create(102, '20180305');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement = new HeaderTradeSettlement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->creditorReferenceID = 'TEST1234';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->paymentReference = '421102';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->currency = 'EUR';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->payeeTradeParty = $sellerTradeParty;
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedLogisticsServiceCharge[] = $logisticsServiceCharge = new LogisticsServiceCharge();

        $logisticsServiceCharge->description = 'Versandkosten';
        $logisticsServiceCharge->appliedAmount = Amount::create('0');
        $logisticsServiceCharge->tradeTaxes[] = $shippingTax = new TradeTax();

        $shippingTax->typeCode = 'VAT';
        $shippingTax->categoryCode = 'S';
        $shippingTax->rateApplicablePercent = '19.00';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementPaymentMeans[] = $paymentMeans1 = new TradeSettlementPaymentMeans();

        $paymentMeans1->typeCode = '58';
        $paymentMeans1->information = 'Zahlung per SEPA Überweisung.';
        $paymentMeans1->payeePartyCreditorFinancialAccount = new CreditorFinancialAccount();
        $paymentMeans1->payeePartyCreditorFinancialAccount->ibanId = Id::create('DE02120300000000202051');
        $paymentMeans1->payeePartyCreditorFinancialAccount->AccountName = 'Kunden AG';
        $paymentMeans1->payeeSpecifiedCreditorFinancialInstitution = new CreditorFinancialInstitution();
        $paymentMeans1->payeeSpecifiedCreditorFinancialInstitution->bicId = Id::create('BYLADEM1001');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->tradeTaxes[] = $headerTax1 = new TradeTax();
        $headerTax1->typeCode = 'VAT';
        $headerTax1->categoryCode = 'S';
        $headerTax1->basisAmount = Amount::create('275.00');
        $headerTax1->calculatedAmount = Amount::create('19.25');
        $headerTax1->rateApplicablePercent = '7.00';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->tradeTaxes[] = $headerTax2 = new TradeTax();
        $headerTax2->typeCode = 'VAT';
        $headerTax2->categoryCode = 'S';
        $headerTax2->basisAmount = Amount::create('190.00');
        $headerTax2->calculatedAmount = Amount::create('36.10');
        $headerTax2->rateApplicablePercent = '19.00';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradePaymentTerms[] = $paymentTerms = new TradePaymentTerms();
        $paymentTerms->directDebitMandateID = 'Mandate Reference';
        $paymentTerms->description = 'Zahlbar innerhalb 30 Tagen netto bis 04.04.2018, 3% Skonto innerhalb 10 Tagen bis 15.03.2018';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = $summation = new TradeSettlementHeaderMonetarySummation();
        $summation->lineTotalAmount = Amount::create('465.00');
        $summation->chargeTotalAmount = Amount::create('0.00');
        $summation->allowanceTotalAmount = Amount::create('0.00');
        $summation->taxBasisTotalAmount[] = Amount::create('465.00');
        $summation->taxTotalAmount[] = Amount::create('55.35', 'EUR');
        $summation->grandTotalAmount[] = Amount::create('520.35');
        $summation->totalPrepaidAmount = Amount::create('0.00');
        $summation->duePayableAmount = Amount::create('520.35');

        $xml = Builder::create()->transform($invoice);
        self::assertNotEmpty($xml);
        $referenceFile = file_get_contents(__DIR__ . '/data/zugferd_2p1_XRECHNUNG_Extended.xml');
        $referenceFile = ReaderAndBuildTest::reformatXml($referenceFile);
        $xml = ReaderAndBuildTest::reformatXml($xml);
        self::assertEquals($referenceFile, $xml);

        $result = (new Validator())->validateAgainstXsd($xml, Validator::SCHEMA_EXTENDED);
        self::assertNull($result, $result ?? '');
    }

    public function testFacturXExtendedExample(): void
    {
        $invoice = new CrossIndustryInvoice();

        // <rsm:ExchangedDocumentContext>
        $invoice->exchangedDocumentContext = new ExchangedDocumentContext();
        $invoice->exchangedDocumentContext->documentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->documentContextParameter->id = 'urn:cen.eu:en16931:2017#conformant#urn:factur-x.eu:1p0:extended';
        // </rsm:ExchangedDocumentContext>

        // <rsm:ExchangedDocument>
        $invoice->exchangedDocument = new ExchangedDocument();
        $invoice->exchangedDocument->id = 'FA-2017-0010';
        $invoice->exchangedDocument->typeCode = '380';
        $invoice->exchangedDocument->issueDateTime = DateTime::create(102, '20171113');
        $invoice->exchangedDocument->notes[] = Note::create('Franco de port (commande > 300 € HT)');
        // </rsm:ExchangedDocument>

        // <rsm:SupplyChainTradeTransaction>
        $invoice->supplyChainTradeTransaction = new SupplyChainTradeTransaction();

        // <ram:IncludedSupplyChainTradeLineItem>
        $invoice->supplyChainTradeTransaction->lineItems[] = $lineItem1 = new SupplyChainTradeLineItem();

        $lineItem1->associatedDocumentLineDocument = DocumentLineDocument::create('1');

        // <ram:SpecifiedTradeProduct>
        $lineItem1->specifiedTradeProduct = new TradeProduct();
        $lineItem1->specifiedTradeProduct->globalID = Id::create('3518370400049', '0160');
        $lineItem1->specifiedTradeProduct->sellerAssignedID = 'NOUG250';
        $lineItem1->specifiedTradeProduct->name = 'Nougat de l\'Abbaye 250g';
        // </ram:SpecifiedTradeProduct>

        // <ram:SpecifiedLineTradeAgreement>
        $lineItem1->tradeAgreement = new LineTradeAgreement();
        $lineItem1->tradeAgreement->grossPrice = TradePrice::create('4.55');
        $lineItem1->tradeAgreement->grossPrice->appliedTradeAllowanceCharge = $tradeAllowanceCharge = new TradeAllowanceCharge();
        $tradeAllowanceCharge->indicator = $indicator = new Indicator();
        $indicator->indicator = false;
        $tradeAllowanceCharge->actualAmount = Amount::create('0.45');
        $lineItem1->tradeAgreement->netPrice = TradePrice::create('4.10');
        // </ram:SpecifiedLineTradeAgreement>

        // <ram:SpecifiedLineTradeDelivery>
        $lineItem1->delivery = new LineTradeDelivery();
        $lineItem1->delivery->billedQuantity = Quantity::create('20.000', 'C62');
        // </ram:SpecifiedLineTradeDelivery>

        // <ram:SpecifiedLineTradeSettlement>
        $lineItem1->specifiedLineTradeSettlement = new LineTradeSettlement();
        $lineItem1->specifiedLineTradeSettlement->tradeTax[] = $itemTradeTax = new TradeTax();
        $itemTradeTax->typeCode = 'VAT';
        $itemTradeTax->categoryCode = 'S';
        $itemTradeTax->rateApplicablePercent = '20.00';

        $lineItem1->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('81.90');
        // </ram:IncludedSupplyChainTradeLineItem>

        // <ram:IncludedSupplyChainTradeLineItem>
        $invoice->supplyChainTradeTransaction->lineItems[] = $lineItem2 = new SupplyChainTradeLineItem();

        $lineItem2->associatedDocumentLineDocument = DocumentLineDocument::create('2');

        // <ram:SpecifiedTradeProduct>
        $lineItem2->specifiedTradeProduct = new TradeProduct();
        $lineItem2->specifiedTradeProduct->globalID = Id::create('3518370200090', '0160');
        $lineItem2->specifiedTradeProduct->sellerAssignedID = 'BRAIS300';
        $lineItem2->specifiedTradeProduct->name = 'Biscuits aux raisins 300g';
        // </ram:SpecifiedTradeProduct>

        // <ram:SpecifiedLineTradeAgreement>
        $lineItem2->tradeAgreement = new LineTradeAgreement();
        $lineItem2->tradeAgreement->grossPrice = TradePrice::create('3.20');
        $lineItem2->tradeAgreement->netPrice = TradePrice::create('3.20');
        // </ram:SpecifiedLineTradeAgreement>

        // <ram:SpecifiedLineTradeDelivery>
        $lineItem2->delivery = new LineTradeDelivery();
        $lineItem2->delivery->billedQuantity = Quantity::create('15.000', 'C62');
        // </ram:SpecifiedLineTradeDelivery>

        // <ram:SpecifiedLineTradeSettlement>
        $lineItem2->specifiedLineTradeSettlement = new LineTradeSettlement();
        $lineItem2->specifiedLineTradeSettlement->tradeTax[] = $itemTradeTax = new TradeTax();
        $itemTradeTax->typeCode = 'VAT';
        $itemTradeTax->categoryCode = 'S';
        $itemTradeTax->rateApplicablePercent = '5.50';

        $lineItem2->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('48.00');
        // </ram:IncludedSupplyChainTradeLineItem>

        $invoice->supplyChainTradeTransaction->lineItems[] = $lineItem3 = new SupplyChainTradeLineItem();
        $lineItem3->associatedDocumentLineDocument = DocumentLineDocument::create('3');

        // <ram:SpecifiedTradeProduct>
        $lineItem3->specifiedTradeProduct = new TradeProduct();
        $lineItem3->specifiedTradeProduct->sellerAssignedID = 'HOLANCL';
        $lineItem3->specifiedTradeProduct->name = 'Huile d\'olive à l\'ancienne';
        // </ram:SpecifiedTradeProduct>

        // <ram:SpecifiedLineTradeAgreement>
        $lineItem3->tradeAgreement = new LineTradeAgreement();
        $lineItem3->tradeAgreement->grossPrice = TradePrice::create('19.80');
        $lineItem3->tradeAgreement->netPrice = TradePrice::create('19.80');
        // </ram:SpecifiedLineTradeAgreement>

        // <ram:SpecifiedLineTradeDelivery>
        $lineItem3->delivery = new LineTradeDelivery();
        $lineItem3->delivery->billedQuantity = Quantity::create('25.000', 'LTR');
        // </ram:SpecifiedLineTradeDelivery>

        // <ram:SpecifiedLineTradeSettlement>
        $lineItem3->specifiedLineTradeSettlement = new LineTradeSettlement();
        $lineItem3->specifiedLineTradeSettlement->tradeTax[] = $itemTradeTax = new TradeTax();
        $itemTradeTax->typeCode = 'VAT';
        $itemTradeTax->categoryCode = 'S';
        $itemTradeTax->rateApplicablePercent = '5.50';

        $lineItem3->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('495.00');
        // </ram:IncludedSupplyChainTradeLineItem>

        // <ram:ApplicableHeaderTradeAgreement>
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement = new HeaderTradeAgreement();

        // <ram:SellerTradeParty>
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerTradeParty = new TradeParty();
        $sellerTradeParty->name = 'Au bon moulin';
        $sellerTradeParty->specifiedLegalOrganization = $legalOrganization = new LegalOrganization();
        $legalOrganization->id = Id::create('99999999800010', '0002');

        // <ram:DefinedTradeContact>
        $sellerTradeParty->definedTradeContact = new TradeContact();
        $sellerTradeParty->definedTradeContact->personName = 'Tony Dubois';
        $sellerTradeParty->definedTradeContact->telephoneUniversalCommunication = $telephoneUniversalCommunication = new UniversalCommunication();
        $telephoneUniversalCommunication->completeNumber = '+33 4 72 07 08 56';

        $sellerTradeParty->definedTradeContact->emailURIUniversalCommunication = new UniversalCommunication();
        $sellerTradeParty->definedTradeContact->emailURIUniversalCommunication->uriid = Id::create('tony.dubois@aubonmoulin.fr', 'SMTP');
        // </ram:DefinedTradeContact>

        // <ram:PostalTradeAddress>
        $sellerTradeParty->postalTradeAddress = $postalTradeAddress = new TradeAddress();
        $postalTradeAddress->postcode = '84340';
        $postalTradeAddress->lineOne = '1242 chemin de l\'olive';
        $postalTradeAddress->city = 'Malaucène';
        $postalTradeAddress->countryCode = 'FR';
        // </ram:PostalTradeAddress>

        // <ram:SpecifiedTaxRegistration>
        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('FR11999999998', 'VA');
        // </ram:SpecifiedTaxRegistration>

        // </ram:SellerTradeParty>
        // <ram:BuyerTradeParty>
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerTradeParty = $buyerTradeParty = new TradeParty();
        $buyerTradeParty->name = 'Ma jolie boutique';

        // <ram:SpecifiedLegalOrganization>
        $buyerTradeParty->specifiedLegalOrganization = $legalOrganization = new LegalOrganization();
        $legalOrganization->id = Id::create('78787878400035', '0002');
        // </ram:SpecifiedLegalOrganization>

        // <ram:DefinedTradeContact>
        $buyerTradeParty->definedTradeContact = new TradeContact();
        $buyerTradeParty->definedTradeContact->personName = 'Alexandre Payet';

        $buyerTradeParty->definedTradeContact->telephoneUniversalCommunication = $telephoneUniversalCommunication = new UniversalCommunication();
        $telephoneUniversalCommunication->completeNumber = '+33 4 72 07 08 67';

        $buyerTradeParty->definedTradeContact->emailURIUniversalCommunication = new UniversalCommunication();
        $buyerTradeParty->definedTradeContact->emailURIUniversalCommunication->uriid = Id::create('alexandre.payet@majolieboutique.net', 'SMTP');
        // </ram:DefinedTradeContact>

        // <ram:PostalTradeAddress>
        $buyerTradeParty->postalTradeAddress = $postalTradeAddress = new TradeAddress();
        $postalTradeAddress->postcode = '69001';
        $postalTradeAddress->lineOne = '35 rue de la République';
        $postalTradeAddress->city = 'Lyon';
        $postalTradeAddress->countryCode = 'FR';
        // </ram:PostalTradeAddress>

        // <ram:SpecifiedTaxRegistration>
        $buyerTradeParty->taxRegistrations[] = TaxRegistration::create('FR19787878784', 'VA');
        // </ram:SpecifiedTaxRegistration>

        // </ram:BuyerTradeParty>

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerOrderReferencedDocument = ReferencedDocument::create('PO445');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->contractReferencedDocument = ReferencedDocument::create('MSPE2017');

        // <ram:ApplicableHeaderTradeDelivery>
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery = new HeaderTradeDelivery();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->shipToTradeParty = $shipToTradeParty = new TradeParty();
        $shipToTradeParty->postalTradeAddress = $postalTradeAddress = new TradeAddress();
        $postalTradeAddress->postcode = '69001';
        $postalTradeAddress->lineOne = '35 rue de la République';
        $postalTradeAddress->city = 'Lyon';
        $postalTradeAddress->countryCode = 'FR';
        // </ram:ApplicableHeaderTradeDelivery>

        // <ram:ApplicableHeaderTradeSettlement>
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement = new HeaderTradeSettlement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->paymentReference = 'FA-2017-0010';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->currency = 'EUR';

        // <ram:SpecifiedTradeSettlementPaymentMeans>
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementPaymentMeans[] = $paymentMeans1 = new TradeSettlementPaymentMeans();
        $paymentMeans1->typeCode = '30';
        $paymentMeans1->information = 'Virement sur compte Banque Fiducial';
        $paymentMeans1->payeePartyCreditorFinancialAccount = new CreditorFinancialAccount();
        $paymentMeans1->payeePartyCreditorFinancialAccount->ibanId = Id::create('FR2012421242124212421242124');
        $paymentMeans1->payeeSpecifiedCreditorFinancialInstitution = new CreditorFinancialInstitution();
        $paymentMeans1->payeeSpecifiedCreditorFinancialInstitution->bicId = Id::create('FIDCFR21XXX');
        // </ram:ApplicableHeaderTradeSettlement>

        // <ram:ApplicableTradeTax>
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->tradeTaxes[] = $applicableTradeTax1 = new TradeTax();
        $applicableTradeTax1->calculatedAmount = Amount::create('16.38');
        $applicableTradeTax1->typeCode = 'VAT';
        $applicableTradeTax1->basisAmount = Amount::create('81.90');
        $applicableTradeTax1->categoryCode = 'S';
        $applicableTradeTax1->dueDateTypeCode = '5';
        $applicableTradeTax1->rateApplicablePercent = '20.00';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->tradeTaxes[] = $applicableTradeTax2 = new TradeTax();
        $applicableTradeTax2->calculatedAmount = Amount::create('29.87');
        $applicableTradeTax2->typeCode = 'VAT';
        $applicableTradeTax2->basisAmount = Amount::create('543.00');
        $applicableTradeTax2->categoryCode = 'S';
        $applicableTradeTax2->dueDateTypeCode = '5';
        $applicableTradeTax2->rateApplicablePercent = '5.50';
        // </ram:ApplicableTradeTax>

        // <ram:SpecifiedTradePaymentTerms>
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradePaymentTerms[] = $paymentTerms = new TradePaymentTerms();
        $paymentTerms->description = '30% d\'acompte, solde à 30 j';
        $paymentTerms->dueDate = DateTime::create(102, '20171213');
        // </ram:SpecifiedTradePaymentTerms>

        // <ram:SpecifiedTradeSettlementHeaderMonetarySummation>
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = $summation = new TradeSettlementHeaderMonetarySummation();
        $summation->lineTotalAmount = Amount::create('624.90');
        $summation->taxBasisTotalAmount[] = Amount::create('624.90');
        $summation->taxTotalAmount[] = Amount::create('46.25', 'EUR');
        $summation->grandTotalAmount[] = Amount::create('671.15');
        $summation->totalPrepaidAmount = Amount::create('201.00');
        $summation->duePayableAmount = Amount::create('470.15');
        // </ram:SpecifiedTradeSettlementHeaderMonetarySummation>

        // </ram:ApplicableHeaderTradeSettlement>
        // </rsm:SupplyChainTradeTransaction>

        $xml = Builder::create()->transform($invoice);
        self::assertNotEmpty($xml);
        $referenceFile = file_get_contents(__DIR__ . '/data/official_example_xml/facturx_EXTENDED.xml');
        $referenceFile = ReaderAndBuildTest::reformatXml($referenceFile);
        $xml = ReaderAndBuildTest::reformatXml($xml);
        self::assertEquals($referenceFile, $xml);

        $result = (new Validator())->validateAgainstXsd($xml, Validator::SCHEMA_EXTENDED);
        self::assertNull($result, $result ?? '');
    }
}
