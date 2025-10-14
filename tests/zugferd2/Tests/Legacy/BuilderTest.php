<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Tests\Legacy;

use Easybill\ZUGFeRD2\Builder;
use Easybill\ZUGFeRD2\Model\Amount;
use Easybill\ZUGFeRD2\Model\CreditorFinancialAccount;
use Easybill\ZUGFeRD2\Model\CreditorFinancialInstitution;
use Easybill\ZUGFeRD2\Model\CrossIndustryInvoice;
use Easybill\ZUGFeRD2\Model\DateTime;
use Easybill\ZUGFeRD2\Model\DocumentContextParameter;
use Easybill\ZUGFeRD2\Model\DocumentLineDocument;
use Easybill\ZUGFeRD2\Model\ExchangedDocument;
use Easybill\ZUGFeRD2\Model\ExchangedDocumentContext;
use Easybill\ZUGFeRD2\Model\FormattedDateTime;
use Easybill\ZUGFeRD2\Model\HeaderTradeAgreement;
use Easybill\ZUGFeRD2\Model\HeaderTradeDelivery;
use Easybill\ZUGFeRD2\Model\HeaderTradeSettlement;
use Easybill\ZUGFeRD2\Model\Id;
use Easybill\ZUGFeRD2\Model\Indicator;
use Easybill\ZUGFeRD2\Model\LineTradeAgreement;
use Easybill\ZUGFeRD2\Model\LineTradeDelivery;
use Easybill\ZUGFeRD2\Model\LineTradeSettlement;
use Easybill\ZUGFeRD2\Model\LogisticsServiceCharge;
use Easybill\ZUGFeRD2\Model\Note;
use Easybill\ZUGFeRD2\Model\ProcuringProject;
use Easybill\ZUGFeRD2\Model\Quantity;
use Easybill\ZUGFeRD2\Model\ReferencedDocument;
use Easybill\ZUGFeRD2\Model\SupplyChainEvent;
use Easybill\ZUGFeRD2\Model\SupplyChainTradeLineItem;
use Easybill\ZUGFeRD2\Model\SupplyChainTradeTransaction;
use Easybill\ZUGFeRD2\Model\TaxRegistration;
use Easybill\ZUGFeRD2\Model\TradeAddress;
use Easybill\ZUGFeRD2\Model\TradeAllowanceCharge;
use Easybill\ZUGFeRD2\Model\TradeContact;
use Easybill\ZUGFeRD2\Model\TradeCountry;
use Easybill\ZUGFeRD2\Model\TradeParty;
use Easybill\ZUGFeRD2\Model\TradePaymentTerms;
use Easybill\ZUGFeRD2\Model\TradePrice;
use Easybill\ZUGFeRD2\Model\TradeProduct;
use Easybill\ZUGFeRD2\Model\TradeSettlementHeaderMonetarySummation;
use Easybill\ZUGFeRD2\Model\TradeSettlementLineMonetarySummation;
use Easybill\ZUGFeRD2\Model\TradeSettlementPaymentMeans;
use Easybill\ZUGFeRD2\Model\TradeTax;
use Easybill\ZUGFeRD2\Model\UniversalCommunication;
use Easybill\ZUGFeRD2\Validator;
use PHPUnit\Framework\TestCase;

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
        $buyerTradeParty->id[] = Id::create('1034567');
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
        $buyerTradeParty->id[] = Id::create('GE2020211');
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
        $referenceFile = (string)file_get_contents(__DIR__ . '/official_example_xml/zugferd_2p1_XRECHNUNG_Einfach.xml');
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
        $item1->delivery->actualDeliverySupplyChainEvent = new SupplyChainEvent();
        $item1->delivery->actualDeliverySupplyChainEvent->date = DateTime::create(102, '20180305');

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

        $item1->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('190.00', totalAllowanceChargeAmount: '8.00');

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
        $buyerTradeParty->id[] = Id::create('1034567');
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
        $buyerTradeParty->id[] = Id::create('GE2020211');
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
        $paymentTerms->directDebitMandateID = Id::create('Mandate Reference');
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
        $referenceFile = (string)file_get_contents(__DIR__ . '/official_example_xml/zugferd_2p1_XRECHNUNG_Extended.xml');
        $referenceFile = ReaderAndBuildTest::reformatXml($referenceFile);
        $xml = ReaderAndBuildTest::reformatXml($xml);
        self::assertEquals($referenceFile, $xml);

        $result = (new Validator())->validateAgainstXsd($xml, Validator::SCHEMA_EXTENDED);
        self::assertNull($result, $result ?? '');
    }
}
