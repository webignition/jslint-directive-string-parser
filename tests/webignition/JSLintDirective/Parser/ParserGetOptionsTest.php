<?php

use webignition\JSLintDirective\Parser;

class ParserGetOptionsTest extends PHPUnit_Framework_TestCase  {
    
    public function testGetParsedOptions() {        
        $parser = new Parser();
        $jsLintDirective = $parser->parse("/*jslint bitwise: true, continue: true, debug: true, eqeq: true, es5: true, evil: true, forin: true, newcap: true, nomen: true, plusplus: true, regexp: true, undef: true, unparam: true, sloppy: true, stupid: true, sub: true, todo: true, vars: true, white: true, css: true, on: true, fragment: true, passfail: true, browser: true, devel: true, node: true, rhino: true, windows: true, safe: true, adsafe: true, indent: 10, maxerr: 12, maxlen: 11 */");        
        $this->assertInstanceOf('webignition\JSLintDirective\JSLintDirective', $jsLintDirective);
        
        $options = $jsLintDirective->getOptions();        
        $this->assertEquals(30, count($options));
    }

    public function testGetThreeValidTwoInvalidOptions() {        
        $parser = new Parser();
        $jsLintDirective = $parser->parse("/*jslint bitwise: true, continue: false, maxlen: 12, badoption1: true, badoption2: 99 */");
        $this->assertInstanceOf('webignition\JSLintDirective\JSLintDirective', $jsLintDirective);
        
        $options = $jsLintDirective->getOptions();        
        $this->assertEquals(3, count($options));
        $this->assertEquals(array(
            'bitwise' => true,
            'continue' => false,
            'maxlen' => 12
        ), $options);
    }    
}