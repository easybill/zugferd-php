<?php

class ReaderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @before
     */
    public function setupAnnotationRegistry()
    {
        \Doctrine\Common\Annotations\AnnotationRegistry::registerAutoloadNamespace(
            'JMS\Serializer\Annotation',
            __DIR__ . '/../../../../vendor/jms/serializer/src');
    }

    public function testGetDocument()
    {

        $zugferdXML = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<rsm:CrossIndustryDocument xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:rsm="urn:ferd:CrossIndustryDocument:invoice:1p0" xmlns:ram="urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:12" xmlns:udt="urn:un:unece:uncefact:data:standard:UnqualifiedDataType:15">
  <rsm:SpecifiedExchangedDocumentContext>
    <ram:GuidelineSpecifiedDocumentContextParameter>
      <ram:ID>urn:ferd:CrossIndustryDocument:invoice:1p0:basic</ram:ID>
    </ram:GuidelineSpecifiedDocumentContextParameter>
  </rsm:SpecifiedExchangedDocumentContext>
  <rsm:HeaderExchangedDocument>
    <ram:ID>RE1337</ram:ID>
    <ram:Name>RECHNUNG</ram:Name>
    <ram:TypeCode>380</ram:TypeCode>
    <ram:IssueDateTime>
      <udt:DateTimeString format="102">20130305</udt:DateTimeString>
    </ram:IssueDateTime>
    <ram:IncludedNote>
      <ram:Content>Test Node 1</ram:Content>
    </ram:IncludedNote>
    <ram:IncludedNote>
      <ram:Content>Test Node 2</ram:Content>
    </ram:IncludedNote>
  </rsm:HeaderExchangedDocument>
  <rsm:SpecifiedSupplyChainTradeTransaction>
    <ram:ApplicableSupplyChainTradeAgreement>
      <ram:SellerTradeParty>
        <ram:Name>Lieferant GmbH</ram:Name>
        <ram:PostalTradeAddress>
          <ram:PostcodeCode>80333</ram:PostcodeCode>
          <ram:LineOne>Lieferantenstraße 20</ram:LineOne>
          <ram:CityName>München</ram:CityName>
          <ram:CountryID>DE</ram:CountryID>
        </ram:PostalTradeAddress>
        <ram:SpecifiedTaxRegistration>
          <ram:ID schemeID="FC">201/113/40209</ram:ID>
        </ram:SpecifiedTaxRegistration>
        <ram:SpecifiedTaxRegistration>
          <ram:ID schemeID="VA">DE123456789</ram:ID>
        </ram:SpecifiedTaxRegistration>
      </ram:SellerTradeParty>
      <ram:BuyerTradeParty>
        <ram:Name>Kunden AG Mitte</ram:Name>
        <ram:PostalTradeAddress>
          <ram:PostcodeCode>69876</ram:PostcodeCode>
          <ram:LineOne>Hans Muster</ram:LineOne>
          <ram:LineTwo>Kundenstraße 15</ram:LineTwo>
          <ram:CityName>Frankfurt</ram:CityName>
          <ram:CountryID>DE</ram:CountryID>
        </ram:PostalTradeAddress>
      </ram:BuyerTradeParty>
    </ram:ApplicableSupplyChainTradeAgreement>
    <ram:ApplicableSupplyChainTradeDelivery>
      <ram:ActualDeliverySupplyChainEvent>
        <ram:OccurrenceDateTime>
          <udt:DateTimeString format="102">20130305</udt:DateTimeString>
        </ram:OccurrenceDateTime>
      </ram:ActualDeliverySupplyChainEvent>
    </ram:ApplicableSupplyChainTradeDelivery>
    <ram:ApplicableSupplyChainTradeSettlement>
      <ram:PaymentReference>2013-471102</ram:PaymentReference>
      <ram:InvoiceCurrencyCode>EUR</ram:InvoiceCurrencyCode>
      <ram:SpecifiedTradeSettlementPaymentMeans>
        <ram:TypeCode>31</ram:TypeCode>
        <ram:Information>Überweisung</ram:Information>
        <ram:PayeePartyCreditorFinancialAccount>
          <ram:IBANID>DE08700901001234567890</ram:IBANID>
          <ram:AccountName></ram:AccountName>
          <ram:ProprietaryID></ram:ProprietaryID>
        </ram:PayeePartyCreditorFinancialAccount>
        <ram:PayeeSpecifiedCreditorFinancialInstitution>
          <ram:BICID>GENODEF1M04</ram:BICID>
          <ram:GermanBankleitzahlID></ram:GermanBankleitzahlID>
          <ram:Name></ram:Name>
        </ram:PayeeSpecifiedCreditorFinancialInstitution>
      </ram:SpecifiedTradeSettlementPaymentMeans>
      <ram:ApplicableTradeTax>
        <ram:CalculatedAmount currencyID="EUR">19.25</ram:CalculatedAmount>
        <ram:TypeCode>VAT</ram:TypeCode>
        <ram:BasisAmount currencyID="EUR">275.00</ram:BasisAmount>
        <ram:ApplicablePercent>7.00</ram:ApplicablePercent>
      </ram:ApplicableTradeTax>
      <ram:ApplicableTradeTax>
        <ram:CalculatedAmount currencyID="EUR">37.62</ram:CalculatedAmount>
        <ram:TypeCode>VAT</ram:TypeCode>
        <ram:BasisAmount currencyID="EUR">198.00</ram:BasisAmount>
        <ram:ApplicablePercent>19.00</ram:ApplicablePercent>
      </ram:ApplicableTradeTax>
      <ram:SpecifiedTradeSettlementMonetarySummation>
        <ram:LineTotalAmount currencyID="EUR">198.00</ram:LineTotalAmount>
        <ram:ChargeTotalAmount currencyID="EUR">0.00</ram:ChargeTotalAmount>
        <ram:AllowanceTotalAmount currencyID="EUR">0.00</ram:AllowanceTotalAmount>
        <ram:TaxBasisTotalAmount currencyID="EUR">198.00</ram:TaxBasisTotalAmount>
        <ram:TaxTotalAmount currencyID="EUR">37.62</ram:TaxTotalAmount>
        <ram:GrandTotalAmount currencyID="EUR">235.62</ram:GrandTotalAmount>
      </ram:SpecifiedTradeSettlementMonetarySummation>
    </ram:ApplicableSupplyChainTradeSettlement>
    <ram:IncludedSupplyChainTradeLineItem>
      <ram:AssociatedDocumentLineDocument>
        <ram:LineID>1</ram:LineID>
        <ram:IncludedNote>
          <ram:Content>Testcontent in einem LineDocument</ram:Content>
        </ram:IncludedNote>
      </ram:AssociatedDocumentLineDocument>
      <ram:SpecifiedSupplyChainTradeAgreement>
        <ram:GrossPriceProductTradePrice>
          <ram:ChargeAmount currencyID="EUR">9.90</ram:ChargeAmount>
        </ram:GrossPriceProductTradePrice>
        <ram:NetPriceProductTradePrice>
          <ram:ChargeAmount currencyID="EUR">9.90</ram:ChargeAmount>
        </ram:NetPriceProductTradePrice>
      </ram:SpecifiedSupplyChainTradeAgreement>
      <ram:SpecifiedSupplyChainTradeDelivery>
        <ram:BilledQuantity unitCode="C62">20.00</ram:BilledQuantity>
      </ram:SpecifiedSupplyChainTradeDelivery>
      <ram:SpecifiedSupplyChainTradeSettlement>
        <ram:ApplicableTradeTax>
          <ram:TypeCode>VAT</ram:TypeCode>
          <ram:ApplicablePercent>19.00</ram:ApplicablePercent>
          <ram:CategoryCode>S</ram:CategoryCode>
        </ram:ApplicableTradeTax>
        <ram:SpecifiedTradeSettlementMonetarySummation>
          <ram:LineTotalAmount currencyID="EUR">198.00</ram:LineTotalAmount>
        </ram:SpecifiedTradeSettlementMonetarySummation>
      </ram:SpecifiedSupplyChainTradeSettlement>
      <ram:SpecifiedTradeProduct>
        <ram:SellerAssignedID>TB100A4</ram:SellerAssignedID>
        <ram:Name>Trennblätter A4</ram:Name>
      </ram:SpecifiedTradeProduct>
    </ram:IncludedSupplyChainTradeLineItem>
  </rsm:SpecifiedSupplyChainTradeTransaction>
</rsm:CrossIndustryDocument>

XML;


        $reader = \Easybill\ZUGFeRD\Reader::create();

        $doc = $reader->getDocument($zugferdXML);
        $this->assertInstanceOf('\Easybill\ZUGFeRD\Model\Document', $doc);

        $this->checkHeader($doc->getHeader());
        $this->checkTrade($doc->getTrade());
    }

    private function checkHeader(\Easybill\ZUGFeRD\Model\Header $header)
    {
        $this->assertSame('RE1337', $header->getId());
        $this->assertSame('RECHNUNG', $header->getName());
        $this->assertSame('380', $header->getTypeCode());

        $this->assertInstanceOf('\Easybill\ZUGFeRD\Model\Date', $header->getDate());
        $this->assertSame(102, $header->getDate()->getDate()->getFormat());
        $this->assertSame('20130305', $header->getDate()->getDate()->getTime());

        $notes = $header->getNotes();
        $this->assertCount(2, $notes);

        $cnt = 0;
        foreach ($notes as $note) {
            $cnt++;
            $this->assertInstanceOf('\Easybill\ZUGFeRD\Model\Note', $note);
            $this->assertSame('Test Node ' . $cnt, $note->getContent());
        }
    }

    private function checkTrade(\Easybill\ZUGFeRD\Model\Trade\Trade $trade)
    {
        $this->assertInstanceOf('\Easybill\ZUGFeRD\Model\Trade\Trade', $trade);

        $this->checkAgreement($trade->getAgreement());
    }

    private function checkAgreement(\Easybill\ZUGFeRD\Model\Trade\Agreement $agreement)
    {
        $seller = $agreement->getSeller();
        $buyer = $agreement->getBuyer();
        $this->assertInstanceOf('\Easybill\ZUGFeRD\Model\Trade\Agreement', $agreement);
        $this->assertInstanceOf('\Easybill\ZUGFeRD\Model\Trade\TradeParty', $seller);
        $this->assertInstanceOf('\Easybill\ZUGFeRD\Model\Trade\TradeParty', $buyer);

        $sellerAddress = $seller->getAddress();
        $this->assertSame('Lieferant GmbH', $seller->getName());
        $this->assertSame('80333', $sellerAddress->getPostcode());
        $this->assertSame('München', $sellerAddress->getCity());
        $this->assertSame('Lieferantenstraße 20', $sellerAddress->getLineOne());
        $this->assertSame('DE', $sellerAddress->getCountryCode());

        $sellerRegistrations = $seller->getTaxRegistrations();
        $this->assertCount(2, $sellerRegistrations);

        for($cnt = 0; $cnt < 2; $cnt++) {
            $taxRegistration = $sellerRegistrations[$cnt];
            if($cnt == 0) {
                $this->assertSame('FC', $taxRegistration->getRegistration()->getSchemeID());
                $this->assertSame('201/113/40209', $taxRegistration->getRegistration()->getValue());
            } else {
                $this->assertSame('VA', $taxRegistration->getRegistration()->getSchemeID());
                $this->assertSame('DE123456789', $taxRegistration->getRegistration()->getValue());
            }
        }

        $buyerAddress = $buyer->getAddress();
        $this->assertSame('Kunden AG Mitte', $buyer->getName());
        $this->assertSame('69876', $buyerAddress->getPostcode());
        $this->assertSame('Frankfurt', $buyerAddress->getCity());
        $this->assertSame('Hans Muster', $buyerAddress->getLineOne());
        $this->assertSame('Kundenstraße 15', $buyerAddress->getLineTwo());
        $this->assertSame('DE', $buyerAddress->getCountryCode());
        $this->assertEmpty($buyer->getTaxRegistrations());
    }

}
