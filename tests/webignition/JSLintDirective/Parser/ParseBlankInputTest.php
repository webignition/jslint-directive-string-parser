<?php

use webignition\JSLintDirective\Parser;

class ParseBlankInputTest extends PHPUnit_Framework_TestCase  {
    
    public function testParseNullInputReturnsFalse() {
        $parser = new Parser();
        $jsLintDirective = $parser->parse(null);        
        $this->assertFalse($jsLintDirective);  
    }
    
    public function testParseBlankReturnsFalse() {
        $parser = new Parser();
        $jsLintDirective = $parser->parse('');        
        $this->assertFalse($jsLintDirective);  
    }
    
}