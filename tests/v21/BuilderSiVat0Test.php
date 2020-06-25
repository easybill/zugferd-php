<?php

namespace Easybill\ZUGFeRD\Tests\v21;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Easybill\ZUGFeRD\v21\Builder;
use Easybill\ZUGFeRD\Model\v21\Address;
use Easybill\ZUGFeRD\Model\v21\AllowanceCharge;
use Easybill\ZUGFeRD\Model\v21\Date;
use Easybill\ZUGFeRD\Model\v21\Document;
use Easybill\ZUGFeRD\Model\v21\Note;
use Easybill\ZUGFeRD\Model\v21\Trade\Amount;
use Easybill\ZUGFeRD\Model\v21\Trade\BillingPeriod;
use Easybill\ZUGFeRD\Model\v21\Trade\CreditorFinancialAccount;
use Easybill\ZUGFeRD\Model\v21\Trade\CreditorFinancialInstitution;
use Easybill\ZUGFeRD\Model\v21\Trade\Delivery;
use Easybill\ZUGFeRD\Model\v21\Trade\Item\LineDocument;
use Easybill\ZUGFeRD\Model\v21\Trade\Item\LineItem;
use Easybill\ZUGFeRD\Model\v21\Trade\Item\Price;
use Easybill\ZUGFeRD\Model\v21\Trade\Item\Product;
use Easybill\ZUGFeRD\Model\v21\Trade\Item\Quantity;
use Easybill\ZUGFeRD\Model\v21\Trade\Item\SpecifiedTradeAgreement;
use Easybill\ZUGFeRD\Model\v21\Trade\Item\SpecifiedTradeDelivery;
use Easybill\ZUGFeRD\Model\v21\Trade\Item\SpecifiedTradeMonetarySummation;
use Easybill\ZUGFeRD\Model\v21\Trade\Item\SpecifiedTradeSettlement;
use Easybill\ZUGFeRD\Model\v21\Trade\MonetarySummation;
use Easybill\ZUGFeRD\Model\v21\Trade\PaymentMeans;
use Easybill\ZUGFeRD\Model\v21\Trade\PaymentTerms;
use Easybill\ZUGFeRD\Model\v21\Trade\Settlement;
use Easybill\ZUGFeRD\Model\v21\Trade\Tax\TaxRegistration;
use Easybill\ZUGFeRD\Model\v21\Trade\Tax\TradeTax;
use Easybill\ZUGFeRD\Model\v21\Trade\Tax\TradeTaxCategory;
use Easybill\ZUGFeRD\Model\v21\Trade\Trade;
use Easybill\ZUGFeRD\Model\v21\Trade\TradeParty;
use Easybill\ZUGFeRD\v21\SchemaValidator;
use PHPUnit\Framework\TestCase;
use Milo\Schematron;
use DOMDocument;

class BuilderSiVat0Test extends TestCase
{

    /**
     * @before
     */
    public function setupAnnotationRegistry(): void
    {
        AnnotationRegistry::registerLoader('class_exists');
    }

