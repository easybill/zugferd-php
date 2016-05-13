<?php

class BuilderTest extends \PHPUnit_Framework_TestCase
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

    public function testGetXML()
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

        $doc = new \Easybill\ZUGFeRD\Model\Document();
        $doc->getHeader()
            ->setId('RE1337')
            ->setName('RECHNUNG')
            ->addNote(new \Easybill\ZUGFeRD\Model\Note('Test Node 1'))
            ->addNote(new \Easybill\ZUGFeRD\Model\Note('Test Node 2'));

        $builder = \Easybill\ZUGFeRD\Builder::create();
        $xml = $builder->getXML($doc);

        $this->assertSame($zugferdXML, $xml);

    }
}
