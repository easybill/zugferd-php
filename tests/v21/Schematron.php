<?
namespace tests;

// ##################################################################################
// Title                     : class_schematron.php
// Version                   : 1.0
// Author                    : Luis Argerich (lrargerich@yahoo.com)
// Last modification date    : 05-15-2002
// Description               : This class allows you to perform Schematron XML
//                             validations from PHP, it is based on the XSLT
//                             Schematron implementation so you need PHP configured
//                             with XSLT. 
// ##################################################################################
// History: 
// 05-15-2002     First release of this class
// 05-12-2002     Embedded the xslt file and the schematron 1.5 xslt into this class
//                so you only need to include this file in order to use schematron.
// ##################################################################################
// To-Dos:
// ##################################################################################
// How to use it:
// You can have an XML file to be validated in memory or in a file
// and you need a schematron validation script in XML in memory or in a file.
// You can compile schematron_scripts to xslt files using the compile_from_mem
// or compile_from_file methods.
// Then you can validate with several flavours depeding on the XML source,
// the schematron source or if the schematron is compiled or not.
// VERY SIMPLE EXAMPLE:
// $s=new Schematron();
// $result=$s->schematron_validate_file_using_file("sample1.xml","validation_sample1.xml");
// ##################################################################################


// CHECK FOR DOUBLE DEFINITION
if(defined("_class_schematron_is_included")) {
  // do nothing since the class is already included  
} else {
  define("_class_schematron_is_included",1);


class Schematron {
  var $compiled;
  var $sk15;
  
  function Schematron() {
    $this->sk15='<?xml version="1.0"?><xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:axsl="http://www.w3.org/1999/XSL/TransformAlias" xmlns:sch="http://www.ascc.net/xml/schematron" ><xsl:namespace-alias stylesheet-prefix="axsl" result-prefix="xsl"/><xsl:output method="xml" omit-xml-declaration="no" standalone="yes"  indent="yes"/><xsl:param name="block"></xsl:param><xsl:param name="phase"><xsl:choose><xsl:when test="//sch:schema/@defaultPhase"><xsl:value-of select="//sch:schema/@defaultPhase"/></xsl:when><xsl:otherwise>#ALL</xsl:otherwise></xsl:choose></xsl:param><xsl:param name="hiddenKey"> key </xsl:param><xsl:template match="sch:schema | schema"><axsl:stylesheet version="1.0">	<xsl:for-each select="sch:ns | ns">	<xsl:attribute name="{concat(@prefix,'."'".':dummy-for-xmlns'."'".')}" namespace="{@uri}"/></xsl:for-each> 	<xsl:if test="count(sch:title/* | title/* )">	<xsl:message>		<xsl:text>Warning: </xsl:text>		<xsl:value-of select="name(.)"/>		<xsl:text> must not contain any child elements</xsl:text>	</xsl:message>	</xsl:if> 	<xsl:call-template name="process-prolog"/><axsl:template match="*|@*" mode="schematron-get-full-path">	<axsl:apply-templates select="parent::*" mode="schematron-get-full-path"/><axsl:text>/</axsl:text><axsl:if test="count(. | ../@*) = count(../@*)">@</axsl:if>			<axsl:value-of select="name()"/>			<axsl:text>[</axsl:text>	  		<axsl:value-of select="1+count(preceding-sibling::*[name()=name(current())])"/>	  		<axsl:text>]</axsl:text></axsl:template><xsl:apply-templates mode="do-keys" select="sch:pattern/sch:rule/sch:key | pattern/rule/key | sch:key | key "/>		<axsl:template match="/">			<xsl:call-template name="process-root"><xsl:with-param name="fpi" select="@fpi"/><xsl:with-param 	xmlns:sch="http://www.ascc.net/xml/schematron"				name="title" select="./sch:title | title"/><xsl:with-param name="id" select="@id"/><xsl:with-param name="icon" select="@icon"/><xsl:with-param name="lang" select="@xml:lang"/><xsl:with-param name="version" select="@version" /><xsl:with-param name="schemaVersion" select="@schemaVersion" /><xsl:with-param name="contents"><xsl:apply-templates mode="do-all-patterns"/></xsl:with-param>			</xsl:call-template>		</axsl:template> 		<xsl:apply-templates/>		<axsl:template match="text()" priority="-1"></axsl:template>	</axsl:stylesheet></xsl:template>		<xsl:template match="sch:active | active"><xsl:if test="not(@pattern)"><xsl:message>Markup Error: no pattern attribute in &lt;active></xsl:message></xsl:if><xsl:if test="//sch:rule[@id= current()/@pattern]"><xsl:message>Reference Error: the pattern  "<xsl:value-of select="@pattern"/>" has been activated but is not declared</xsl:message></xsl:if></xsl:template><xsl:template match="sch:assert | assert"><xsl:if test="not(@test)"><xsl:message>Markup Error: no test attribute in &lt;assert></xsl:message></xsl:if><axsl:choose><axsl:when test="{@test}"/><axsl:otherwise><xsl:call-template name="process-assert"><xsl:with-param name="role" select="@role"/><xsl:with-param name="id" select="@id"/><xsl:with-param name="test" select="normalize-space(@test)" /><xsl:with-param name="icon" select="@icon"/><xsl:with-param name="subject" select="@subject"/><xsl:with-param name="diagnostics" select="@diagnostics"/></xsl:call-template></axsl:otherwise></axsl:choose></xsl:template><xsl:template match="sch:report | report"><xsl:if test="not(@test)"><xsl:message>Markup Error: no test attribute in &lt;report></xsl:message></xsl:if><axsl:if test="{@test}">			<xsl:call-template name="process-report"><xsl:with-param name="role" select="@role"/><xsl:with-param name="test" select="normalize-space(@test)" /><xsl:with-param name="icon" select="@icon"/><xsl:with-param name="id" select="@id"/><xsl:with-param name="subject" select="@subject"/><xsl:with-param name="diagnostics" select="@diagnostics"/></xsl:call-template></axsl:if></xsl:template><xsl:template match="sch:diagnostic | diagnostic"><xsl:if test="not(@id)"><xsl:message>Markup Error: no id attribute in &lt;diagnostic></xsl:message></xsl:if><xsl:call-template name="process-diagnostic"><xsl:with-param name="id" select="@id" /></xsl:call-template></xsl:template><xsl:template match="sch:diagnostics | diagnostics"/><xsl:template match="sch:dir | dir"  mode="text"><xsl:call-template name="process-dir"><xsl:with-param name="value" select="@value"/></xsl:call-template></xsl:template><xsl:template match="sch:emph | emph"  mode="text"><xsl:call-template name="process-emph"/></xsl:template><xsl:template match="sch:extends | extends"><xsl:if test="not(@rule)"><xsl:message>Markup Error: no rule attribute in &lt;extends></xsl:message></xsl:if><xsl:if test="not(//sch:rule[@abstract='."'".'true'."'".'][@id= current()/@rule] ) and not(//rule[@abstract='."'".'true'."'".'][@id= current()/@rule])"><xsl:message>Reference Error: the abstract rule  "<xsl:value-of select="@rule"/>" has been referenced but is not declared</xsl:message></xsl:if><xsl:call-template name="IamEmpty" /><xsl:if test="//sch:rule[@id=current()/@rule]"><xsl:apply-templates select="//sch:rule[@id=current()/@rule]"	mode="extends"/></xsl:if></xsl:template><xsl:template  match="sch:key | key " mode="do-keys" ><xsl:if test="not(@name)"><xsl:message>Markup Error: no name attribute in &lt;key></xsl:message></xsl:if><xsl:if test="not(@match) and not(../sch:rule)"><xsl:message>Markup Error:  no match attribute on &lt;key> outside &lt;rule></xsl:message></xsl:if><xsl:if test="not(@path)"><xsl:message>Markup Error: no path attribute in &lt;key></xsl:message></xsl:if><xsl:call-template name="IamEmpty" /><xsl:choose><xsl:when test="@match"><axsl:key match="{@match}" name="{@name}" use="{@path}"/></xsl:when><xsl:otherwise><axsl:key name="{@name}" match="{parent::sch:rule/@context}" use="{@path}"/></xsl:otherwise></xsl:choose></xsl:template><xsl:template match="sch:key | key"  /> 		<xsl:template match="sch:name | name" mode="text"><axsl:text xml:space="preserve"> </axsl:text><xsl:if test="@path"				><xsl:call-template name="process-name"><xsl:with-param name="name" select="concat('."'".'name('."'".',@path,'."'".')'."'".')"/></xsl:call-template></xsl:if><xsl:if test="not(@path)"				><xsl:call-template name="process-name"><xsl:with-param name="name" select="'."'".'name(.)'."'".'"/></xsl:call-template></xsl:if><xsl:call-template name="IamEmpty" /><axsl:text xml:space="preserve"> </axsl:text></xsl:template><xsl:template match="sch:ns | ns"  mode="do-all-patterns" ><xsl:if test="not(@uri)"><xsl:message>Markup Error: no uri attribute in &lt;ns></xsl:message></xsl:if><xsl:if test="not(@prefix)"><xsl:message>Markup Error: no prefix attribute in &lt;ns></xsl:message></xsl:if><xsl:call-template name="IamEmpty" /><xsl:call-template name="process-ns" ><xsl:with-param name="prefix" select="@prefix"/><xsl:with-param name="uri" select="@uri"/></xsl:call-template></xsl:template><xsl:template match="sch:ns | ns"  /><xsl:template match="sch:schema/sch:p | schema/p" mode="do-schema-p" ><xsl:call-template name="process-p"><xsl:with-param name="class" select="@class"/><xsl:with-param name="icon" select="@icon"/><xsl:with-param name="id" select="@id"/><xsl:with-param name="lang" select="@xml:lang"/></xsl:call-template></xsl:template><xsl:template match="sch:pattern/sch:p | pattern/p" mode="do-pattern-p" ><xsl:call-template name="process-p"><xsl:with-param name="class" select="@class"/><xsl:with-param name="icon" select="@icon"/><xsl:with-param name="id" select="@id"/><xsl:with-param name="lang" select="@xml:lang"/></xsl:call-template></xsl:template><xsl:template match="sch:phase/sch:p" /><xsl:template match="sch:p | p" /><xsl:template match="sch:pattern | pattern" mode="do-all-patterns"><xsl:if test="($phase = '."'".'#ALL'."'".') or (../sch:phase[@id= ($phase)]/sch:active[@pattern= current()/@id])	or (../phase[@id= ($phase)]/active[@id= current()/@id])"><xsl:call-template name="process-pattern"><xsl:with-param name="name" select="@name"/><xsl:with-param name="id" select="@id"/><xsl:with-param name="see" select="@see"/><xsl:with-param name="fpi" select="@fpi"/><xsl:with-param name="icon" select="@icon"/></xsl:call-template><axsl:apply-templates select="/" mode="M{count(preceding-sibling::*)}"/></xsl:if></xsl:template><xsl:template match="sch:pattern | pattern"><xsl:if test="($phase = '."'".'#ALL'."'".') or (../sch:phase[@id= ($phase)]/sch:active[@pattern= current()/@id])	or (../phase[@id= ($phase)]/active[@id= current()/@id])"><xsl:apply-templates/><axsl:template match="text()" priority="-1" mode="M{count(preceding-sibling::*)}"></axsl:template></xsl:if></xsl:template><xsl:template match="sch:phase | phase" ><xsl:if test="not(@id)"><xsl:message>Markup Error: no id attribute in &lt;phase></xsl:message></xsl:if></xsl:template><xsl:template match="sch:rule[not(@abstract='."'".'true'."'".')] | rule[not(@abstract='."'".'true'."'".')]"><xsl:if test="not(@context)"><xsl:message>Markup Error: no context attribute in &lt;rule></xsl:message></xsl:if><axsl:template match="{@context}" priority="{4000 - count(preceding-sibling::*)}" mode="M{count(../preceding-sibling::*)}"><xsl:call-template name="process-rule"><xsl:with-param name="id" select="@id"/><xsl:with-param name="context" select="@context"/><xsl:with-param name="role" select="@role"/></xsl:call-template><xsl:apply-templates/><axsl:apply-templates mode="M{count(../preceding-sibling::*)}"/></axsl:template></xsl:template><xsl:template match="sch:rule[@abstract='."'".'true'."'".'] | rule[@abstract='."'".'true'."'".']" ><xsl:if test=" not(@id)"><xsl:message>Markup Error: no id attribute on abstract &lt;rule></xsl:message></xsl:if>	<xsl:if test="@context"><xsl:message>Markup Error: (2) context attribute on abstract &lt;rule></xsl:message></xsl:if></xsl:template><xsl:template match="sch:rule[@abstract='."'".'true'."'".'] | rule[@abstract='."'".'true'."'".']"		mode="extends" ><xsl:if test="@context"><xsl:message>Markup Error: context attribute on abstract &lt;rule></xsl:message></xsl:if><xsl:apply-templates/></xsl:template><xsl:template match="sch:span | span" mode="text"><xsl:call-template name="process-span"			><xsl:with-param name="class" select="@class"/></xsl:call-template></xsl:template><xsl:template match="sch:title | title" />	<xsl:template match="sch:value-of | value-of" mode="text" ><xsl:if test="not(@select)"><xsl:message>Markup Error: no select attribute in &lt;value-of></xsl:message></xsl:if><xsl:call-template name="IamEmpty" /><axsl:text xml:space="preserve"></axsl:text><xsl:choose><xsl:when test="@select"				><xsl:call-template name="process-value-of"><xsl:with-param name="select" select="@select"/></xsl:call-template></xsl:when><xsl:otherwise ><xsl:call-template name="process-value-of"><xsl:with-param name="select" select="'."'".'.'."'".'"/></xsl:call-template></xsl:otherwise></xsl:choose><axsl:text xml:space="preserve"></axsl:text></xsl:template><xsl:template match="text()" priority="-1" mode="do-keys"></xsl:template><xsl:template match="text()" priority="-1" mode="do-all-patterns"></xsl:template><xsl:template match="text()" priority="-1" mode="do-schema-p"></xsl:template><xsl:template match="text()" priority="-1" mode="do-pattern-p"></xsl:template><xsl:template match="text()" priority="-1"></xsl:template><xsl:template match="text()" mode="text"><xsl:value-of select="normalize-space(.)"/></xsl:template><xsl:template match="text()" mode="inline-text"><xsl:value-of select="."/></xsl:template><xsl:template name="IamEmpty"><xsl:if test="count( * )"><xsl:message><xsl:text>Warning: </xsl:text><xsl:value-of select="name(.)"/><xsl:text> must not contain any child elements</xsl:text></xsl:message></xsl:if></xsl:template><xsl:template name="diagnosticsSplit"><!-- Process at the current point the first of the <diagnostic> elements       referred to parameter str, and then recurse --><xsl:param name="str"/><xsl:variable name="start"><xsl:choose><xsl:when test="contains($str,'."'".' '."'".')"><xsl:value-of  select="substring-before($str,'."'".' '."'".')"/></xsl:when><xsl:otherwise><xsl:value-of select="$str"/></xsl:otherwise></xsl:choose></xsl:variable><xsl:variable name="end"><xsl:if test="contains($str,'."'".' '."'".')"><xsl:value-of select="substring-after($str,'."'".' '."'".')"/></xsl:if></xsl:variable><xsl:if test="not(string-length(normalize-space($start)) = 0)	and not(//sch:diagnostic[@id = ($start)]) and not(//diagnostic[@id = ($start)])"><xsl:message>Reference error: A diagnostic "<xsl:value-of select="string($start)"/>" has been referenced but is not declared</xsl:message></xsl:if><xsl:if test="string-length(normalize-space($start)) > 0"><xsl:apply-templates         select="//sch:diagnostic[@id = ($start) ] | //diagnostic[@id= ($start) ]"/></xsl:if><xsl:if test="not($end='."'".''."'".')"><xsl:call-template name="diagnosticsSplit"><xsl:with-param name="str" select="$end"/></xsl:call-template></xsl:if></xsl:template><xsl:template match="*"><xsl:message><xsl:text>Warning: unrecognized element </xsl:text><xsl:value-of select="name(.)"/></xsl:message></xsl:template><xsl:template match="*" mode="text"><xsl:message><xsl:text>Warning: unrecognized element </xsl:text><xsl:value-of select="name(.)"/></xsl:message></xsl:template><xsl:template name="process-prolog"/><xsl:template name="process-root"><xsl:param name="contents"/><xsl:copy-of select="$contents"/></xsl:template><xsl:template name="process-assert"><xsl:param name="role"/><xsl:param name="test"/><xsl:call-template name="process-message"><xsl:with-param name="pattern" select="$test"/><xsl:with-param name="role" select="$role"/></xsl:call-template></xsl:template><xsl:template name="process-report"><xsl:param name="role"/><xsl:param name="test"/><xsl:call-template name="process-message"><xsl:with-param name="pattern" select="$test"/><xsl:with-param name="role" select="$role"/></xsl:call-template></xsl:template><xsl:template name="process-diagnostic"><xsl:apply-templates mode="text"/></xsl:template><xsl:template name="process-dir"	><xsl:apply-templates mode="inline-text"/></xsl:template><xsl:template name="process-emph"	><xsl:apply-templates mode="inline-text"/></xsl:template><xsl:template name="process-name"><xsl:param name="name"		/><axsl:value-of select="{$name}"/></xsl:template><xsl:template name="process-ns" /><xsl:template name="process-p"/><xsl:template name="process-pattern"/><xsl:template name="process-rule"/><xsl:template name="process-span"	><xsl:apply-templates mode="inline-test"/></xsl:template><xsl:template name="process-value-of"><xsl:param name="select"		/><axsl:value-of select="{$select}"/></xsl:template><xsl:template name="process-message"><xsl:apply-templates mode="text"/></xsl:template></xsl:stylesheet>';
   }
  
  function compile_schematron_from_file($xml_filename) {
    global $xslt_schematron;
    $xslt=new Xslt();
    $xslt->setXml($xml_filename);
    $xslt->setXslString($this->sk15);
    if($xslt->transform()) {
       $ret=$xslt->getOutput();
       $this->compiled[$xml_filename]=$ret;
    } else {
       trigger_error("XSLT error compiling $xml_filename".$xslt->getError(),E_USER_WARNING);
       return false;
    }
    return $ret;
  }
  
  function compile_schematron_from_mem($xml_string) {
    $xslt=new Xslt();
    $name=md5($xml_string);
    $xslt->setXmlString($xml_string);
    $xslt->setXslString($this->sk15);
    if($xslt->transform()) {
       $ret=$xslt->getOutput();
       $this->compiled[$name]=$ret;
       return $ret;
    } else {
       trigger_error("XSLT error compiling xml-string".$xslt->getError(),E_USER_WARNING);
       return false;
    }
    $xslt->destroy;
  }
  
  function get_compiled($xml_filename) {
    if(isset($this->compiled[$xml_filename])) {
      return $this->compiled[$xml_filename];  
    } else {
      return false; 
    } 
  }
  
  function save_compiled($xml_filename,$filename) {
     if(isset($this->compiled[$xml_filename])) {
      $fp=fopen($filename,"w");
      if(!$fp) {
        trigger_error("Cannot save compiled schematron to $filename may be a permissions problem",E_USER_WARNING);
      }
      fwrite($fp,$this->compiled[$xml_filename]);
      fclose($fp);  
      return true;
    } else {
      trigger_error("trying to save a schematron that was not compiled first",E_USER_WARNING);
      return false; 
    }
  }

  /* API FOR UNCOMPILED SCRIPTS */
  function schematron_validate_mem_using_mem($xml_string,$validation_string) {
    $name=md5($validation_string);   
    if(!isset($this->compiled[$name])) {
      $this->compile_schematron_from_mem($validation_string); 
    }
    $xslt=new Xslt();
    $xslt->setXmlString($xml_string);
    $xslt->setXslString($this->compiled[$name]);
    if($xslt->transform()) {
       $ret=$xslt->getOutput();
       return $ret;
    } else {
       trigger_error("XSLT error running schematron".$xslt->getError(),E_USER_WARNING);
       return false;
    }
    $xslt->destroy();
  }
 
  function schematron_validate_mem_using_file($xml_string,$validation_filename) {
    if(!isset($this->compiled[$validation_filename])) {
      $this->compile_schematron_from_file($validation_filename); 
    }
    $xslt=new Xslt();
    $xslt->setXmlString($xml_string);
    $xslt->setXslString($this->compiled[$validation_filename]);
    if($xslt->transform()) {
       $ret=$xslt->getOutput();
       return $ret;
    } else {
      trigger_error("XSLT error running schematron".$xslt->getError(),E_USER_WARNING);
      return false;
    }
    $xslt->destroy();
  }
  
  function schematron_validate_file_using_mem($xml_filename,$validation_string) {
    $name=md5($validation_string);
    if(!isset($this->compiled[$nameing])) {
      $this->compile_schematron_from_mem($validation_string); 
    }
    $xslt=new Xslt();
    $xslt->setXml($xml_filename);
    $xslt->setXslString($this->compiled[$name]);
    if($xslt->transform()) {
       $ret=$xslt->getOutput();
       return $ret;
    } else {
       trigger_error("XSLT error running schematron".$xslt->getError(),E_USER_WARNING);
       return false;
    }
    $xslt->destroy();
  }
  
  function schematron_validate_file_using_file($xml_filename,$validation_filename) {
    if(!isset($this->compiled[$validation_filename])) {
      $this->compile_schematron_from_file($validation_filename); 
    }
    $xslt=new Xslt();
    $xslt->setXml($xml_filename);
    $xslt->setXslString($this->compiled[$validation_filename]);
    if($xslt->transform()) {
       $ret=$xslt->getOutput();
       return $ret;
    } else {
       trigger_error("XSLT error running schematron".$xslt->getError(),E_USER_WARNING);
       return false;
    }
    $xslt->destroy();
  }
  
  /* API FOR COMPILED VALIDATION SCRIPTS */
  function schematron_validate_mem_using_compiled_mem($xml_string,$validation_string) {
    $xslt=new Xslt();
    $xslt->setXmlString($xml_string);
    $xslt->setXslString($validation_string);
    if($xslt->transform()) {
       $ret=$xslt->getOutput();
       return $ret;
    } else {
       trigger_error("XSLT error running schematron".$xslt->getError(),E_USER_WARNING);
       return false;
    }
    $xslt->destroy();
  }
 
  function schematron_validate_mem_using_compiled_file($xml_string,$validation_filename) {
    $xslt=new Xslt();
    $xslt->setXmlString($xml_string);
    $xslt->setXsl($validation_filename);
    if($xslt->transform()) {
       $ret=$xslt->getOutput();
       return $ret;
    } else {
      trigger_error("XSLT error running schematron".$xslt->getError(),E_USER_WARNING);
      return false;
    }
    $xslt->destroy();
  }
  
  function schematron_validate_file_using_compiled_mem($xml_filename,$validation_string) {
    $xslt=new Xslt();
    $xslt->setXml($xml_filename);
    $xslt->setXslString($validation_string);
    if($xslt->transform()) {
       $ret=$xslt->getOutput();
       return $ret;
    } else {
       trigger_error("XSLT error running schematron".$xslt->getError(),E_USER_WARNING);
       return false;
    }
    $xslt->destroy();
  }
  
  function schematron_validate_file_using_compiled_file($xml_filename,$validation_filename) {
    $xslt=new Xslt();
    $xslt->setXml($xml_filename);
    $xslt->setXsl($validation_filename);
    if($xslt->transform()) {
       $ret=$xslt->getOutput();
       return $ret;
    } else {
       trigger_error("XSLT error running schematron".$xslt->getError(),E_USER_WARNING);
       return false;
    }
    $xslt->destroy();
  }
  


}


}
?>

