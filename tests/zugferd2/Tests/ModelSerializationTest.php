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
use Easybill\ZUGFeRD2\Model\Indicator;
use Easybill\ZUGFeRD2\Model\LineTradeAgreement;
use Easybill\ZUGFeRD2\Model\LineTradeDelivery;
use Easybill\ZUGFeRD2\Model\LineTradeSettlement;
use Easybill\ZUGFeRD2\Model\Quantity;
use Easybill\ZUGFeRD2\Model\SupplyChainTradeLineItem;
use Easybill\ZUGFeRD2\Model\SupplyChainTradeTransaction;
use Easybill\ZUGFeRD2\Model\Id;
use Easybill\ZUGFeRD2\Model\LegalOrganization;
use Easybill\ZUGFeRD2\Model\ProductCharacteristic;
use Easybill\ZUGFeRD2\Model\ProductClassification;
use Easybill\ZUGFeRD2\Model\SpecifiedPeriod;
use Easybill\ZUGFeRD2\Model\TradeAddress;
use Easybill\ZUGFeRD2\Model\TradeAllowanceCharge;
use Easybill\ZUGFeRD2\Model\TradeContact;
use Easybill\ZUGFeRD2\Model\TradeCountry;
use Easybill\ZUGFeRD2\Model\TradeParty;
use Easybill\ZUGFeRD2\Model\TradePrice;
use Easybill\ZUGFeRD2\Model\TradeProduct;
use Easybill\ZUGFeRD2\Model\TradeSettlementHeaderMonetarySummation;
use Easybill\ZUGFeRD2\Model\TradeSettlementLineMonetarySummation;
use Easybill\ZUGFeRD2\Model\TradeTax;
use Easybill\ZUGFeRD2\Model\UniversalCommunication;
use Easybill\ZUGFeRD2\Reader;
use PHPUnit\Framework\TestCase;
use Easybill\ZUGFeRD2\Model\BinaryObject;
use Easybill\ZUGFeRD2\Model\ClassCode;
use Easybill\ZUGFeRD2\Model\CreditorFinancialAccount;
use Easybill\ZUGFeRD2\Model\CreditorFinancialInstitution;
use Easybill\ZUGFeRD2\Model\DebtorFinancialAccount;
use Easybill\ZUGFeRD2\Model\FormattedDateTime;
use Easybill\ZUGFeRD2\Model\Note;
use Easybill\ZUGFeRD2\Model\ReferencedDocument;
use Easybill\ZUGFeRD2\Model\ReferencedProduct;
use Easybill\ZUGFeRD2\Model\SupplyChainEvent;
use Easybill\ZUGFeRD2\Model\TaxRegistration;
use Easybill\ZUGFeRD2\Model\TradeAccountingAccount;
use Easybill\ZUGFeRD2\Model\TradeDeliveryTerms;
use Easybill\ZUGFeRD2\Model\TradePaymentTerms;
use Easybill\ZUGFeRD2\Model\TradeSettlementPaymentMeans;

class ModelSerializationTest extends TestCase
{
    private function createMinimalInvoice(): CrossIndustryInvoice
    {
        $invoice = new CrossIndustryInvoice();

        $invoice->exchangedDocumentContext = new ExchangedDocumentContext();
        $invoice->exchangedDocumentContext->documentContextParameter = DocumentContextParameter::create(
            Builder::GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_EXTENDED
        );

        $invoice->exchangedDocument = new ExchangedDocument();
        $invoice->exchangedDocument->id = 'TEST-001';
        $invoice->exchangedDocument->typeCode = '380';
        $invoice->exchangedDocument->issueDateTime = DateTime::create(102, '20250114');

        $invoice->supplyChainTradeTransaction = new SupplyChainTradeTransaction();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement = new HeaderTradeAgreement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery = new HeaderTradeDelivery();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement = new HeaderTradeSettlement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->currency = 'EUR';

        return $invoice;
    }

    public function testDocumentContextParameterSerialization(): void
    {
        $testId = 'urn:test:document:context:parameter:12345';
        $model = DocumentContextParameter::create($testId);

        $invoice = $this->createMinimalInvoice();
        $invoice->exchangedDocumentContext->businessProcessSpecifiedDocumentContextParameter = $model;

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->exchangedDocumentContext->businessProcessSpecifiedDocumentContextParameter;

        self::assertNotNull($resultModel);
        self::assertEquals($testId, $resultModel->id);
    }

