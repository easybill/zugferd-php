<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Tests;

use Easybill\ZUGFeRD2\Builder;
use Easybill\ZUGFeRD2\Model\AdvancePayment;
use Easybill\ZUGFeRD2\Model\Amount;
use Easybill\ZUGFeRD2\Model\ClassCode;
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
use Easybill\ZUGFeRD2\Model\LegalOrganization;
use Easybill\ZUGFeRD2\Model\LineTradeAgreement;
use Easybill\ZUGFeRD2\Model\LineTradeDelivery;
use Easybill\ZUGFeRD2\Model\LineTradeSettlement;
use Easybill\ZUGFeRD2\Model\LogisticsServiceCharge;
use Easybill\ZUGFeRD2\Model\LogisticsTransportMovement;
use Easybill\ZUGFeRD2\Model\Note;
use Easybill\ZUGFeRD2\Model\ProcuringProject;
use Easybill\ZUGFeRD2\Model\ProductCharacteristic;
use Easybill\ZUGFeRD2\Model\ProductClassification;
use Easybill\ZUGFeRD2\Model\Quantity;
use Easybill\ZUGFeRD2\Model\ReferencedDocument;
use Easybill\ZUGFeRD2\Model\ReferencedProduct;
use Easybill\ZUGFeRD2\Model\SpecifiedPeriod;
use Easybill\ZUGFeRD2\Model\SupplyChainConsignment;
use Easybill\ZUGFeRD2\Model\SupplyChainEvent;
use Easybill\ZUGFeRD2\Model\SupplyChainTradeLineItem;
use Easybill\ZUGFeRD2\Model\SupplyChainTradeTransaction;
use Easybill\ZUGFeRD2\Model\TaxRegistration;
use Easybill\ZUGFeRD2\Model\TradeAccountingAccount;
use Easybill\ZUGFeRD2\Model\TradeAddress;
use Easybill\ZUGFeRD2\Model\TradeAllowanceCharge;
use Easybill\ZUGFeRD2\Model\TradeContact;
use Easybill\ZUGFeRD2\Model\TradeCountry;
use Easybill\ZUGFeRD2\Model\TradeCurrencyExchange;
use Easybill\ZUGFeRD2\Model\TradeDeliveryTerms;
use Easybill\ZUGFeRD2\Model\TradeParty;
use Easybill\ZUGFeRD2\Model\TradePaymentTerms;
use Easybill\ZUGFeRD2\Model\TradePrice;
use Easybill\ZUGFeRD2\Model\TradeProduct;
use Easybill\ZUGFeRD2\Model\TradeSettlementHeaderMonetarySummation;
use Easybill\ZUGFeRD2\Model\TradeSettlementLineMonetarySummation;
use Easybill\ZUGFeRD2\Model\TradeSettlementPaymentMeans;
use Easybill\ZUGFeRD2\Model\TradeTax;
use Easybill\ZUGFeRD2\Model\UniversalCommunication;
use Easybill\ZUGFeRD2\Tests\Traits\AssertXmlOutputTrait;
use Easybill\ZUGFeRD2\Validator;
use PHPUnit\Framework\TestCase;

final class ProfileExtendedTest extends TestCase
{
    use AssertXmlOutputTrait;

