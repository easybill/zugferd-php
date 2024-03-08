<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD2\Tests;

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
use Easybill\ZUGFeRD2\Model\HeaderTradeAgreement;
use Easybill\ZUGFeRD2\Model\HeaderTradeDelivery;
use Easybill\ZUGFeRD2\Model\HeaderTradeSettlement;
use Easybill\ZUGFeRD2\Model\Id;
use Easybill\ZUGFeRD2\Model\Indicator;
use Easybill\ZUGFeRD2\Model\LineTradeAgreement;
use Easybill\ZUGFeRD2\Model\LineTradeDelivery;
use Easybill\ZUGFeRD2\Model\LineTradeSettlement;
use Easybill\ZUGFeRD2\Model\Note;
use Easybill\ZUGFeRD2\Model\Period;
use Easybill\ZUGFeRD2\Model\Quantity;
use Easybill\ZUGFeRD2\Model\ReferencedDocument;
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
use Easybill\ZUGFeRD2\Tests\Traits\AssertXmlOutputTrait;
use Easybill\ZUGFeRD2\Validator;
use PHPUnit\Framework\TestCase;

class ProfileExtendedTest extends TestCase
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
        $item1->specifiedLineTradeSettlement->billingSpecifiedPeriod = $item1Period = new Period();
        $item1Period->startDatetime = DateTime::create(102, '20181001');
        $item1Period->endDatetime = DateTime::create(102, '20181031');

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

        $item2->specifiedLineTradeSettlement->billingSpecifiedPeriod = $item2Period = new Period();
        $item2Period->startDatetime = DateTime::create(102, '20181001');
        $item2Period->endDatetime = DateTime::create(102, '20181031');

        $item2->specifiedLineTradeSettlement->monetarySummation = TradeSettlementLineMonetarySummation::create('1000');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement = new HeaderTradeAgreement();

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerTradeParty = new TradeParty();
        $sellerTradeParty->id = Id::create('12345676');
        $sellerTradeParty->name = 'Global Supplies Ltd.  ';
        $sellerTradeParty->postalTradeAddress = $sellerPostalAddress = new TradeAddress();
        $sellerPostalAddress->postcode = 'SW1B 3BN';
        $sellerPostalAddress->lineOne = '153 Victoria Street';
        $sellerPostalAddress->city = 'London';
        $sellerPostalAddress->countryCode = 'GB';

        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('GB999999999', 'VA');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerTradeParty = $buyerTradeParty = new TradeParty();
        $buyerTradeParty->id = Id::create('75969813');
        $buyerTradeParty->name = 'Metallbau Leipzig GmbH & Co. KG';

        $buyerTradeParty->postalTradeAddress = new TradeAddress();
        $buyerTradeParty->postalTradeAddress->postcode = '12345';
        $buyerTradeParty->postalTradeAddress->lineOne = 'Pappelallee 15';
        $buyerTradeParty->postalTradeAddress->lineTwo = 'Hof 3';
        $buyerTradeParty->postalTradeAddress->city = 'Leipzig';
        $buyerTradeParty->postalTradeAddress->countryCode = 'DE';

        $buyerTradeParty->uriUniversalCommunication = $universalCommunication = new UniversalCommunication();
        $universalCommunication->uriid = Id::create('04 0 11 000 - 12345 12345 - 35', '9958');

        $buyerTradeParty->taxRegistrations[] = TaxRegistration::create('DE123456789', 'VA');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTaxRepresentativeTradeParty = $sellerTaxTradeParty = new TradeParty();
        $sellerTaxTradeParty->name = 'Global Supplies Financial Services';
        $sellerTaxTradeParty->postalTradeAddress = $sellerTaxAddress = new TradeAddress();
        $sellerTaxAddress->postcode = '12345';
        $sellerTaxAddress->lineOne = 'Friedrichstraße 165';
        $sellerTaxAddress->city = 'Berlin';
        $sellerTaxAddress->countryCode = 'DE';
        $sellerTaxTradeParty->taxRegistrations[] = TaxRegistration::create('DE987654321', 'VA');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery = new HeaderTradeDelivery();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery->shipToTradeParty = $shipToTradeParty = new TradeParty();
        $shipToTradeParty->id = Id::create('75969815');
        $shipToTradeParty->name = 'Metallbau Leipzig GmbH & Co. KG';
        $shipToTradeParty->uriUniversalCommunication = $shipToUniversalCommunication = new UniversalCommunication();
        $shipToUniversalCommunication->uriid = Id::create('999999999', '0060');
        $shipToTradeParty->postalTradeAddress = new TradeAddress();
        $shipToTradeParty->postalTradeAddress->postcode = '12347';
        $shipToTradeParty->postalTradeAddress->lineOne = 'Eichenpromenade 37';
        $shipToTradeParty->postalTradeAddress->lineTwo = 'Tor 1';
        $shipToTradeParty->postalTradeAddress->city = 'Metallstadt';
        $shipToTradeParty->postalTradeAddress->countryCode = 'DE';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement = new HeaderTradeSettlement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->currency = 'EUR';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->payeeTradeParty = $payeeTradeParty = new TradeParty();
        $payeeTradeParty->globalID[] = Id::create('432156789', '0060');
        $payeeTradeParty->name = 'Global Supplies Financial Services';
        $payeeTradeParty->postalTradeAddress = new TradeAddress();
        $payeeTradeParty->postalTradeAddress->postcode = '12345';
        $payeeTradeParty->postalTradeAddress->lineOne = 'Friedrichstraße 165';
        $payeeTradeParty->postalTradeAddress->city = 'Berlin';
        $payeeTradeParty->postalTradeAddress->countryCode = 'DE';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementPaymentMeans[] = $paymentMeans1 = new TradeSettlementPaymentMeans();
        $paymentMeans1->typeCode = '58';
        $paymentMeans1->payeePartyCreditorFinancialAccount = new CreditorFinancialAccount();
        $paymentMeans1->payeePartyCreditorFinancialAccount->ibanId = Id::create('DE12 1234 4321 9876 00');
        $paymentMeans1->payeePartyCreditorFinancialAccount->AccountName = 'Global Supplies Financial Services';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->tradeTaxes[] = $headerTax1 = new TradeTax();
        $headerTax1->typeCode = 'VAT';
        $headerTax1->exemptionReason = 'Kein Ausweis der Umsatzsteuer bei innergemeinschaftlichen Lieferungen';
        $headerTax1->categoryCode = 'K';
        $headerTax1->basisAmount = Amount::create('2000');
        $headerTax1->calculatedAmount = Amount::create('0');
        $headerTax1->rateApplicablePercent = '0';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->billingSpecifiedPeriod = $billingPeriod = new Period();
        $billingPeriod->startDatetime = DateTime::create(102, '20181001');
        $billingPeriod->endDatetime = DateTime::create(102, '20181031');

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradePaymentTerms[] = $paymentTerms = new TradePaymentTerms();
        $paymentTerms->dueDate = DateTime::create(102, '20181130');

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
}