    public function testTradeAllowanceChargeSerialization(): void
    {
        $actualAmount = Amount::create('100.00');
        $indicator = new Indicator();
        $indicator->indicator = false;
        $calculationPercent = '10.00';
        $basisAmount = Amount::create('1000.00');
        $reason = 'Volume discount';
        $tradeTax = [
            TradeTax::create(
                typeCode: 'VAT',
                categoryCode: 'S',
                rateApplicablePercent: '19.00'
            ),
        ];

        $model = TradeAllowanceCharge::create(
            actualAmount: $actualAmount,
            indicator: $indicator,
            calculationPercent: $calculationPercent,
            basisAmount: $basisAmount,
            reason: $reason,
            tradeTax: $tradeTax
        );

        $model->reasonCode = '95';

        $invoice = $this->createMinimalInvoice();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeAllowanceCharge[] = $model;

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = new TradeSettlementHeaderMonetarySummation();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->lineTotalAmount = Amount::create('1000.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxBasisTotalAmount[] = Amount::create('900.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxTotalAmount[] = Amount::create('171.00', 'EUR');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->grandTotalAmount[] = Amount::create('1071.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->duePayableAmount = Amount::create('1071.00');

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeAllowanceCharge[0];

        self::assertEquals($actualAmount->value, $resultModel->actualAmount->value);
        self::assertEquals($actualAmount->currency, $resultModel->actualAmount->currency);
        self::assertNotNull($resultModel->indicator);
        self::assertEquals($indicator->indicator, $resultModel->indicator->indicator);
        self::assertEquals($calculationPercent, $resultModel->calculationPercent);
        self::assertNotNull($resultModel->basisAmount);
        self::assertEquals($basisAmount->value, $resultModel->basisAmount->value);
        self::assertEquals($reason, $resultModel->reason);
        self::assertEquals('95', $resultModel->reasonCode);
        self::assertCount(1, $resultModel->tradeTax);
        self::assertEquals('VAT', $resultModel->tradeTax[0]->typeCode);
        self::assertEquals('S', $resultModel->tradeTax[0]->categoryCode);
        self::assertEquals('19.00', $resultModel->tradeTax[0]->rateApplicablePercent);
    }

    public function testTradeSettlementLineMonetarySummationSerialization(): void
    {
        $lineTotalAmount = '5000.00';
        $chargeTotalAmount = '50.00';
        $allowanceTotalAmount = '100.00';
        $taxTotalAmount = '930.50';
        $grandTotalAmount = '5880.50';
        $totalAllowanceChargeAmount = '50.00';

        $model = TradeSettlementLineMonetarySummation::create(
            totalAmount: $lineTotalAmount,
            chargeTotalAmount: $chargeTotalAmount,
            allowanceTotalAmount: $allowanceTotalAmount,
            taxTotalAmount: $taxTotalAmount,
            grandTotalAmount: $grandTotalAmount,
            totalAllowanceChargeAmount: $totalAllowanceChargeAmount
        );

        $invoice = $this->createMinimalInvoice();

        $lineItem = new SupplyChainTradeLineItem();
        $lineItem->associatedDocumentLineDocument = DocumentLineDocument::create('1');
        $lineItem->specifiedTradeProduct = new TradeProduct();
        $lineItem->specifiedTradeProduct->name = 'Test Product';

        $lineItem->tradeAgreement = new LineTradeAgreement();
        $lineItem->delivery = new LineTradeDelivery();
        $lineItem->delivery->billedQuantity = Quantity::create('10', 'C62');

        $lineItem->specifiedLineTradeSettlement = new LineTradeSettlement();
        $lineItem->specifiedLineTradeSettlement->tradeTax[] = TradeTax::create(
            typeCode: 'VAT',
            categoryCode: 'S',
            rateApplicablePercent: '19.00'
        );
        $lineItem->specifiedLineTradeSettlement->monetarySummation = $model;

        $invoice->supplyChainTradeTransaction->lineItems[] = $lineItem;

        $sellerParty = new TradeParty();
        $sellerParty->name = 'Test Seller';
        $sellerParty->postalTradeAddress = new TradeAddress();
        $sellerParty->postalTradeAddress->countryCode = 'DE';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerParty;

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = new TradeSettlementHeaderMonetarySummation();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->lineTotalAmount = Amount::create($lineTotalAmount);
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxBasisTotalAmount[] = Amount::create($lineTotalAmount);
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxTotalAmount[] = Amount::create($taxTotalAmount, 'EUR');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->grandTotalAmount[] = Amount::create($grandTotalAmount);
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->duePayableAmount = Amount::create($grandTotalAmount);

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->lineItems[0]->specifiedLineTradeSettlement->monetarySummation;

        self::assertEquals($lineTotalAmount, $resultModel->lineTotalAmount->value);

        self::assertNotNull($resultModel->chargeTotalAmount);
        self::assertEquals($chargeTotalAmount, $resultModel->chargeTotalAmount->value);

        self::assertNotNull($resultModel->allowanceTotalAmount);
        self::assertEquals($allowanceTotalAmount, $resultModel->allowanceTotalAmount->value);

        self::assertNotNull($resultModel->taxTotalAmount);
        self::assertEquals($taxTotalAmount, $resultModel->taxTotalAmount->value);

        self::assertNotNull($resultModel->grandTotalAmount);
        self::assertEquals($grandTotalAmount, $resultModel->grandTotalAmount->value);

        self::assertNotNull($resultModel->totalAllowanceChargeAmount);
        self::assertEquals($totalAllowanceChargeAmount, $resultModel->totalAllowanceChargeAmount->value);
    }

    public function testTradeAddressSerialization(): void
    {
        $model = new TradeAddress();
        $model->postcode = '10115';
        $model->lineOne = 'Musterstraße 123';
        $model->lineTwo = 'Gebäude A';
        $model->lineThree = '3. Etage';
        $model->city = 'Berlin';
        $model->countryCode = 'DE';
        $model->countrySubDivisionName = 'Berlin';

        $invoice = $this->createMinimalInvoice();
        $sellerParty = new TradeParty();
        $sellerParty->name = 'Test Company';
        $sellerParty->postalTradeAddress = $model;
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerParty;

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty->postalTradeAddress;

        self::assertNotNull($resultModel);
        self::assertEquals('10115', $resultModel->postcode);
        self::assertEquals('Musterstraße 123', $resultModel->lineOne);
        self::assertEquals('Gebäude A', $resultModel->lineTwo);
        self::assertEquals('3. Etage', $resultModel->lineThree);
        self::assertEquals('Berlin', $resultModel->city);
        self::assertEquals('DE', $resultModel->countryCode);
        self::assertEquals('Berlin', $resultModel->countrySubDivisionName);
    }

    public function testUniversalCommunicationSerialization(): void
    {
        $phoneComm = new UniversalCommunication();
        $phoneComm->completeNumber = '+49 30 12345678';

        $emailComm = new UniversalCommunication();
        $emailComm->uriid = Id::create('test@example.com', 'SMTP');

        $invoice = $this->createMinimalInvoice();
        $sellerParty = new TradeParty();
        $sellerParty->name = 'Test Company';
        $sellerParty->definedTradeContact = new TradeContact();
        $sellerParty->definedTradeContact->telephoneUniversalCommunication = $phoneComm;
        $sellerParty->definedTradeContact->emailURIUniversalCommunication = $emailComm;
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerParty;

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $contact = $deserialized->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty->definedTradeContact;

        self::assertNotNull($contact);
        self::assertNotNull($contact->telephoneUniversalCommunication);
        self::assertEquals('+49 30 12345678', $contact->telephoneUniversalCommunication->completeNumber);

        self::assertNotNull($contact->emailURIUniversalCommunication);
        self::assertNotNull($contact->emailURIUniversalCommunication->uriid);
        self::assertEquals('test@example.com', $contact->emailURIUniversalCommunication->uriid->value);
        self::assertEquals('SMTP', $contact->emailURIUniversalCommunication->uriid->schemeID);
    }

    public function testTradeContactSerialization(): void
    {
        $model = new TradeContact();
        $model->personName = 'Max Mustermann';
        $model->departmentName = 'Sales Department';
        $model->telephoneUniversalCommunication = new UniversalCommunication();
        $model->telephoneUniversalCommunication->completeNumber = '+49 30 12345678';
        $model->faxUniversalCommunication = new UniversalCommunication();
        $model->faxUniversalCommunication->completeNumber = '+49 30 12345679';
        $model->emailURIUniversalCommunication = new UniversalCommunication();
        $model->emailURIUniversalCommunication->uriid = Id::create('max.mustermann@example.com', 'SMTP');

        $invoice = $this->createMinimalInvoice();
        $sellerParty = new TradeParty();
        $sellerParty->name = 'Test Company';
        $sellerParty->definedTradeContact = $model;
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerParty;

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty->definedTradeContact;
        self::assertNotNull($resultModel);
        self::assertEquals('Max Mustermann', $resultModel->personName);
        self::assertEquals('Sales Department', $resultModel->departmentName);
        self::assertNotNull($resultModel->telephoneUniversalCommunication);
        self::assertEquals('+49 30 12345678', $resultModel->telephoneUniversalCommunication->completeNumber);
        self::assertNotNull($resultModel->faxUniversalCommunication);
        self::assertEquals('+49 30 12345679', $resultModel->faxUniversalCommunication->completeNumber);
        self::assertNotNull($resultModel->emailURIUniversalCommunication);
        self::assertNotNull($resultModel->emailURIUniversalCommunication->uriid);
        self::assertEquals('max.mustermann@example.com', $resultModel->emailURIUniversalCommunication->uriid->value);
    }

    public function testTradePartySerialization(): void
    {
        $model = new TradeParty();
        $model->id[] = Id::create('PARTY-123');
        $model->globalID[] = Id::create('4000001234567', '0088');
        $model->name = 'Comprehensive Test Company GmbH';
        $model->roleCode = 'AG';
        $model->description = 'Leading provider of test data';

        $model->specifiedLegalOrganization = new LegalOrganization();
        $model->specifiedLegalOrganization->id = Id::create('HRB12345');
        $model->specifiedLegalOrganization->tradingBusinessName = 'Test Company Trading';
        $model->specifiedLegalOrganization->postalTradeAddress = new TradeAddress();
        $model->specifiedLegalOrganization->postalTradeAddress->postcode = '10115';
        $model->specifiedLegalOrganization->postalTradeAddress->lineOne = 'Legal Street 1';
        $model->specifiedLegalOrganization->postalTradeAddress->city = 'Berlin';
        $model->specifiedLegalOrganization->postalTradeAddress->countryCode = 'DE';

        $model->definedTradeContact = new TradeContact();
        $model->definedTradeContact->personName = 'Erika Musterfrau';
        $model->definedTradeContact->departmentName = 'Procurement';

        $model->postalTradeAddress = new TradeAddress();
        $model->postalTradeAddress->postcode = '20095';
        $model->postalTradeAddress->lineOne = 'Hauptstraße 456';
        $model->postalTradeAddress->city = 'Hamburg';
        $model->postalTradeAddress->countryCode = 'DE';

        $model->uriUniversalCommunication = new UniversalCommunication();
        $model->uriUniversalCommunication->uriid = Id::create('info@testcompany.example', 'EM');

        $model->taxRegistrations[] = TaxRegistration::create('DE123456789', 'VA');
        $model->taxRegistrations[] = TaxRegistration::create('201/234/56789', 'FC');

        $invoice = $this->createMinimalInvoice();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $model;

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty;
        self::assertCount(1, $resultModel->id);
        self::assertEquals('PARTY-123', $resultModel->id[0]->value);
        self::assertCount(1, $resultModel->globalID);
        self::assertEquals('4000001234567', $resultModel->globalID[0]->value);
        self::assertEquals('Comprehensive Test Company GmbH', $resultModel->name);
        self::assertEquals('AG', $resultModel->roleCode);
        self::assertEquals('Leading provider of test data', $resultModel->description);
        self::assertNotNull($resultModel->specifiedLegalOrganization);
        self::assertEquals('HRB12345', $resultModel->specifiedLegalOrganization->id->value);
        self::assertEquals('Test Company Trading', $resultModel->specifiedLegalOrganization->tradingBusinessName);
        self::assertNotNull($resultModel->specifiedLegalOrganization->postalTradeAddress);
        self::assertEquals('Legal Street 1', $resultModel->specifiedLegalOrganization->postalTradeAddress->lineOne);
        self::assertNotNull($resultModel->definedTradeContact);
        self::assertEquals('Erika Musterfrau', $resultModel->definedTradeContact->personName);
        self::assertNotNull($resultModel->postalTradeAddress);
        self::assertEquals('Hauptstraße 456', $resultModel->postalTradeAddress->lineOne);
        self::assertNotNull($resultModel->uriUniversalCommunication);
        self::assertNotNull($resultModel->uriUniversalCommunication->uriid);
        self::assertEquals('info@testcompany.example', $resultModel->uriUniversalCommunication->uriid->value);
        self::assertCount(2, $resultModel->taxRegistrations);
        self::assertEquals('DE123456789', $resultModel->taxRegistrations[0]->registration->value);
    }

    public function testLegalOrganizationSerialization(): void
    {
        $model = new LegalOrganization();
        $model->id = Id::create('HRB54321');
        $model->tradingBusinessName = 'Legal Test Trading GmbH';
        $model->postalTradeAddress = new TradeAddress();
        $model->postalTradeAddress->postcode = '60311';
        $model->postalTradeAddress->lineOne = 'Rechtsstraße 789';
        $model->postalTradeAddress->city = 'Frankfurt';
        $model->postalTradeAddress->countryCode = 'DE';

        $invoice = $this->createMinimalInvoice();
        $sellerParty = new TradeParty();
        $sellerParty->name = 'Test Company';
        $sellerParty->specifiedLegalOrganization = $model;
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerParty;

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty->specifiedLegalOrganization;

        self::assertNotNull($resultModel);
        self::assertEquals('HRB54321', $resultModel->id->value);
        self::assertEquals('Legal Test Trading GmbH', $resultModel->tradingBusinessName);
        self::assertNotNull($resultModel->postalTradeAddress);
        self::assertEquals('Rechtsstraße 789', $resultModel->postalTradeAddress->lineOne);
        self::assertEquals('Frankfurt', $resultModel->postalTradeAddress->city);
    }

    public function testSpecifiedPeriodSerialization(): void
    {
        $model = new SpecifiedPeriod();
        $model->description = 'Q1 2025 Billing Period';
        $model->startDateTime = DateTime::create(102, '20250101');
        $model->endDateTime = DateTime::create(102, '20250331');
        $model->completeDateTime = DateTime::create(102, '20250401');

        $invoice = $this->createMinimalInvoice();
        $lineItem = new SupplyChainTradeLineItem();
        $lineItem->associatedDocumentLineDocument = DocumentLineDocument::create('1');
        $lineItem->specifiedTradeProduct = new TradeProduct();
        $lineItem->specifiedTradeProduct->name = 'Period Test Product';
        $lineItem->tradeAgreement = new LineTradeAgreement();
        $lineItem->delivery = new LineTradeDelivery();
        $lineItem->delivery->billedQuantity = Quantity::create('1', 'C62');
        $lineItem->specifiedLineTradeSettlement = new LineTradeSettlement();
        $lineItem->specifiedLineTradeSettlement->billingSpecifiedPeriod = $model;
        $lineItem->specifiedLineTradeSettlement->tradeTax[] = TradeTax::create(
            typeCode: 'VAT',
            categoryCode: 'S',
            rateApplicablePercent: '19.00'
        );
        $lineItem->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('100.00');

        $invoice->supplyChainTradeTransaction->lineItems[] = $lineItem;

        $sellerParty = new TradeParty();
        $sellerParty->name = 'Test Seller';
        $sellerParty->postalTradeAddress = new TradeAddress();
        $sellerParty->postalTradeAddress->countryCode = 'DE';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerParty;
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = new TradeSettlementHeaderMonetarySummation();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->lineTotalAmount = Amount::create('100.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxBasisTotalAmount[] = Amount::create('100.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxTotalAmount[] = Amount::create('19.00', 'EUR');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->grandTotalAmount[] = Amount::create('119.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->duePayableAmount = Amount::create('119.00');

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->lineItems[0]->specifiedLineTradeSettlement->billingSpecifiedPeriod;
        self::assertNotNull($resultModel);
        self::assertEquals('Q1 2025 Billing Period', $resultModel->description);
        self::assertNotNull($resultModel->startDateTime);
        self::assertEquals('20250101', $resultModel->startDateTime->dateTimeString->value);
        self::assertNotNull($resultModel->endDateTime);
        self::assertEquals('20250331', $resultModel->endDateTime->dateTimeString->value);
        self::assertNotNull($resultModel->completeDateTime);
        self::assertEquals('20250401', $resultModel->completeDateTime->dateTimeString->value);
    }

    public function testIndicatorSerialization(): void
    {
        $falseIndicator = new Indicator();
        $falseIndicator->indicator = false;

        $trueIndicator = new Indicator();
        $trueIndicator->indicator = true;

        $invoice = $this->createMinimalInvoice();
        $invoice->exchangedDocumentContext->testIndicator = $falseIndicator;

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);
        self::assertNotNull($deserialized->exchangedDocumentContext->testIndicator);
        self::assertFalse($deserialized->exchangedDocumentContext->testIndicator->indicator);

        $invoice->exchangedDocumentContext->testIndicator = $trueIndicator;
        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        self::assertNotNull($deserialized->exchangedDocumentContext->testIndicator);
        self::assertTrue($deserialized->exchangedDocumentContext->testIndicator->indicator);
    }

    public function testTradeProductSerialization(): void
    {
        $model = new TradeProduct();
        $model->globalID = Id::create('4012345678901', '0160');
        $model->sellerAssignedID = 'PROD-SELLER-001';
        $model->buyerAssignedID = 'PROD-BUYER-001';
        $model->name = 'Premium Test Widget';
        $model->description = 'High-quality widget for comprehensive testing';
        $model->tradeCountry = TradeCountry::create('DE');

        $char1 = new ProductCharacteristic();
        $char1->description = 'Color';
        $char1->value = 'Blue';
        $model->applicableProductCharacteristic[] = $char1;

        $char2 = new ProductCharacteristic();
        $char2->description = 'Material';
        $char2->value = 'Steel';
        $model->applicableProductCharacteristic[] = $char2;

        $model->designatedProductClassification = new ProductClassification();
        $model->designatedProductClassification->classCode = ClassCode::create('12345678', '9');

        $invoice = $this->createMinimalInvoice();

        $lineItem = new SupplyChainTradeLineItem();
        $lineItem->associatedDocumentLineDocument = DocumentLineDocument::create('1');
        $lineItem->specifiedTradeProduct = $model;
        $lineItem->tradeAgreement = new LineTradeAgreement();
        $lineItem->delivery = new LineTradeDelivery();
        $lineItem->delivery->billedQuantity = Quantity::create('10', 'C62');
        $lineItem->specifiedLineTradeSettlement = new LineTradeSettlement();
        $lineItem->specifiedLineTradeSettlement->tradeTax[] = TradeTax::create(
            typeCode: 'VAT',
            categoryCode: 'S',
            rateApplicablePercent: '19.00'
        );
        $lineItem->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('1000.00');

        $invoice->supplyChainTradeTransaction->lineItems[] = $lineItem;

        $sellerParty = new TradeParty();
        $sellerParty->name = 'Test Seller';
        $sellerParty->postalTradeAddress = new TradeAddress();
        $sellerParty->postalTradeAddress->countryCode = 'DE';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerParty;

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = new TradeSettlementHeaderMonetarySummation();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->lineTotalAmount = Amount::create('1000.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxBasisTotalAmount[] = Amount::create('1000.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxTotalAmount[] = Amount::create('190.00', 'EUR');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->grandTotalAmount[] = Amount::create('1190.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->duePayableAmount = Amount::create('1190.00');

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->lineItems[0]->specifiedTradeProduct;
        self::assertNotNull($resultModel->globalID);
        self::assertEquals('4012345678901', $resultModel->globalID->value);
        self::assertEquals('0160', $resultModel->globalID->schemeID);
        self::assertEquals('PROD-SELLER-001', $resultModel->sellerAssignedID);
        self::assertEquals('PROD-BUYER-001', $resultModel->buyerAssignedID);
        self::assertEquals('Premium Test Widget', $resultModel->name);
        self::assertEquals('High-quality widget for comprehensive testing', $resultModel->description);
        self::assertNotNull($resultModel->tradeCountry);
        self::assertEquals('DE', $resultModel->tradeCountry->id);
        self::assertNotNull($resultModel->applicableProductCharacteristic);
        self::assertCount(2, $resultModel->applicableProductCharacteristic);
        self::assertEquals('Color', $resultModel->applicableProductCharacteristic[0]->description);
        self::assertEquals('Blue', $resultModel->applicableProductCharacteristic[0]->value);
        self::assertEquals('Material', $resultModel->applicableProductCharacteristic[1]->description);
        self::assertEquals('Steel', $resultModel->applicableProductCharacteristic[1]->value);
        self::assertNotNull($resultModel->designatedProductClassification);
        self::assertNotNull($resultModel->designatedProductClassification->classCode);
        self::assertEquals('12345678', $resultModel->designatedProductClassification->classCode->value);
        self::assertEquals('9', $resultModel->designatedProductClassification->classCode->listID);
    }

    public function testReferencedProductSerialization(): void
    {
        $model = new ReferencedProduct();
        $model->globalID[] = Id::create('4000001234567', '0088');
        $model->globalID[] = Id::create('0987654321098', '0160');
        $model->sellerAssignedID = Id::create('REF-SELLER-123');
        $model->buyerAssignedID = Id::create('REF-BUYER-456');
        $model->industryAssignedID = Id::create('INDUSTRY-789');
        $model->name = 'Referenced Test Product';
        $model->description = 'Product referenced for testing purposes';
        $model->unitQuantity = Quantity::create('5', 'C62');
        $model->packQuantity = Quantity::create('10', 'PK');

        $invoice = $this->createMinimalInvoice();

        $lineItem = new SupplyChainTradeLineItem();
        $lineItem->associatedDocumentLineDocument = DocumentLineDocument::create('1');
        $lineItem->specifiedTradeProduct = new TradeProduct();
        $lineItem->specifiedTradeProduct->name = 'Main Product';
        $lineItem->specifiedTradeProduct->includedReferencedProduct[] = $model;

        $lineItem->tradeAgreement = new LineTradeAgreement();
        $lineItem->delivery = new LineTradeDelivery();
        $lineItem->delivery->billedQuantity = Quantity::create('1', 'C62');
        $lineItem->specifiedLineTradeSettlement = new LineTradeSettlement();
        $lineItem->specifiedLineTradeSettlement->tradeTax[] = TradeTax::create(
            typeCode: 'VAT',
            categoryCode: 'S',
            rateApplicablePercent: '19.00'
        );
        $lineItem->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('100.00');

        $invoice->supplyChainTradeTransaction->lineItems[] = $lineItem;

        $sellerParty = new TradeParty();
        $sellerParty->name = 'Test Seller';
        $sellerParty->postalTradeAddress = new TradeAddress();
        $sellerParty->postalTradeAddress->countryCode = 'DE';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerParty;

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = new TradeSettlementHeaderMonetarySummation();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->lineTotalAmount = Amount::create('100.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxBasisTotalAmount[] = Amount::create('100.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxTotalAmount[] = Amount::create('19.00', 'EUR');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->grandTotalAmount[] = Amount::create('119.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->duePayableAmount = Amount::create('119.00');

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->lineItems[0]->specifiedTradeProduct->includedReferencedProduct[0];
        self::assertCount(2, $resultModel->globalID);
        self::assertEquals('4000001234567', $resultModel->globalID[0]->value);
        self::assertEquals('0088', $resultModel->globalID[0]->schemeID);
        self::assertEquals('0987654321098', $resultModel->globalID[1]->value);
        self::assertEquals('0160', $resultModel->globalID[1]->schemeID);
        self::assertNotNull($resultModel->sellerAssignedID);
        self::assertEquals('REF-SELLER-123', $resultModel->sellerAssignedID->value);
        self::assertNotNull($resultModel->buyerAssignedID);
        self::assertEquals('REF-BUYER-456', $resultModel->buyerAssignedID->value);
        self::assertNotNull($resultModel->industryAssignedID);
        self::assertEquals('INDUSTRY-789', $resultModel->industryAssignedID->value);
        self::assertEquals('Referenced Test Product', $resultModel->name);
        self::assertEquals('Product referenced for testing purposes', $resultModel->description);
        self::assertNotNull($resultModel->unitQuantity);
        self::assertEquals('5', $resultModel->unitQuantity->value);
        self::assertEquals('C62', $resultModel->unitQuantity->unitCode);
        self::assertNotNull($resultModel->packQuantity);
        self::assertEquals('10', $resultModel->packQuantity->value);
        self::assertEquals('PK', $resultModel->packQuantity->unitCode);
    }

    public function testTradeSettlementPaymentMeansSerialization(): void
    {
        $model = new TradeSettlementPaymentMeans();
        $model->typeCode = '58';
        $model->information = 'Payment by bank transfer';
        $model->payeePartyCreditorFinancialAccount = new CreditorFinancialAccount();
        $model->payeePartyCreditorFinancialAccount->ibanId = Id::create('DE89370400440532013000');
        $model->payeePartyCreditorFinancialAccount->AccountName = 'Test Company Account';
        $model->payeeSpecifiedCreditorFinancialInstitution = new CreditorFinancialInstitution();
        $model->payeeSpecifiedCreditorFinancialInstitution->bicId = Id::create('COBADEFFXXX');
        $model->payerPartyDebtorFinancialAccount = new DebtorFinancialAccount();
        $model->payerPartyDebtorFinancialAccount->ibanId = Id::create('DE75512108001245126199');

        $invoice = $this->createMinimalInvoice();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementPaymentMeans[] = $model;
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = new TradeSettlementHeaderMonetarySummation();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->lineTotalAmount = Amount::create('1000.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxBasisTotalAmount[] = Amount::create('1000.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxTotalAmount[] = Amount::create('190.00', 'EUR');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->grandTotalAmount[] = Amount::create('1190.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->duePayableAmount = Amount::create('1190.00');

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementPaymentMeans[0];
        self::assertEquals('58', $resultModel->typeCode);
        self::assertEquals('Payment by bank transfer', $resultModel->information);
        self::assertNotNull($resultModel->payeePartyCreditorFinancialAccount);
        self::assertNotNull($resultModel->payeePartyCreditorFinancialAccount->ibanId);
        self::assertEquals('DE89370400440532013000', $resultModel->payeePartyCreditorFinancialAccount->ibanId->value);
        self::assertEquals('Test Company Account', $resultModel->payeePartyCreditorFinancialAccount->AccountName);
        self::assertNotNull($resultModel->payeeSpecifiedCreditorFinancialInstitution);
        self::assertEquals('COBADEFFXXX', $resultModel->payeeSpecifiedCreditorFinancialInstitution->bicId->value);
        self::assertNotNull($resultModel->payerPartyDebtorFinancialAccount);
        self::assertNotNull($resultModel->payerPartyDebtorFinancialAccount->ibanId);
        self::assertEquals('DE75512108001245126199', $resultModel->payerPartyDebtorFinancialAccount->ibanId->value);
    }

    public function testTradePaymentTermsSerialization(): void
    {
        $model = new TradePaymentTerms();
        $model->description = 'Payment within 14 days with 2% discount, otherwise 30 days net';
        $model->dueDate = DateTime::create(102, '20250228');
        $model->directDebitMandateID = Id::create('MANDATE-2025-001');
        $model->partialPaymentAmount = Amount::create('500.00');

        $model->payeeTradeParty = new TradeParty();
        $model->payeeTradeParty->name = 'Alternative Payee GmbH';
        $model->payeeTradeParty->postalTradeAddress = new TradeAddress();
        $model->payeeTradeParty->postalTradeAddress->postcode = '10115';
        $model->payeeTradeParty->postalTradeAddress->city = 'Berlin';
        $model->payeeTradeParty->postalTradeAddress->countryCode = 'DE';

        $invoice = $this->createMinimalInvoice();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradePaymentTerms[] = $model;
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = new TradeSettlementHeaderMonetarySummation();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->lineTotalAmount = Amount::create('1000.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxBasisTotalAmount[] = Amount::create('1000.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxTotalAmount[] = Amount::create('190.00', 'EUR');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->grandTotalAmount[] = Amount::create('1190.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->duePayableAmount = Amount::create('1190.00');

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradePaymentTerms[0];

        self::assertEquals('Payment within 14 days with 2% discount, otherwise 30 days net', $resultModel->description);
        self::assertNotNull($resultModel->dueDate);
        self::assertEquals('20250228', $resultModel->dueDate->dateTimeString->value);
        self::assertNotNull($resultModel->directDebitMandateID);
        self::assertEquals('MANDATE-2025-001', $resultModel->directDebitMandateID->value);
        self::assertNotNull($resultModel->partialPaymentAmount);
        self::assertEquals('500.00', $resultModel->partialPaymentAmount->value);
        self::assertNotNull($resultModel->payeeTradeParty);
        self::assertEquals('Alternative Payee GmbH', $resultModel->payeeTradeParty->name);
        self::assertNotNull($resultModel->payeeTradeParty->postalTradeAddress);
        self::assertEquals('Berlin', $resultModel->payeeTradeParty->postalTradeAddress->city);
    }

    public function testNoteSerialization(): void
    {
        $model = Note::create(
            'This is a test note with detailed information',
            'REG',
            'AAI'
        );

        $invoice = $this->createMinimalInvoice();
        $invoice->exchangedDocument->notes[] = $model;

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->exchangedDocument->notes[0];
        self::assertEquals('This is a test note with detailed information', $resultModel->content);
        self::assertEquals('REG', $resultModel->subjectCode);
        self::assertEquals('AAI', $resultModel->contentCode);
    }

    public function testReferencedDocumentSerialization(): void
    {
        $model = ReferencedDocument::create('ORDER-2025-001');
        $model->uriid = Id::create('https://example.com/orders/2025-001', 'URI');
        $model->typeCode = '130';
        $model->name = 'Customer Order 2025-001';
        $model->lineId = '1';

        $model->attachmentBinaryObject = new BinaryObject();
        $model->attachmentBinaryObject->mimeCode = 'application/pdf';
        $model->attachmentBinaryObject->filename = 'order-2025-001.pdf';
        $model->attachmentBinaryObject->value = base64_encode('dummy pdf content');

        $model->formattedIssueDateTime = FormattedDateTime::create(102, '20250101');

        $invoice = $this->createMinimalInvoice();

        $lineItem = new SupplyChainTradeLineItem();
        $lineItem->associatedDocumentLineDocument = DocumentLineDocument::create('1');
        $lineItem->specifiedTradeProduct = new TradeProduct();
        $lineItem->specifiedTradeProduct->name = 'Test Product';
        $lineItem->tradeAgreement = new LineTradeAgreement();
        $lineItem->tradeAgreement->buyerOrderReferencedDocument = $model;
        $lineItem->delivery = new LineTradeDelivery();
        $lineItem->delivery->billedQuantity = Quantity::create('1', 'C62');
        $lineItem->specifiedLineTradeSettlement = new LineTradeSettlement();
        $lineItem->specifiedLineTradeSettlement->tradeTax[] = TradeTax::create(
            typeCode: 'VAT',
            categoryCode: 'S',
            rateApplicablePercent: '19.00'
        );
        $lineItem->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('100.00');

        $invoice->supplyChainTradeTransaction->lineItems[] = $lineItem;

        $sellerParty = new TradeParty();
        $sellerParty->name = 'Test Seller';
        $sellerParty->postalTradeAddress = new TradeAddress();
        $sellerParty->postalTradeAddress->countryCode = 'DE';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerParty;

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = new TradeSettlementHeaderMonetarySummation();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->lineTotalAmount = Amount::create('100.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxBasisTotalAmount[] = Amount::create('100.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxTotalAmount[] = Amount::create('19.00', 'EUR');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->grandTotalAmount[] = Amount::create('119.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->duePayableAmount = Amount::create('119.00');

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->lineItems[0]->tradeAgreement->buyerOrderReferencedDocument;

        self::assertNotNull($resultModel);
        self::assertEquals('ORDER-2025-001', $resultModel->issuerAssignedID->value);
        self::assertNotNull($resultModel->uriid);
        self::assertEquals('https://example.com/orders/2025-001', $resultModel->uriid->value);
        self::assertEquals('130', $resultModel->typeCode);
        self::assertEquals('Customer Order 2025-001', $resultModel->name);
        self::assertEquals('1', $resultModel->lineId);
        self::assertNotNull($resultModel->attachmentBinaryObject);
        self::assertEquals('application/pdf', $resultModel->attachmentBinaryObject->mimeCode);
        self::assertEquals('order-2025-001.pdf', $resultModel->attachmentBinaryObject->filename);
        self::assertNotNull($resultModel->formattedIssueDateTime);
        self::assertEquals('20250101', $resultModel->formattedIssueDateTime->dateTimeString->value);
    }

    public function testTradePriceSerialization(): void
    {
        $indicator = new Indicator();
        $indicator->indicator = false;

        $allowanceCharge = TradeAllowanceCharge::create(
            actualAmount: Amount::create('5.00'),
            indicator: $indicator,
            calculationPercent: '5.00',
            basisAmount: Amount::create('100.00'),
            reason: 'Volume discount'
        );

        $model = TradePrice::create(
            '95.00',
            Quantity::create('1', 'C62'),
            [$allowanceCharge]
        );

        $invoice = $this->createMinimalInvoice();

        $lineItem = new SupplyChainTradeLineItem();
        $lineItem->associatedDocumentLineDocument = DocumentLineDocument::create('1');
        $lineItem->specifiedTradeProduct = new TradeProduct();
        $lineItem->specifiedTradeProduct->name = 'Test Product';
        $lineItem->tradeAgreement = new LineTradeAgreement();
        $lineItem->tradeAgreement->netPrice = $model;
        $lineItem->delivery = new LineTradeDelivery();
        $lineItem->delivery->billedQuantity = Quantity::create('10', 'C62');
        $lineItem->specifiedLineTradeSettlement = new LineTradeSettlement();
        $lineItem->specifiedLineTradeSettlement->tradeTax[] = TradeTax::create(
            typeCode: 'VAT',
            categoryCode: 'S',
            rateApplicablePercent: '19.00'
        );
        $lineItem->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('950.00');

        $invoice->supplyChainTradeTransaction->lineItems[] = $lineItem;

        $sellerParty = new TradeParty();
        $sellerParty->name = 'Test Seller';
        $sellerParty->postalTradeAddress = new TradeAddress();
        $sellerParty->postalTradeAddress->countryCode = 'DE';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerParty;

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = new TradeSettlementHeaderMonetarySummation();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->lineTotalAmount = Amount::create('950.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxBasisTotalAmount[] = Amount::create('950.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxTotalAmount[] = Amount::create('180.50', 'EUR');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->grandTotalAmount[] = Amount::create('1130.50');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->duePayableAmount = Amount::create('1130.50');

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->lineItems[0]->tradeAgreement->netPrice;
        self::assertEquals('95.00', $resultModel->chargeAmount->value);
        self::assertNotNull($resultModel->basisQuantity);
        self::assertEquals('1', $resultModel->basisQuantity->value);
        self::assertEquals('C62', $resultModel->basisQuantity->unitCode);
        self::assertCount(1, $resultModel->appliedTradeAllowanceCharges);
        self::assertEquals('5.00', $resultModel->appliedTradeAllowanceCharges[0]->actualAmount->value);
    }

    public function testSupplyChainEventSerialization(): void
    {
        $model = new SupplyChainEvent();
        $model->date = DateTime::create(102, '20250115');

        $invoice = $this->createMinimalInvoice();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->chainEvent = $model;

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->applicableHeaderTradeDelivery->chainEvent;
        self::assertNotNull($resultModel);
        self::assertEquals('20250115', $resultModel->date->dateTimeString->value);
    }

    public function testFormattedDateTimeSerialization(): void
    {
        $model = FormattedDateTime::create(102, '20250115');

        $invoice = $this->createMinimalInvoice();

        $referencedDoc = ReferencedDocument::create('CONTRACT-2025');
        $referencedDoc->formattedIssueDateTime = $model;

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->contractReferencedDocument = $referencedDoc;

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $contractDoc = $deserialized->supplyChainTradeTransaction->applicableHeaderTradeAgreement->contractReferencedDocument;
        self::assertNotNull($contractDoc);
        $resultModel = $contractDoc->formattedIssueDateTime;
        self::assertNotNull($resultModel);
        self::assertEquals('20250115', $resultModel->dateTimeString->value);
        self::assertEquals(102, $resultModel->dateTimeString->format);
    }

    public function testBinaryObjectSerialization(): void
    {
        $model = new BinaryObject();
        $model->mimeCode = 'application/pdf';
        $model->filename = 'test-document.pdf';
        $model->value = base64_encode('This is a test PDF content');

        $invoice = $this->createMinimalInvoice();

        $referencedDoc = ReferencedDocument::create('ATTACHMENT-2025-001');
        $referencedDoc->attachmentBinaryObject = $model;

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->additionalReferencedDocuments[] = $referencedDoc;

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->applicableHeaderTradeAgreement->additionalReferencedDocuments[0]->attachmentBinaryObject;
        self::assertNotNull($resultModel);
        self::assertEquals('application/pdf', $resultModel->mimeCode);
        self::assertEquals('test-document.pdf', $resultModel->filename);
        self::assertEquals(base64_encode('This is a test PDF content'), $resultModel->value);
    }

    public function testTradeAccountingAccountSerialization(): void
    {
        $model = new TradeAccountingAccount();
        $model->id = Id::create('4000');
        $model->typeCode = 'Buyer';

        $invoice = $this->createMinimalInvoice();

        $lineItem = new SupplyChainTradeLineItem();
        $lineItem->associatedDocumentLineDocument = DocumentLineDocument::create('1');
        $lineItem->specifiedTradeProduct = new TradeProduct();
        $lineItem->specifiedTradeProduct->name = 'Test Product';
        $lineItem->tradeAgreement = new LineTradeAgreement();
        $lineItem->delivery = new LineTradeDelivery();
        $lineItem->delivery->billedQuantity = Quantity::create('1', 'C62');
        $lineItem->specifiedLineTradeSettlement = new LineTradeSettlement();
        $lineItem->specifiedLineTradeSettlement->tradeTax[] = TradeTax::create(
            typeCode: 'VAT',
            categoryCode: 'S',
            rateApplicablePercent: '19.00'
        );
        $lineItem->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('100.00');
        $lineItem->specifiedLineTradeSettlement->tradeAccountingAccount[] = $model;

        $invoice->supplyChainTradeTransaction->lineItems[] = $lineItem;

        $sellerParty = new TradeParty();
        $sellerParty->name = 'Test Seller';
        $sellerParty->postalTradeAddress = new TradeAddress();
        $sellerParty->postalTradeAddress->countryCode = 'DE';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerParty;

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = new TradeSettlementHeaderMonetarySummation();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->lineTotalAmount = Amount::create('100.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxBasisTotalAmount[] = Amount::create('100.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->taxTotalAmount[] = Amount::create('19.00', 'EUR');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->grandTotalAmount[] = Amount::create('119.00');
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation->duePayableAmount = Amount::create('119.00');

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->lineItems[0]->specifiedLineTradeSettlement->tradeAccountingAccount[0];
        self::assertEquals('4000', $resultModel->id->value);
        self::assertEquals('Buyer', $resultModel->typeCode);
    }

    public function testTradeDeliveryTermsSerialization(): void
    {
        $model = new TradeDeliveryTerms();
        $model->deliveryTypeCode = 'FOB';
        $model->description = 'Free on board, port of Hamburg';

        $invoice = $this->createMinimalInvoice();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->applicableTradeDeliveryTerms = $model;

        $xml = Builder::create()->transform($invoice);
        $deserialized = Reader::create()->transform($xml);

        $resultModel = $deserialized->supplyChainTradeTransaction->applicableHeaderTradeAgreement->applicableTradeDeliveryTerms;

        self::assertNotNull($resultModel);
        self::assertEquals('FOB', $resultModel->deliveryTypeCode);
        self::assertEquals('Free on board, port of Hamburg', $resultModel->description);
    }
}