    public function testBuildExtendedInnergemeinschLieferungMehrereBestellungen(): void
    {
        $invoice = new CrossIndustryInvoice();
        $invoice->exchangedDocumentContext = new ExchangedDocumentContext();

        $invoice->exchangedDocumentContext->businessProcessSpecifiedDocumentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->businessProcessSpecifiedDocumentContextParameter->id = 'Beispielgeschäftsprozess';

        $invoice->exchangedDocumentContext->documentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->documentContextParameter->id = Builder::GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_EXTENDED;

        $invoice->exchangedDocument = new ExchangedDocument();
        $invoice->exchangedDocument->id = '47110818';
        $invoice->exchangedDocument->typeCode = '380';
        $invoice->exchangedDocument->issueDateTime = DateTime::create(102, '20181031');

        $invoice->exchangedDocument->notes[] = Note::create('Mitglieder der Geschäftsleitung:
                Geschäftsführerin: Johanna Musterfrau
                Prokuristin: Isabell Herrlich
                HRB Berlin 13086', 'REG');

        $invoice->supplyChainTradeTransaction = new SupplyChainTradeTransaction();

        $invoice->supplyChainTradeTransaction->lineItems[] = $item1 = new SupplyChainTradeLineItem();
        $item1->associatedDocumentLineDocument = DocumentLineDocument::create('1');
        $item1->specifiedTradeProduct = new TradeProduct();
        $item1->specifiedTradeProduct->sellerAssignedID = 'CO-123/V2A';
        $item1->specifiedTradeProduct->buyerAssignedID = 'Toolbox 0815';
        $item1->specifiedTradeProduct->name = 'Windschutzscheibe';
        $item1->specifiedTradeProduct->tradeCountry = TradeCountry::create('DE');

        $item1->tradeAgreement = new LineTradeAgreement();
        $item1->tradeAgreement->buyerOrderReferencedDocument = ReferencedDocument::create('ORDER84359');
        $item1->tradeAgreement->buyerOrderReferencedDocument->lineId = '1';

        $item1->tradeAgreement->grossPrice = TradePrice::create('100', Quantity::create('1', 'H87'));
        $item1->tradeAgreement->netPrice = TradePrice::create('100', Quantity::create('1', 'H87'));

        $item1->delivery = new LineTradeDelivery();
        $item1->delivery->billedQuantity = Quantity::create('10', 'H87');

        $item1->specifiedLineTradeSettlement = new LineTradeSettlement();
        $item1->specifiedLineTradeSettlement->tradeTax[] = $item1Tax = new TradeTax();
        $item1Tax->typeCode = 'VAT';
        $item1Tax->exemptionReason = 'Kein Ausweis der Umsatzsteuer bei innergemeinschaftlichen Lieferungen';
        $item1Tax->categoryCode = 'K';
        $item1Tax->rateApplicablePercent = '0';
        $item1->specifiedLineTradeSettlement->billingSpecifiedPeriod = $item1Period = new SpecifiedPeriod();
        $item1Period->startDateTime = DateTime::create(102, '20181001');
        $item1Period->endDateTime = DateTime::create(102, '20181031');

        $item1->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('1000');

        $invoice->supplyChainTradeTransaction->lineItems[] = $item2 = new SupplyChainTradeLineItem();
        $item2->associatedDocumentLineDocument = DocumentLineDocument::create('2');
        $item2->specifiedTradeProduct = new TradeProduct();
        $item2->specifiedTradeProduct->sellerAssignedID = 'IM-712/A2A';
        $item2->specifiedTradeProduct->buyerAssignedID = 'BR-4529-ZF';
        $item2->specifiedTradeProduct->name = 'Stoßfänger';
        $item2->specifiedTradeProduct->tradeCountry = TradeCountry::create('DE');

        $item2->tradeAgreement = new LineTradeAgreement();
        $item2->tradeAgreement->buyerOrderReferencedDocument = ReferencedDocument::create('ORDER84753');
        $item2->tradeAgreement->buyerOrderReferencedDocument->lineId = '7';

        $item2->tradeAgreement->grossPrice = TradePrice::create('100', Quantity::create('1', 'H87'));
        $item2->tradeAgreement->netPrice = TradePrice::create('100', Quantity::create('1', 'H87'));

        $item2->delivery = new LineTradeDelivery();
        $item2->delivery->billedQuantity = Quantity::create('10', 'H87');

        $item2->specifiedLineTradeSettlement = new LineTradeSettlement();
        $item2->specifiedLineTradeSettlement->tradeTax[] = $item2Tax = new TradeTax();
        $item2Tax->typeCode = 'VAT';
        $item2Tax->exemptionReason = 'Kein Ausweis der Umsatzsteuer bei innergemeinschaftlichen Lieferungen';
        $item2Tax->categoryCode = 'K';
        $item2Tax->rateApplicablePercent = '0';

        $item2->specifiedLineTradeSettlement->billingSpecifiedPeriod = $item2Period = new SpecifiedPeriod();
        $item2Period->startDateTime = DateTime::create(102, '20181001');
        $item2Period->endDateTime = DateTime::create(102, '20181031');

        $item2->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('1000');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement = new HeaderTradeAgreement();

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerTradeParty = new TradeParty();
        $sellerTradeParty->id[] = Id::create('12345676');
        $sellerTradeParty->name = 'Global Supplies Ltd.  ';
        $sellerTradeParty->postalTradeAddress = $sellerPostalAddress = new TradeAddress();
        $sellerPostalAddress->postcodeCode = 'SW1B 3BN';
        $sellerPostalAddress->lineOne = '153 Victoria Street';
        $sellerPostalAddress->cityName = 'London';
        $sellerPostalAddress->countryID = 'GB';

        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('GB999999999', 'VA');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerTradeParty = $buyerTradeParty = new TradeParty();
        $buyerTradeParty->id[] = Id::create('75969813');
        $buyerTradeParty->name = 'Metallbau Leipzig GmbH & Co. KG';

        $buyerTradeParty->postalTradeAddress = new TradeAddress();
        $buyerTradeParty->postalTradeAddress->postcodeCode = '12345';
        $buyerTradeParty->postalTradeAddress->lineOne = 'Pappelallee 15';
        $buyerTradeParty->postalTradeAddress->lineTwo = 'Hof 3';
        $buyerTradeParty->postalTradeAddress->cityName = 'Leipzig';
        $buyerTradeParty->postalTradeAddress->countryID = 'DE';

        $buyerTradeParty->uriUniversalCommunication = $universalCommunication = new UniversalCommunication();
        $universalCommunication->uriid = Id::create('04 0 11 000 - 12345 12345 - 35', '9958');

        $buyerTradeParty->taxRegistrations[] = TaxRegistration::create('DE123456789', 'VA');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTaxRepresentativeTradeParty = $sellerTaxTradeParty = new TradeParty();
        $sellerTaxTradeParty->name = 'Global Supplies Financial Services';
        $sellerTaxTradeParty->postalTradeAddress = $sellerTaxAddress = new TradeAddress();
        $sellerTaxAddress->postcodeCode = '12345';
        $sellerTaxAddress->lineOne = 'Friedrichstraße 165';
        $sellerTaxAddress->cityName = 'Berlin';
        $sellerTaxAddress->countryID = 'DE';
        $sellerTaxTradeParty->taxRegistrations[] = TaxRegistration::create('DE987654321', 'VA');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery = new HeaderTradeDelivery();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->shipToTradeParty = $shipToTradeParty = new TradeParty();
        $shipToTradeParty->id[] = Id::create('75969815');
        $shipToTradeParty->name = 'Metallbau Leipzig GmbH & Co. KG';
        $shipToTradeParty->uriUniversalCommunication = $shipToUniversalCommunication = new UniversalCommunication();
        $shipToUniversalCommunication->uriid = Id::create('999999999', '0060');
        $shipToTradeParty->postalTradeAddress = new TradeAddress();
        $shipToTradeParty->postalTradeAddress->postcodeCode = '12347';
        $shipToTradeParty->postalTradeAddress->lineOne = 'Eichenpromenade 37';
        $shipToTradeParty->postalTradeAddress->lineTwo = 'Tor 1';
        $shipToTradeParty->postalTradeAddress->cityName = 'Metallstadt';
        $shipToTradeParty->postalTradeAddress->countryID = 'DE';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement = new HeaderTradeSettlement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->invoiceCurrencyCode = 'EUR';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->payeeTradeParty = $payeeTradeParty = new TradeParty();
        $payeeTradeParty->globalID[] = Id::create('432156789', '0060');
        $payeeTradeParty->name = 'Global Supplies Financial Services';
        $payeeTradeParty->postalTradeAddress = new TradeAddress();
        $payeeTradeParty->postalTradeAddress->postcodeCode = '12345';
        $payeeTradeParty->postalTradeAddress->lineOne = 'Friedrichstraße 165';
        $payeeTradeParty->postalTradeAddress->cityName = 'Berlin';
        $payeeTradeParty->postalTradeAddress->countryID = 'DE';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementPaymentMeans[] = $paymentMeans1 = new TradeSettlementPaymentMeans();
        $paymentMeans1->typeCode = '58';
        $paymentMeans1->payeePartyCreditorFinancialAccount = new CreditorFinancialAccount();
        $paymentMeans1->payeePartyCreditorFinancialAccount->ibanId = Id::create('DE12 1234 4321 9876 00');
        $paymentMeans1->payeePartyCreditorFinancialAccount->accountName = 'Global Supplies Financial Services';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->tradeTaxes[] = $headerTax1 = new TradeTax();
        $headerTax1->typeCode = 'VAT';
        $headerTax1->exemptionReason = 'Kein Ausweis der Umsatzsteuer bei innergemeinschaftlichen Lieferungen';
        $headerTax1->categoryCode = 'K';
        $headerTax1->basisAmount = Amount::create('2000');
        $headerTax1->calculatedAmount = Amount::create('0');
        $headerTax1->rateApplicablePercent = '0';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->billingSpecifiedPeriod = $billingPeriod = new SpecifiedPeriod();
        $billingPeriod->startDateTime = DateTime::create(102, '20181001');
        $billingPeriod->endDateTime = DateTime::create(102, '20181031');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradePaymentTerms[] = $paymentTerms = new TradePaymentTerms();
        $paymentTerms->dueDateDateTime = DateTime::create(102, '20181130');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = $summation = new TradeSettlementHeaderMonetarySummation();
        $summation->lineTotalAmount = Amount::create('2000.00');
        $summation->taxBasisTotalAmount[] = Amount::create('2000.00');
        $summation->taxTotalAmount[] = Amount::create('0.00', 'EUR');
        $summation->grandTotalAmount[] = Amount::create('2000.00');
        $summation->duePayableAmount = Amount::create('2000.00');

        $this->buildAndAssertXmlFromCII(
            $invoice,
            __DIR__ . '/Examples/EXTENDED/EXTENDED_InnergemeinschLieferungMehrereBestellungen.xml',
            Validator::SCHEMA_EXTENDED
        );
    }

    public function testExtendedAllFields(): void
    {
        $invoice = new CrossIndustryInvoice();

        $invoice->exchangedDocumentContext = new ExchangedDocumentContext();
        $invoice->exchangedDocumentContext->testIndicator = new Indicator();
        $invoice->exchangedDocumentContext->testIndicator->indicator = false;

        $invoice->exchangedDocumentContext->businessProcessSpecifiedDocumentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->businessProcessSpecifiedDocumentContextParameter->id = 'urn:fdc:peppol.eu:2017:poacc:billing:01:1.0';

        $invoice->exchangedDocumentContext->documentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->documentContextParameter->id = Builder::GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_EXTENDED;

        $invoice->exchangedDocument = new ExchangedDocument();
        $invoice->exchangedDocument->id = 'INVOICE-2025-001';
        $invoice->exchangedDocument->name = 'Comprehensive Test Invoice';
        $invoice->exchangedDocument->typeCode = '380';
        $invoice->exchangedDocument->issueDateTime = DateTime::create(102, '20250114');
        $invoice->exchangedDocument->notes[] = Note::create('This is a comprehensive test invoice covering all fields', 'AAI');
        $invoice->exchangedDocument->notes[] = Note::create('Legal note: This is for testing purposes only', 'REG');
        $invoice->exchangedDocument->notes[] = Note::create('Payment terms: Net 30 days', 'PMT');

        $invoice->supplyChainTradeTransaction = new SupplyChainTradeTransaction();

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement = new HeaderTradeAgreement();
        $agreement = $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement;
        $agreement->buyerReference = 'BUYER-REF-12345';

        $agreement->sellerTradeParty = new TradeParty();
        $seller = $agreement->sellerTradeParty;
        $seller->id[] = Id::create('SELLER-123');
        $seller->globalID[] = Id::create('4000001234567', '0088');
        $seller->name = 'Comprehensive Seller GmbH';
        $seller->specifiedLegalOrganization = new LegalOrganization();
        $seller->specifiedLegalOrganization->id = Id::create('HRB12345');
        $seller->specifiedLegalOrganization->tradingBusinessName = 'Comprehensive Seller Trading';
        $seller->specifiedLegalOrganization->postalTradeAddress = new TradeAddress();
        $seller->specifiedLegalOrganization->postalTradeAddress->postcodeCode = '10115';
        $seller->specifiedLegalOrganization->postalTradeAddress->lineOne = 'Legal Address 1';
        $seller->specifiedLegalOrganization->postalTradeAddress->cityName = 'Berlin';
        $seller->specifiedLegalOrganization->postalTradeAddress->countryID = 'DE';

        $seller->definedTradeContact = new TradeContact();
        $seller->definedTradeContact->personName = 'Max Mustermann';
        $seller->definedTradeContact->departmentName = 'Sales Department';
        $seller->definedTradeContact->telephoneUniversalCommunication = new UniversalCommunication();
        $seller->definedTradeContact->telephoneUniversalCommunication->completeNumber = '+49 30 12345678';
        $seller->definedTradeContact->faxUniversalCommunication = new UniversalCommunication();
        $seller->definedTradeContact->faxUniversalCommunication->completeNumber = '+49 30 12345679';
        $seller->definedTradeContact->emailURIUniversalCommunication = new UniversalCommunication();
        $seller->definedTradeContact->emailURIUniversalCommunication->uriid = Id::create('max.mustermann@seller.example', 'SMTP');

        $seller->postalTradeAddress = new TradeAddress();
        $seller->postalTradeAddress->postcodeCode = '10115';
        $seller->postalTradeAddress->lineOne = 'Musterstraße 123';
        $seller->postalTradeAddress->lineTwo = 'Building A';
        $seller->postalTradeAddress->lineThree = 'Floor 3';
        $seller->postalTradeAddress->cityName = 'Berlin';
        $seller->postalTradeAddress->countryID = 'DE';
        $seller->postalTradeAddress->countrySubDivisionName = 'Berlin';

        $seller->taxRegistrations[] = TaxRegistration::create('DE123456789', 'VA');
        $seller->taxRegistrations[] = TaxRegistration::create('201/234/56789', 'FC');

        $seller->uriUniversalCommunication = new UniversalCommunication();
        $seller->uriUniversalCommunication->uriid = Id::create('seller@company.example', 'EM');

        $agreement->buyerTradeParty = new TradeParty();
        $buyer = $agreement->buyerTradeParty;
        $buyer->id[] = Id::create('BUYER-456');
        $buyer->globalID[] = Id::create('4000007654321', '0088');
        $buyer->name = 'Comprehensive Buyer AG';

        $buyer->specifiedLegalOrganization = new LegalOrganization();
        $buyer->specifiedLegalOrganization->id = Id::create('HRB54321');
        $buyer->specifiedLegalOrganization->tradingBusinessName = 'Buyer Trading Division';

        $buyer->definedTradeContact = new TradeContact();
        $buyer->definedTradeContact->personName = 'Erika Mustermann';
        $buyer->definedTradeContact->departmentName = 'Procurement Department';
        $buyer->definedTradeContact->telephoneUniversalCommunication = new UniversalCommunication();
        $buyer->definedTradeContact->telephoneUniversalCommunication->completeNumber = '+49 40 98765432';
        $buyer->definedTradeContact->emailURIUniversalCommunication = new UniversalCommunication();
        $buyer->definedTradeContact->emailURIUniversalCommunication->uriid = Id::create('erika.mustermann@buyer.example', 'SMTP');

        $buyer->postalTradeAddress = new TradeAddress();
        $buyer->postalTradeAddress->postcodeCode = '20095';
        $buyer->postalTradeAddress->lineOne = 'Käuferweg 456';
        $buyer->postalTradeAddress->lineTwo = 'Eingang B';
        $buyer->postalTradeAddress->lineThree = '2. OG';
        $buyer->postalTradeAddress->cityName = 'Hamburg';
        $buyer->postalTradeAddress->countryID = 'DE';
        $buyer->postalTradeAddress->countrySubDivisionName = 'Hamburg';

        $buyer->taxRegistrations[] = TaxRegistration::create('DE987654321', 'VA');

        $buyer->uriUniversalCommunication = new UniversalCommunication();
        $buyer->uriUniversalCommunication->uriid = Id::create('buyer@company.example', 'EM');

        $agreement->sellerTaxRepresentativeTradeParty = new TradeParty();
        $sellerTaxRep = $agreement->sellerTaxRepresentativeTradeParty;
        $sellerTaxRep->name = 'Seller Tax Representative GmbH';
        $sellerTaxRep->postalTradeAddress = new TradeAddress();
        $sellerTaxRep->postalTradeAddress->postcodeCode = '60311';
        $sellerTaxRep->postalTradeAddress->lineOne = 'Steuerstraße 789';
        $sellerTaxRep->postalTradeAddress->cityName = 'Frankfurt';
        $sellerTaxRep->postalTradeAddress->countryID = 'DE';
        $sellerTaxRep->taxRegistrations[] = TaxRegistration::create('DE111222333', 'VA');

        $agreement->applicableTradeDeliveryTerms = new TradeDeliveryTerms();
        $agreement->applicableTradeDeliveryTerms->deliveryTypeCode = 'EXW';

        $agreement->buyerOrderReferencedDocument = ReferencedDocument::create('PO-2025-001');
        $agreement->buyerOrderReferencedDocument->typeCode = '220';
        $agreement->buyerOrderReferencedDocument->name = 'Purchase Order 2025-001';

        $agreement->contractReferencedDocument = ReferencedDocument::create('CONTRACT-2024-500');
        $agreement->contractReferencedDocument->typeCode = '830';
        $agreement->contractReferencedDocument->name = 'Master Service Agreement 2024';

        $additionalDoc1 = ReferencedDocument::create('ADD-DOC-001');
        $additionalDoc1->typeCode = '916';
        $additionalDoc1->name = 'Delivery Note';
        $agreement->additionalReferencedDocuments[] = $additionalDoc1;

        $additionalDoc2 = ReferencedDocument::create('ADD-DOC-002');
        $additionalDoc2->typeCode = '50';
        $additionalDoc2->name = 'Price List';
        $agreement->additionalReferencedDocuments[] = $additionalDoc2;

        $agreement->specifiedProcuringProject = ProcuringProject::create('PROJECT-2025-A', 'Infrastructure Upgrade Project');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery = new HeaderTradeDelivery();

        $delivery = $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery;
        $delivery->relatedSupplyChainConsignment = new SupplyChainConsignment();

        $transport1 = new LogisticsTransportMovement();
        $transport1->modeCode = '30';

        $delivery->relatedSupplyChainConsignment->specifiedLogisticsTransportMovement[] = $transport1;

        $delivery->shipToTradeParty = new TradeParty();
        $shipTo = $delivery->shipToTradeParty;
        $shipTo->id[] = Id::create('SHIPTO-789');
        $shipTo->name = 'Shipping Destination Warehouse';
        $shipTo->postalTradeAddress = new TradeAddress();
        $shipTo->postalTradeAddress->postcodeCode = '50667';
        $shipTo->postalTradeAddress->lineOne = 'Lagerstraße 999';
        $shipTo->postalTradeAddress->cityName = 'Köln';
        $shipTo->postalTradeAddress->countryID = 'DE';
        $shipTo->uriUniversalCommunication = new UniversalCommunication();
        $shipTo->uriUniversalCommunication->completeNumber = '+49 221 555666';

        $delivery->actualDeliverySupplyChainEvent = new SupplyChainEvent();
        $delivery->actualDeliverySupplyChainEvent->occurrenceDateTime = DateTime::create(102, '20250110');

        $delivery->deliveryNoteReferencedDocument = ReferencedDocument::create('DN-2025-001');
        $delivery->deliveryNoteReferencedDocument->typeCode = '270';
        $delivery->deliveryNoteReferencedDocument->name = 'Delivery Note 001';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement = new HeaderTradeSettlement();
        $settlement = $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement;

        $settlement->creditorReferenceID = 'CREDITOR-REF-999';
        $settlement->paymentReference = 'PAYMENT-REF-888';
        $settlement->invoiceCurrencyCode = 'EUR';
        $settlement->taxCurrencyCode = 'EUR';

        $settlement->invoiceeTradeParty = new TradeParty();
        $invoicee = $settlement->invoiceeTradeParty;
        $invoicee->id[] = Id::create('INVOICEE-111');
        $invoicee->name = 'Invoicee Party GmbH';
        $invoicee->postalTradeAddress = new TradeAddress();
        $invoicee->postalTradeAddress->postcodeCode = '70173';
        $invoicee->postalTradeAddress->lineOne = 'Rechnungsweg 123';
        $invoicee->postalTradeAddress->cityName = 'Stuttgart';
        $invoicee->postalTradeAddress->countryID = 'DE';

        $settlement->payeeTradeParty = new TradeParty();
        $payee = $settlement->payeeTradeParty;
        $payee->globalID[] = Id::create('4000009999999', '0088');
        $payee->name = 'Payment Receiver Financial Services GmbH';
        $payee->postalTradeAddress = new TradeAddress();
        $payee->postalTradeAddress->postcodeCode = '60311';
        $payee->postalTradeAddress->lineOne = 'Bankstraße 456';
        $payee->postalTradeAddress->cityName = 'Frankfurt';
        $payee->postalTradeAddress->countryID = 'DE';

        $currencyExchange = new TradeCurrencyExchange();
        $currencyExchange->sourceCurrencyCode = 'EUR';
        $currencyExchange->targetCurrencyCode = 'USD';
        $currencyExchange->conversionRate = 1.0852;
        $currencyExchange->conversionRateDateTime = DateTime::create(102, '20250114');
        $settlement->taxApplicableTradeCurrencyExchange[] = $currencyExchange;

        $paymentMeans = new TradeSettlementPaymentMeans();
        $paymentMeans->typeCode = '58';
        $paymentMeans->information = 'Payment by bank transfer';
        $paymentMeans->payeePartyCreditorFinancialAccount = new CreditorFinancialAccount();
        $paymentMeans->payeePartyCreditorFinancialAccount->ibanId = Id::create('DE89370400440532013000');
        $paymentMeans->payeePartyCreditorFinancialAccount->accountName = 'Comprehensive Seller GmbH';
        $paymentMeans->payeeSpecifiedCreditorFinancialInstitution = new CreditorFinancialInstitution();
        $paymentMeans->payeeSpecifiedCreditorFinancialInstitution->bicId = Id::create('COBADEFFXXX');
        $settlement->specifiedTradeSettlementPaymentMeans[] = $paymentMeans;

        $tax1 = new TradeTax();
        $tax1->typeCode = 'VAT';
        $tax1->categoryCode = 'S';
        $tax1->basisAmount = Amount::create('5000.00');
        $tax1->calculatedAmount = Amount::create('950.00');
        $tax1->rateApplicablePercent = '19.00';
        $settlement->tradeTaxes[] = $tax1;

        $tax2 = new TradeTax();
        $tax2->typeCode = 'VAT';
        $tax2->categoryCode = 'S';
        $tax2->basisAmount = Amount::create('2000.00');
        $tax2->calculatedAmount = Amount::create('140.00');
        $tax2->rateApplicablePercent = '7.00';
        $settlement->tradeTaxes[] = $tax2;

        $settlement->billingSpecifiedPeriod = new SpecifiedPeriod();
        $settlement->billingSpecifiedPeriod->startDateTime = DateTime::create(102, '20250101');
        $settlement->billingSpecifiedPeriod->endDateTime = DateTime::create(102, '20250131');

        $allowance = new TradeAllowanceCharge();
        $allowance->indicator = new Indicator();
        $allowance->indicator->indicator = false;
        $allowance->actualAmount = Amount::create('200.00');
        $allowance->reason = 'Volume discount';
        $allowance->reasonCode = '95';
        $allowance->calculationPercent = '2.00';
        $allowance->basisAmount = Amount::create('10000.00');
        $allowanceTax = new TradeTax();
        $allowanceTax->typeCode = 'VAT';
        $allowanceTax->categoryCode = 'S';
        $allowanceTax->rateApplicablePercent = '19.00';
        $allowance->tradeTax[] = $allowanceTax;
        $settlement->specifiedTradeAllowanceCharge[] = $allowance;

        $charge = new TradeAllowanceCharge();
        $charge->indicator = new Indicator();
        $charge->indicator->indicator = true;
        $charge->actualAmount = Amount::create('50.00');
        $charge->reason = 'Small order surcharge';
        $charge->reasonCode = 'AEO';
        $settlement->specifiedTradeAllowanceCharge[] = $charge;

        $serviceCharge = new LogisticsServiceCharge();
        $serviceCharge->description = 'Express shipping';
        $serviceCharge->appliedAmount = Amount::create('100.00');
        $serviceTax = new TradeTax();
        $serviceTax->typeCode = 'VAT';
        $serviceTax->categoryCode = 'S';
        $serviceTax->rateApplicablePercent = '19.00';
        $serviceCharge->tradeTaxes[] = $serviceTax;
        $settlement->specifiedLogisticsServiceCharge[] = $serviceCharge;

        $paymentTerms = new TradePaymentTerms();
        $paymentTerms->description = 'Payment within 30 days with 2% discount within 10 days';
        $paymentTerms->dueDateDateTime = DateTime::create(102, '20250213');
        $paymentTerms->directDebitMandateID = Id::create('MANDATE-2025-001');
        $settlement->specifiedTradePaymentTerms[] = $paymentTerms;

        $settlement->invoiceReferencedDocument = ReferencedDocument::create('PREV-INV-2024-999');
        $settlement->invoiceReferencedDocument->typeCode = '381';
        $settlement->invoiceReferencedDocument->name = 'Previous Invoice';

        $accountingAccount = new TradeAccountingAccount();
        $accountingAccount->id = Id::create('8400');
        $accountingAccount->typeCode = 'Account';
        $settlement->receivableSpecifiedTradeAccountingAccount[] = $accountingAccount;

        $advancePayment = new AdvancePayment();
        $advancePayment->paidAmount = Amount::create('1000.00');
        $advancePayment->formattedReceivedDateTime = FormattedDateTime::create(102, '20250105');
        $advancePaymentTax = new TradeTax();
        $advancePaymentTax->typeCode = 'VAT';
        $advancePaymentTax->categoryCode = 'S';
        $advancePaymentTax->rateApplicablePercent = '19.00';
        $advancePayment->includedTradeTax[] = $advancePaymentTax;
        $settlement->specifiedAdvancePayment[] = $advancePayment;

        $summation = new TradeSettlementHeaderMonetarySummation();
        $summation->lineTotalAmount = Amount::create('7150.00');
        $summation->chargeTotalAmount = Amount::create('150.00');
        $summation->allowanceTotalAmount = Amount::create('200.00');
        $summation->taxBasisTotalAmount[] = Amount::create('7100.00');
        $summation->taxTotalAmount[] = Amount::create('1090.00', 'EUR');
        $summation->roundingAmount = Amount::create('0.00');
        $summation->grandTotalAmount[] = Amount::create('8190.00');
        $summation->totalPrepaidAmount = Amount::create('1000.00');
        $summation->duePayableAmount = Amount::create('7190.00');
        $settlement->specifiedTradeSettlementHeaderMonetarySummation = $summation;

        $item1 = new SupplyChainTradeLineItem();
        $item1->associatedDocumentLineDocument = DocumentLineDocument::create('1');
        $item1->specifiedTradeProduct = new TradeProduct();

        $product1 = $item1->specifiedTradeProduct;
        $product1->globalID = Id::create('4012345678901', '0160');
        $product1->sellerAssignedID = 'PROD-001-SELLER';
        $product1->buyerAssignedID = 'PROD-001-BUYER';
        $product1->name = 'Premium Widget Type A';
        $product1->tradeCountry = TradeCountry::create('DE');

        $characteristic1 = new ProductCharacteristic();
        $characteristic1->description = 'Color: Blue';
        $characteristic1->value = 'RAL5010';
        $product1->applicableProductCharacteristic[] = $characteristic1;

        $characteristic2 = new ProductCharacteristic();
        $characteristic2->description = 'Material: Steel';
        $characteristic2->value = 'ST37';
        $product1->applicableProductCharacteristic[] = $characteristic2;

        $classification = new ProductClassification();
        $classification->classCode = ClassCode::create('12345678', '9');
        $product1->designatedProductClassification = $classification;

        $referencedProduct1 = new ReferencedProduct();
        $referencedProduct1->globalID[] = Id::create('4012345000001', '0160');
        $referencedProduct1->name = 'Base Component A';

        $referencedProduct1->unitQuantity = Quantity::create('2', 'C62');
        $product1->includedReferencedProduct[] = $referencedProduct1;

        $item1->tradeAgreement = new LineTradeAgreement();
        $item1->tradeAgreement->buyerOrderReferencedDocument = ReferencedDocument::create('PO-2025-001');
        $item1->tradeAgreement->buyerOrderReferencedDocument->lineId = '10';
        $item1->tradeAgreement->grossPrice = TradePrice::create('52.63', Quantity::create('1', 'C62'));
        $item1->tradeAgreement->netPrice = TradePrice::create('50.00', Quantity::create('1', 'C62'));

        $item1->delivery = new LineTradeDelivery();
        $item1->delivery->billedQuantity = Quantity::create('100', 'C62');
        $item1->delivery->chargeFreeQuantity = Quantity::create('5', 'C62');
        $item1->delivery->packageQuantity = Quantity::create('10', 'PK');

        $item1->delivery->shipToTradeParty = new TradeParty();
        $item1->delivery->shipToTradeParty->name = 'Item 1 Delivery Location';
        $item1->delivery->shipToTradeParty->postalTradeAddress = new TradeAddress();
        $item1->delivery->shipToTradeParty->postalTradeAddress->postcodeCode = '12345';
        $item1->delivery->shipToTradeParty->postalTradeAddress->lineOne = 'Warehouse A';
        $item1->delivery->shipToTradeParty->postalTradeAddress->cityName = 'Berlin';
        $item1->delivery->shipToTradeParty->postalTradeAddress->countryID = 'DE';

        $item1->delivery->ultimateShipToTradeParty = new TradeParty();
        $item1->delivery->ultimateShipToTradeParty->name = 'Final Destination Party';
        $item1->delivery->ultimateShipToTradeParty->postalTradeAddress = new TradeAddress();
        $item1->delivery->ultimateShipToTradeParty->postalTradeAddress->postcodeCode = '67890';
        $item1->delivery->ultimateShipToTradeParty->postalTradeAddress->lineOne = 'End User Location';
        $item1->delivery->ultimateShipToTradeParty->postalTradeAddress->cityName = 'München';
        $item1->delivery->ultimateShipToTradeParty->postalTradeAddress->countryID = 'DE';

        $item1->delivery->actualDeliverySupplyChainEvent = new SupplyChainEvent();
        $item1->delivery->actualDeliverySupplyChainEvent->occurrenceDateTime = DateTime::create(102, '20250108');
        $item1->delivery->receivingAdviceReferencedDocument = ReferencedDocument::create('RA-LINE-001');
        $item1->delivery->deliveryNoteReferencedDocument = ReferencedDocument::create('DN-LINE-001');
        $item1->specifiedLineTradeSettlement = new LineTradeSettlement();
        $lineSettlement1 = $item1->specifiedLineTradeSettlement;

        $lineTax1 = new TradeTax();
        $lineTax1->typeCode = 'VAT';
        $lineTax1->categoryCode = 'S';
        $lineTax1->rateApplicablePercent = '19.00';
        $lineSettlement1->tradeTax[] = $lineTax1;

        $lineAllowance1 = new TradeAllowanceCharge();
        $lineAllowance1->indicator = new Indicator();
        $lineAllowance1->indicator->indicator = false;
        $lineAllowance1->actualAmount = Amount::create('100.00');
        $lineAllowance1->reason = 'Line item discount';
        $lineSettlement1->specifiedTradeAllowanceCharge[] = $lineAllowance1;

        $lineSettlement1->billingSpecifiedPeriod = new SpecifiedPeriod();
        $lineSettlement1->billingSpecifiedPeriod->startDateTime = DateTime::create(102, '20250101');
        $lineSettlement1->billingSpecifiedPeriod->endDateTime = DateTime::create(102, '20250110');

        $lineSettlement1->monetarySummation = TradeSettlementLineMonetarySummation::create('5000.00');

        $lineAccount1 = new TradeAccountingAccount();
        $lineAccount1->id = Id::create('8400');
        $lineAccount1->typeCode = 'Sales';
        $lineSettlement1->tradeAccountingAccount[] = $lineAccount1;

        $invoice->supplyChainTradeTransaction->lineItems[] = $item1;

        $item2 = new SupplyChainTradeLineItem();
        $item2->associatedDocumentLineDocument = DocumentLineDocument::create('2');

        $item2->specifiedTradeProduct = new TradeProduct();
        $product2 = $item2->specifiedTradeProduct;
        $product2->globalID = Id::create('4098765432109', '0160');
        $product2->sellerAssignedID = 'PROD-002-SELLER';
        $product2->buyerAssignedID = 'PROD-002-BUYER';
        $product2->name = 'Standard Service Package';

        $product2->tradeCountry = TradeCountry::create('DE');

        $item2->tradeAgreement = new LineTradeAgreement();
        $item2->tradeAgreement->grossPrice = TradePrice::create('21.40', Quantity::create('1', 'HUR'));
        $item2->tradeAgreement->netPrice = TradePrice::create('20.00', Quantity::create('1', 'HUR'));

        $item2->delivery = new LineTradeDelivery();
        $item2->delivery->billedQuantity = Quantity::create('100', 'HUR');

        $item2->specifiedLineTradeSettlement = new LineTradeSettlement();
        $lineTax2 = new TradeTax();
        $lineTax2->typeCode = 'VAT';
        $lineTax2->categoryCode = 'S';
        $lineTax2->rateApplicablePercent = '7.00';
        $item2->specifiedLineTradeSettlement->tradeTax[] = $lineTax2;
        $item2->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('2000.00');

        $invoice->supplyChainTradeTransaction->lineItems[] = $item2;

        $item3 = new SupplyChainTradeLineItem();
        $item3->associatedDocumentLineDocument = DocumentLineDocument::create('3');

        $item3->specifiedTradeProduct = new TradeProduct();
        $product3 = $item3->specifiedTradeProduct;
        $product3->sellerAssignedID = 'PROD-003-SELLER';
        $product3->name = 'Additional Parts Kit';

        $item3->tradeAgreement = new LineTradeAgreement();
        $item3->tradeAgreement->netPrice = TradePrice::create('15.00', Quantity::create('1', 'C62'));

        $item3->delivery = new LineTradeDelivery();
        $item3->delivery->billedQuantity = Quantity::create('10', 'C62');

        $item3->specifiedLineTradeSettlement = new LineTradeSettlement();
        $lineTax3 = new TradeTax();
        $lineTax3->typeCode = 'VAT';
        $lineTax3->categoryCode = 'S';
        $lineTax3->rateApplicablePercent = '19.00';
        $item3->specifiedLineTradeSettlement->tradeTax[] = $lineTax3;
        $item3->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('150.00');

        $invoice->supplyChainTradeTransaction->lineItems[] = $item3;

        $xml = Builder::create()->transform($invoice);
        self::assertNotEmpty($xml, 'Generated XML should not be empty');

        $validator = new Validator();
        $errors = $validator->validateAgainstXsd($xml, Validator::SCHEMA_EXTENDED);
        self::assertNull($errors, $errors ?? 'XML should validate against EXTENDED schema');
    }
}
