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
            __DIR__ . '/../../../../../../vendor/jms/serializer/src');
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
    <ram:IncludedNote>
      <ram:Content>Test Node 1</ram:Content>
    </ram:IncludedNote>
    <ram:IncludedNote>
      <ram:Content>Test Node 2</ram:Content>
    </ram:IncludedNote>
  </rsm:HeaderExchangedDocument>
</rsm:CrossIndustryDocument>

XML;


        $reader = \Easybill\ZUGFeRD\Reader::create();

        $doc = $reader->getDocument($zugferdXML);

        $this->assertInstanceOf('\Easybill\ZUGFeRD\Model\Document', $doc);
        $this->assertSame('RE1337',$doc->getHeader()->getId());
        $this->assertSame('RECHNUNG',$doc->getHeader()->getName());
        $this->assertSame('380',$doc->getHeader()->getTypeCode());
        $this->assertCount(2,$doc->getHeader()->getNotes());


    }
}