<?php 
// ##################################################################################
// Title                     : class_xslt.php
// Version                   : 1.1
// Author                    : Luis Argerich (lrargerich@yahoo.com)
// Last modification date    : 03-11-2002
// Description               : An abstraction class for the XSLT extension
//                             this one uses the Sablotron processor but we
//                             may release classes based on other processors
//                             later.
// ##################################################################################
// History: 
// 03-11-2001    Class modified to work with the new XSLT extension
// 11-11-2001    Class created
// ##################################################################################
// To-Dos:
// ##################################################################################
// How to use it:
// include_once("class_xslt.php");
// $xslt=new Xslt();
// $xslt->setXml("applications.xml"); // or setXmlString($xml)
// $xslt->setXsl("tr1.xsl");          // or setXslString($xsl)
// if($xslt->transform()) {
//    $ret=$xslt->getOutput();
//    echo $ret;
// } else {
//    print("Error:".$xslt->getError());
// }
// ##################################################################################
   

// CHECK FOR DOUBLE DEFINITION HERE
if(defined("_class_xslt_is_included")) {
  // do nothing since the class is already included  
} else {
  define("_class_xslt_is_included",1); 

class Xslt { 
   var $xsl, $xml, $output, $error ; 
   
   /* Constructor */ 
   function xslt() { 
      $this->processor = xslt_create(); 
   } 
   
   /* Destructor */ 
   function destroy() { 
      xslt_free($this->processor); 
   } 
   
   /* output methods */ 
   function setOutput($string) { 
      $this->output = $string; 
   } 
   
   function getOutput() { 
      return $this->output; 
   } 
   
   /* set methods */
   function setXmlString($xml) {
      $this->xml=$xml;
      return true;
   }

   function setXslString($xsl) {
      $this->xsl=$xsl;
      return true;
   }
 
   function setXml($uri) {
      if($doc = new docReader($uri)) { 
         $this->xml = $doc->getString(); 
         return true; 
      } else { 
         $this->setError("Could not open $xml"); 
         return false; 
      } 
   } 
   
   function setXsl($uri) { 
      if($doc = new docReader($uri)) { 
         $this->xsl = $doc->getString(); 
         return true; 
      } else { 
         $this->setError("Could not open $uri"); 
         return false; 
      } 
   } 
   
   /* transform method */ 
   function transform() {
      $arguments = array(
           '/_xml' => $this->xml,
           '/_xsl' => $this->xsl
      );
      $ret = xslt_process($this->processor, 'arg:/_xml', 'arg:/_xsl', NULL, $arguments);
      if(!$ret) {
        $this->setError(xslt_error($this->processor));
	return false;
      } else {
        $this->setOutput($ret); 
	return true;
      }
   } 

   /* Error Handling */ 
   function setError($string) { 
      $this->error = $string; 
   } 
   
   function getError() { 
      return $this->error; 
   } 
} 



/* docReader -- read a file or URL as a string */ 
/* test */ 
/* 
   $docUri = new docReader('http://www.someurl.com/doc.html'); 
   echo $docUri->getString(); 
*/ 
class docReader { 
   var $string; // public string representation of file 
   var $type; // private URI type: 'file','url' 
   var $bignum = 1000000;
   var $uri; 
   /* public constructor */ 
   function docReader($uri) { // returns integer      $this->setUri($uri); 
      $this->uri=$uri;
      $this->setType(); 
      $fp = fopen($this->getUri(),"r"); 
      if($fp) { // get length 
         if ($this->getType() == 'file') { 
            $length = filesize($this->getUri()); 
         } else { 
            $length = $this->bignum; 
         } 
      $this->setString(fread($fp,$length)); 
         return 1; 
      } else { 
         return 0; 
      } 
   } 
   /* determine if a URI is a filename or URL */ 
   function isFile($uri) { // returns boolean
      if (strstr($uri,'http://') == $uri) { 
         return false; 
      } else { 
         return true; 
      } 
   } 
   /* set and get methods */ 
   function setUri($string) { 
      $this->uri = $string; 
   } 
   function getUri() { 
      return $this->uri; 
   } 
   function setString($string) { 
      $this->string = $string; 
   } 
   function getString() { 
      return $this->string; 
   } 
   function setType() { 
      if ($this->isFile($this->uri)) { 
         $this->type = 'file';
      } else { 
         $this->type = 'url';
      } 
   } 
   function getType() { 
      return $this->type; 
   } 
} 

}