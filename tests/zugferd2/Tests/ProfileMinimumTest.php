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
use Easybill\ZUGFeRD2\Model\SupplyChainTradeTransaction;
use Easybill\ZUGFeRD2\Model\TaxRegistration;
use Easybill\ZUGFeRD2\Model\TradeAddress;
use Easybill\ZUGFeRD2\Model\TradeParty;
use Easybill\ZUGFeRD2\Model\TradeSettlementHeaderMonetarySummation;
use Easybill\ZUGFeRD2\Tests\Traits\AssertXmlOutputTrait;
use Easybill\ZUGFeRD2\Validator;
use PHPUnit\Framework\TestCase;

class ProfileMinimumTest extends TestCase
{
    use AssertXmlOutputTrait;

    public function testBuildMINIMUMRechnung(): void
    {
        $invoice = new CrossIndustryInvoice();
        $invoice->exchangedDocumentContext = new ExchangedDocumentContext();
        $invoice->exchangedDocumentContext->documentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->documentContextParameter->id = Builder::GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_MINIMUM;

        $invoice->exchangedDocument = new ExchangedDocument();
        $invoice->exchangedDocument->id = '471102';
        $invoice->exchangedDocument->typeCode = '380';
        $invoice->exchangedDocument->issueDateTime = DateTime::create(102, '20200305');

        $invoice->supplyChainTradeTransaction = new SupplyChainTradeTransaction();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement = new HeaderTradeAgreement();

        // Seller Trade Party
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerTradeParty = new TradeParty();
        $sellerTradeParty->name = 'Lieferant GmbH';
        $sellerTradeParty->postalTradeAddress = new TradeAddress();
        $sellerTradeParty->postalTradeAddress->countryCode = 'DE';
        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('201/113/40209', 'FC');
        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('DE123456789', 'VA');

        // Buyer Trade Party
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerTradeParty = $buyerTradeParty = new TradeParty();
        $buyerTradeParty->name = 'Kunden AG Frankreich';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery = new HeaderTradeDelivery();

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement = new HeaderTradeSettlement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->currency = 'EUR';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = $monetarySummation = new TradeSettlementHeaderMonetarySummation();
        $monetarySummation->taxBasisTotalAmount[] = Amount::create('198.00');
        $monetarySummation->taxTotalAmount[] = Amount::create('37.62', 'EUR');
        $monetarySummation->grandTotalAmount[] = Amount::create('235.62');
        $monetarySummation->duePayableAmount = Amount::create('235.62');

        $this->buildAndAssertXmlFromCII(
            $invoice,
            __DIR__ . '/Examples/MINIMUM/MINIMUM_Rechnung.xml',
            Validator::SCHEMA_MINIMUM
        );
    }

    public function testBuildMINIMUMBuchungshilfe(): void
    {
        $invoice = new CrossIndustryInvoice();
        $invoice->exchangedDocumentContext = new ExchangedDocumentContext();
        $invoice->exchangedDocumentContext->documentContextParameter = new DocumentContextParameter();
        $invoice->exchangedDocumentContext->documentContextParameter->id = Builder::GUIDELINE_SPECIFIED_DOCUMENT_CONTEXT_ID_MINIMUM;

        $invoice->exchangedDocument = new ExchangedDocument();
        $invoice->exchangedDocument->id = '471102';
        $invoice->exchangedDocument->typeCode = '751';
        $invoice->exchangedDocument->issueDateTime = DateTime::create(102, '20200305');

        $invoice->supplyChainTradeTransaction = new SupplyChainTradeTransaction();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement = new HeaderTradeAgreement();

        // Seller Trade Party
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->sellerTradeParty = $sellerTradeParty = new TradeParty();
        $sellerTradeParty->name = 'Lieferant GmbH';
        $sellerTradeParty->postalTradeAddress = new TradeAddress();
        $sellerTradeParty->postalTradeAddress->countryCode = 'DE';
        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('201/113/40209', 'FC');
        $sellerTradeParty->taxRegistrations[] = TaxRegistration::create('DE123456789', 'VA');

        // Buyer Trade Party
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeAgreement->buyerTradeParty = $buyerTradeParty = new TradeParty();
        $buyerTradeParty->name = 'Kunden AG Mitte';

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeDelivery = new HeaderTradeDelivery();

        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement = new HeaderTradeSettlement();
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->currency = 'EUR';
        $invoice->supplyChainTradeTransaction->applicableHeaderTradeSettlement->specifiedTradeSettlementHeaderMonetarySummation = $monetarySummation = new TradeSettlementHeaderMonetarySummation();
        $monetarySummation->taxBasisTotalAmount[] = Amount::create('198.00');
        $monetarySummation->taxTotalAmount[] = Amount::create('37.62', 'EUR');
        $monetarySummation->grandTotalAmount[] = Amount::create('235.62');
        $monetarySummation->duePayableAmount = Amount::create('235.62');

        $this->buildAndAssertXmlFromCII(
            $invoice,
            __DIR__ . '/Examples/MINIMUM/MINIMUM_Buchungshilfe.xml',
            Validator::SCHEMA_MINIMUM
        );
    }
}