    public function testGetXML(): void
    {
        $doc = new Document(Document::TYPE_BASIC);
        $doc->getHeader()
            ->setId('123456')
            ->setName('RECHNUNG')
            ->setDate(new Date(new \DateTime('20200608'), 102))
            ->addNote(new Note('Sport Import GmbH
            Industriestraße 39
            261288 Edewecht

            Geschäftsführer:
            Michael Müllmann, Alexander Müllmann, Ralf Fischer', 'REG'));

        $trade = $doc->getTrade();

        $delivery = new Delivery('20200608', 102);
        $delivery->setTradeParty(
            new TradeParty('Kunden AG Mitte',
                new Address('75018', 'Hans Muster', 'Kundenstraße 15', 'Brüssel', 'BE')
            )
        );
        $trade->setDelivery($delivery);

        $this->setAgreement($trade);
        $this->setLineItem1($trade);
        $this->setLineItem2($trade);
        $this->setSettlement($trade);
//        error_log(print_r($doc, true));

        $builder = Builder::create();
        $xml = $builder->getXML($doc);

        file_put_contents(__DIR__ . '/builder.zero_vat.zugferd2.1-BASIC.xml', $xml);
//        $this->assertStringEqualsFile(__DIR__ . '/builder.zugferd2.1-BASIC.xml', $xml);

        SchemaValidator::isValid($xml);
        //Validation
//        $schematron = new Schematron;
//        $schematron->load(__DIR__ . '/../../src/Assets/Schema/v21/BASIC/Schematron/FACTUR-X_BASIC.scmt');
//
//        $document = new DOMDocument;
//        $document->loadXML($xml);
//
//        $result = $schematron->validate($document);
    }

    private function setAgreement(Trade $trade): void
    {
        $trade->getAgreement()
            ->setBuyerReference('AB-312')
            ->setSeller(
                new TradeParty('Lieferant GmbH',
                    new Address('80333', 'Lieferantenstraße 20', null, 'München', 'DE'),
                    [
                        new TaxRegistration('FC', '201/113/40209'),
                        new TaxRegistration('VA', 'DE123456789'),
                    ]
                )
            )->setBuyer(
                new TradeParty('Kunden AG Mitte',
                    new Address('75018', 'Hans Muster', 'Kundenstraße 15', 'Brüssel', 'BE'),
                    [
                        new TaxRegistration('VA', 'BE123456789'),
                    ]
                )
            )->setSellerTaxRepresentative(
                new TradeParty('SELLER TAX REP',
                    new Address('69876', '35 rue d\'ici', 'Seller line 2', 'PARIS', 'FR'),
                    [
                        new TaxRegistration('VA', 'FR 05 987 654 321'),
                    ]
                )
            );
    }

    private function setLineItem1(Trade $trade): void
    {
        $tradeAgreement = new SpecifiedTradeAgreement();

//        $grossPrice = new Price(7.77, 'EUR', false);
//        $grossPrice
//            ->addAllowanceCharge(new AllowanceCharge(false, 1.80));
//
//        $tradeAgreement->setGrossPrice($grossPrice);
        $tradeAgreement->setNetPrice(new Price(20.067, 'EUR', false));

        $lineItemTradeTax = new TradeTax();
        $lineItemTradeTax->setCode('VAT');
        $lineItemTradeTax->setPercent(0.00);
        $lineItemTradeTax->setCategory('K');

        $lineItemSettlement = new SpecifiedTradeSettlement();
        $lineItemSettlement
            ->setTradeTax($lineItemTradeTax)
            ->setMonetarySummation(new SpecifiedTradeMonetarySummation(200.67));

        $lineItem = new LineItem();
        $lineItem
            ->setTradeAgreement($tradeAgreement)
            ->setDelivery(new SpecifiedTradeDelivery(new Quantity('C62', 10.00)))
            ->setSettlement($lineItemSettlement)
            ->setProduct(new Product('916000003', 'CLIF BAR Energie-Riegel Erdnussbutter', '722252131089'))
            ->setLineDocument(new LineDocument('1'))
            ->getLineDocument()
            ->addNote(new Note('Testcontent in einem LineDocument'));

        $trade->addLineItem($lineItem);
    }

    private function setLineItem2(Trade $trade): void
    {
        $tradeAgreement = new SpecifiedTradeAgreement();

        $tradeAgreement->setNetPrice(new Price(22.084, 'EUR', false));

        $lineItemTradeTax = new TradeTax();
        $lineItemTradeTax->setCode('VAT');
        $lineItemTradeTax->setPercent(0.00);
        $lineItemTradeTax->setCategory('K');

        $lineItemSettlement = new SpecifiedTradeSettlement();
        $lineItemSettlement
            ->setTradeTax($lineItemTradeTax)
            ->setMonetarySummation(new SpecifiedTradeMonetarySummation(220.84));

        $lineItem = new LineItem();
        $lineItem
            ->setTradeAgreement($tradeAgreement)
            ->setDelivery(new SpecifiedTradeDelivery(new Quantity('C62', 10.00)))
            ->setSettlement($lineItemSettlement)
            ->setProduct(new Product('919000001', 'CLIF BAR Nut Butter Filled Riegel', '722252597243'))
            ->setLineDocument(new LineDocument('2'))
            ->getLineDocument()
            ->addNote(new Note('Testcontent in einem LineDocument'));

        $trade->addLineItem($lineItem);
    }


    private function setSettlement(Trade $trade): void
    {
        $settlement = new Settlement('2020-123456', 'EUR');
        $settlement->setPaymentTerms(new PaymentTerms('Zahlbar innerhalb von 20 Tagen (bis zum 05.10.2016) unter Abzug von 3% Skonto (Zahlungsbetrag = 1.766,03 €). Bis zum 29.09.2016 ohne Abzug.', new Date('20130404')));

        $settlement->setPaymentMeans(new PaymentMeans());
        $settlement->getPaymentMeans()
            ->setCode('30')
            ->setInformation('Überweisung')
            ->setPayeeAccount(new CreditorFinancialAccount('DE08700901001234567890', '', ''))
            ->setPayeeInstitution(new CreditorFinancialInstitution('GENODEF1M04', '', ''));

        $tradeTax = new TradeTax();
        $tradeTax->setCode('VAT');
        $tradeTax->setPercent(0.00);
        $tradeTax->setBasisAmount(new Amount(284.80, 'EUR'));
        $tradeTax->setCategory('K');
        $tradeTax->setCalculatedAmount(new Amount(0, 'EUR'));
        $tradeTax->setExemptionReason('Intra-community supply');
        $tradeTax->setExemptionReasonCode('vatex-eu-ic');

        $settlement->addTradeTax($tradeTax);
        $settlement->setMonetarySummation(
            new MonetarySummation(421.51, 0.00, 0.00, 421.51, 0, 421.51, 'EUR')
        );

        $billingPeriod = new BillingPeriod(
            new Date('20200608'),
            new Date('20200708')
        );
        $settlement->setBillingPeriod($billingPeriod);

        $trade->setSettlement($settlement);
    }

}
